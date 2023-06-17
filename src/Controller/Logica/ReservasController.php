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
use App\Service\EnviaCorreo;
use DateTime;


class ReservasController extends AbstractController
{

    private $reservaRepository;
    private $vueloRepository;
    private $tarifablesRepository;
    private $asientoRepository;
    private $facturacionRepository;
    private $doctrine;
    private $mailer;

    public function __construct(EnviaCorreo $mailer,ReservaRepository $reservaRepository,VueloRepository $vueloRepository,FacturacionRepository $facturacionRepository,TarifablesRepository $tarifablesRepository,AsientoRepository $asientoRepository,ManagerRegistry $doctrine)
    {
        $this->reservaRepository = $reservaRepository;
        $this->vueloRepository = $vueloRepository;
        $this->tarifablesRepository = $tarifablesRepository;
        $this->asientoRepository = $asientoRepository;
        $this->facturacionRepository = $facturacionRepository;
        $this->doctrine = $doctrine;
        $this->mailer = $mailer;
    }

    #[Route("/finalizareserva/{vueloidaid}/{asientoidaid}/{tarifaid}", name: "finalizareserva")]
    public function finalizareserva(int $vueloidaid,int $asientoidaid,string $tarifaid,EntityManagerInterface $entityManager): Response
    {
        $asientoida=$this->asientoRepository->find($asientoidaid);
        $asientoida->setOcupado(true);
        $entityManager->persist($asientoida);
        $entityManager->flush();

        $reservaida=new Reserva();
        $reservaida->setCliente($this->getUser());
        $reservaida->setVuelo($this->vueloRepository->find($vueloidaid));
        $reservaida->setAsiento($asientoida);
        $reservaida->setCheckin(false);
        $entityManager->persist($reservaida);
        $entityManager->flush();

        $tarifa=$this->tarifablesRepository->find(intval($tarifaid));
        
        $facturacionida=new Facturacion();
        $facturacionida->setReserva($reservaida);
        $facturacionida->setTarifables($tarifa);
        $entityManager->persist($facturacionida);
        $entityManager->flush();

        $preciototal=floatval($facturacionida->getReserva()->getVuelo()->getPrecioBase())+floatval($tarifa->getPrecio());
        $preciototal=number_format($preciototal, 2);

        $this->mailer->enviofactura1($facturacionida,$preciototal);

        return new RedirectResponse('/success-url');
    }

    #[Route("/finalizareservadoble/{vueloidaid}/{vuelovueltaid}/{asientoidaid}/{asientovueltaid}/{tarifaid}", name: "finalizareservadoble")]
    public function finalizareservadoble(int $vueloidaid,int $vuelovueltaid,int $asientoidaid,int $asientovueltaid,string $tarifaid,EntityManagerInterface $entityManager): Response
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
        $reservaida->setCheckin(false);
        $entityManager->persist($reservaida);
        $entityManager->flush();

        $reservavuelta=new Reserva();
        $reservavuelta->setCliente($this->getUser());
        $reservavuelta->setVuelo($this->vueloRepository->find($vuelovueltaid));
        $reservavuelta->setAsiento($asientovuelta);
        $reservavuelta->setCheckin(false);
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

        $preciototal=floatval($facturacionida->getReserva()->getVuelo()->getPrecioBase())+floatval($facturacionvuelta->getReserva()->getVuelo()->getPrecioBase())+floatval($tarifa->getPrecio())+floatval($tarifa->getPrecio());
        $preciototal=number_format($preciototal, 2);

        $this->mailer->enviofactura2($facturacionida,$facturacionvuelta,$preciototal);

        return new RedirectResponse('/success-url');
    }


   
    #[Route("/elegirasiento1/{vueloidaid}/{tarifaid}", name: "elegirasiento1")]
    public function elegirasiento1(int $vueloidaid,int $tarifaid): Response
    {

        $vueloida=$this->vueloRepository->find($vueloidaid);
      
        $tarifa=$this->tarifablesRepository->find($tarifaid);
        $avionida=$vueloida->getAvion()->getId();

        
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

            $preciototal=floatval($vueloida->getPrecioBase())+floatval($tarifa->getPrecio());
            $preciototal=number_format($preciototal, 2);
            return $this->render('resumenpedido.html.twig', [
                'vueloida' => $vueloida,
                'tarifa' =>  $tarifa,
                'asientoelegidoIda' => $asientoelegidoIda,
                'preciototal' => $preciototal,
            ]);

        }
    }

    #[Route("/elegirasiento2/{vueloidaid}/{vuelovueltaid}/{tarifaid}", name: "elegirasiento2")]
    public function elegirasiento2(int $vueloidaid,?int $vuelovueltaid,int $tarifaid): Response
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

    #[Route("/elegirasiento3/{vueloidaid}/{tarifaid}/{asientoid}", name: "elegirasiento3")]
    public function elegirasiento3(int $vueloidaid,int $tarifaid,int $asientoid): Response
    {
        $vueloida=$this->vueloRepository->find($vueloidaid);
        $tarifa=$this->tarifablesRepository->find($tarifaid);
        $asiento=$this->asientoRepository->find($asientoid);

            $preciototal=floatval($vueloida->getPrecioBase())+floatval($tarifa->getPrecio());
            $preciototal=number_format($preciototal, 2);
            return $this->render('resumenpedido.html.twig', [
                'vueloida' => $vueloida,
                'tarifa' =>  $tarifa,
                'asientoelegidoIda' => $asiento,
                'preciototal' => $preciototal,
            ]);  
    }

    #[Route("/elegirasiento4/{vueloidaid}/{asientoidaid}/{tarifaid}/{vuelovueltaid}/{asientovueltaid}", name: "elegirasiento4")]
    public function elegirasiento4(int $vueloidaid,int $asientoidaid,int $tarifaid,int $vuelovueltaid,int $asientovueltaid): Response
    {
        $vueloida=$this->vueloRepository->find($vueloidaid);
        $tarifa=$this->tarifablesRepository->find($tarifaid);
        $asientoida=$this->asientoRepository->find($asientoidaid);
        $vuelovuelta=$this->vueloRepository->find($vuelovueltaid);
        $asientovuelta=$this->asientoRepository->find($asientovueltaid);

            $preciototal=floatval($vueloida->getPrecioBase())+floatval($vuelovuelta->getPrecioBase())+floatval($tarifa->getPrecio())+floatval($tarifa->getPrecio());
            $preciototal=number_format($preciototal, 2);
            return $this->render('resumenpedido.html.twig', [
                'vueloida' => $vueloida,
                'tarifa' =>  $tarifa,
                'asientoelegidoIda' => $asientoida,
                'vuelovuelta' => $vuelovuelta,
                'asientoelegidoVuelta' => $asientovuelta,
                'preciototal' => $preciototal,
            ]);  
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/listareserva/{pagina}', name: 'app_listareserva')]
    public function listareserva(String $pagina,Request $request, EntityManagerInterface $entityManager): Response
    {   
        $totalRegistros = $this->reservaRepository->count(array());
        $elementosPorPagina=5;
        $totalPaginas=ceil($totalRegistros/$elementosPorPagina);
       
        if($pagina=="1")
        {
          $inicioLimite=0;
        }
        else
        {
          $inicioLimite= ($pagina-1) * 5;
        }
        $reservas=$this->reservaRepository->findBy(array(),['id' => 'ASC'],$elementosPorPagina,$inicioLimite);

        return $this->render('admreservas.html.twig', [
            'reservas' => $reservas,
            'totalpgs' => $totalPaginas,
            'pagina' => $pagina,
            'totalreg' => $totalRegistros,
            'iniciolimit' => $inicioLimite
        ]);
    }

    #[IsGranted('IS_AUTHENTICATED')]
    #[Route('/profile/misreserva/{pagina}', name: 'app_misreserva')]
    public function misresevas(String $pagina,Request $request, EntityManagerInterface $entityManager): Response
    {   
     
        $ahora=new DateTime();
        $ahoraFormatedo = $ahora->format('Y-m-d');

      


        $totalRegistros = $this->reservaRepository->createQueryBuilder('c')
        ->select('COUNT(c)')
        ->andWhere('c.cliente = :clienteId')
        ->setParameter('clienteId', $this->getUser()->getId())
        ->getQuery()
        ->getSingleScalarResult();
        $elementosPorPagina=5;
        $totalPaginas=ceil($totalRegistros/$elementosPorPagina);
       
        if($pagina=="1")
        {
          $inicioLimite=0;
        }
        else
        {
          $inicioLimite= ($pagina-1) * 5;
        }
        
        $misreservas = $this->reservaRepository->createQueryBuilder('c')
        ->andWhere('c.cliente = :clienteId')
        ->setParameter('clienteId',$this->getUser()->getId())
        ->setFirstResult($inicioLimite)  
        ->setMaxResults(5) 
        ->getQuery()
        ->getResult()
    ;

        return $this->render('misreservas.html.twig', [
            'reservas' => $misreservas,
            'totalpgs' => $totalPaginas,
            'pagina' => $pagina,
            'totalreg' => $totalRegistros,
            'iniciolimit' => $inicioLimite,
            'ahora' => $ahora,
        ]);
    }


    #[Route('/checkin/{reservaId}', name: 'app_checkin')]
    public function checkin(int $reservaId,EntityManagerInterface $entityManager) : Response
    {
        $reserva=$this->reservaRepository->find($reservaId);
        $reserva->setCheckin(true);
        $entityManager->persist($reserva);
        $entityManager->flush();

        $this->mailer->enviotarjeta($reserva);

        return new RedirectResponse('/profile/misreserva/1');
    }
}
