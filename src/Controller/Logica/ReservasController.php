<?php

namespace App\Controller\Logica;

use App\Entity\Reserva;
use App\Entity\Vuelo;
use App\Entity\Tarifable;
use App\Entity\Asiento;
use App\Entity\Facturacion;
use App\Repository\FacturacionRepository;
use App\Repository\ReservaRepository;
use App\Repository\VueloRepository;
use App\Repository\TarifablesRepository;
use App\Repository\AsientoRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Statement;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class ReservasController extends AbstractController
{

    private $reservaRepository;
    private $vueloRepository;
    private $tarifablesRepository;
    private $asientoRepository;
    private $facturacionRepository;
    private $doctrine;

    public function __construct(ReservaRepository $reservaRepository,VueloRepository $vueloRepository,FacturacionRepository $facturacionRepository,TarifablesRepository $tarifablesRepository,AsientoRepository $asientoRepository,ManagerRegistry $doctrine)
    {
        $this->reservaRepository = $reservaRepository;
        $this->vueloRepository = $vueloRepository;
        $this->tarifablesRepository = $tarifablesRepository;
        $this->asientoRepository = $asientoRepository;
        $this->facturacionRepository = $facturacionRepository;
        $this->doctrine = $doctrine;
    }

    #[Route("/finalizareserva/{vueloidaid}/{vuelovueltaid}/{asientoidaid}/{asientovueltaid}/{tarifaid}", name: "finalizareserva")]
    public function finalizareserva(int $vueloidaid,?int $vuelovueltaid,int $asientoidaid,int $asientovueltaid,string $tarifaid,EntityManagerInterface $entityManager): Response
    {
        $asientoida=$this->asientoRepository->find($asientoidaid);
        $asientoida->setOcupado(true);
        $entityManager->persist($asientoida);
        $entityManager->flush();

        $asientovuelta=$this->asientoRepository->find($asientovueltaid);
        $asientovuelta->setOcupado(true);
        $entityManager->persist($asientovuelta);
        $entityManager->flush();

        $reservaida=new Reserva();
        $reservaida->setCliente($this->getUser());
        $reservaida->setVuelo($this->vueloRepository->find($vueloidaid));
        $reservaida->setAsiento($asientoida);
        $entityManager->persist($reservaida);
        $entityManager->flush();

        $reservavuelta=new Reserva();
        $reservavuelta->setCliente($this->getUser());
        $reservavuelta->setVuelo($this->vueloRepository->find($vuelovueltaid));
        $reservavuelta->setAsiento($asientovuelta);
        $entityManager->persist($reservavuelta);
        $entityManager->flush();
        
        $tarifa=$this->tarifablesRepository->find(intval($tarifaid));
        
        $facturacionida=new Facturacion();
        $facturacionida->setReserva($reservaida);
        $facturacionida->setTarifables($tarifa);
        $entityManager->persist($facturacionida);
        $entityManager->flush();

        $facturacionvuelta=new Facturacion();
        $facturacionvuelta->setReserva($reservavuelta);
        $facturacionvuelta->setTarifables($tarifa);
        $entityManager->persist($facturacionvuelta);
        $entityManager->flush();

        return new RedirectResponse('/success-url');
    }
   
    #[Route("/elegirasiento/{vueloidaid}/{vuelovueltaid}/{tarifaid}", name: "elegirasiento")]
    public function elegirasiento(int $vueloidaid,?int $vuelovueltaid,int $tarifaid): Response
    {

        $vueloida=$this->vueloRepository->find($vueloidaid);
        $vuelovuelta=$this->vueloRepository->find($vuelovueltaid);
        $tarifa=$this->tarifablesRepository->find($tarifaid);
        $avionida=$vueloida->getAvion()->getId();
        $avionvuelta=$vuelovuelta->getAvion()->getId();
        
        if($tarifaid==1)
        {
            $asientos = $this->asientoRepository->createQueryBuilder('c')
                       ->andWhere('c.avion = :avionId')
                       ->andWhere('c.vuelo = :vueloId')
                       ->andWhere("c.clase != 'Business'")
                       ->andWhere("c.clase != 'Prioriario'")
                       ->andWhere('c.Ocupado = false')
                       ->setParameter('avionId', $avionida)
                       ->setParameter('vueloId', $vueloidaid)
                       ->getQuery()
                       ->getResult()
                   ;
            $totalAsientos = count($asientos);
            $indiceAleatorio = mt_rand(0, $totalAsientos - 1);
            $asientoelegidoIda=$asientos[$indiceAleatorio];
            $asientoelegidoIda->setOcupado(true);

            $asientos = $this->asientoRepository->createQueryBuilder('c')
                       ->andWhere('c.avion = :avionId')
                       ->andWhere('c.vuelo = :vueloId')
                       ->andWhere("c.clase != 'Business'")
                       ->andWhere("c.clase != 'Prioriario'")
                       ->andWhere('c.Ocupado = false')
                       ->setParameter('avionId', $avionvuelta)
                       ->setParameter('vueloId', $vuelovueltaid)
                       ->getQuery()
                       ->getResult()
                   ;
            $totalAsientos = count($asientos);
            $indiceAleatorio = mt_rand(0, $totalAsientos - 1);
            $asientoelegidoVuelta=$asientos[$indiceAleatorio];
            $asientoelegidoVuelta->setOcupado(true);

            $preciototal=floatval($vueloida->getPrecioBase())+floatval($vuelovuelta->getPrecioBase())+floatval($tarifa->getPrecio())+floatval($tarifa->getPrecio());
            $preciototal=number_format($preciototal, 2);
            return $this->render('resumenpedido.html.twig', [
                'vueloida' => $vueloida,
                'vuelovuelta' => $vuelovuelta,
                'tarifa' =>  $tarifa,
                'asientoelegidoIda' => $asientoelegidoIda,
                'asientoelegidoVuelta' => $asientoelegidoVuelta,
                'preciototal' => $preciototal,
            ]);

        }
    }

    #[Route("/elegirasiento2/{vueloidaid}/{vuelovueltaid}/{tarifaid}/{asientoidida}/{asientoidvuelta}", name: "elegirasiento2")]
    public function elegirasiento2(int $vueloidaid,?int $vuelovueltaid,int $tarifaid,int $asientoidida,int $asientoidvuelta): Response
    {
        
    }
   
}
