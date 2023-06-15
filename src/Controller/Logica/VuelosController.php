<?php

namespace App\Controller\Logica;

use App\Entity\Vuelo;
use App\Entity\Asiento;
use App\Entity\Avion;
use App\Entity\Ruta;
use App\Entity\Tarifables;
use App\Form\VueloType;
use DateTime;
use App\Repository\VueloRepository;
use App\Repository\RutaRepository;
use App\Repository\TarifablesRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;


class VuelosController extends AbstractController
{

    private $vueloRepository;
    private $rutaRepository;
    private $tarifablesRepository;

    public function __construct(VueloRepository $vueloRepository,RutaRepository $rutaRepository,TarifablesRepository $tarifablesRepository)
    {
        $this->vueloRepository = $vueloRepository;
        $this->rutaRepository = $rutaRepository;
        $this->tarifablesRepository = $tarifablesRepository;
    }
   

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/nuevovuelo', name: 'app_nuevovuelo')]
    public function nuevovuelo(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vuelo = new Vuelo();
        $form = $this->createForm(VueloType::class, $vuelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $entityManager->persist($vuelo);
                $entityManager->flush();
                $avion=$vuelo->getAvion();
                if($avion->getModelo() == "Airbus")
                {
                    for ($j=1;$j<=4;$j++)
                    {
                        for ($i=1;$i<=3;$i++)
                        {
                            $asiento=new Asiento();
                            $asiento->setAvion($avion);
                            $asiento->setVuelo($vuelo);
                            $asiento->setOcupado(false);
                            $asiento->setFila($j);
                            if($i==1)
                            {
                                $asiento->setColumna('A');
                            }
                            else if($i==2)
                            {
                                $asiento->setColumna('E');
                            }
                            else if($i==3)
                            {
                                $asiento->setColumna('F');
                            }
                            $asiento->setClase('Business');
                            $entityManager->persist($asiento);
                            $entityManager->flush();
                        }
                    }
                    
                    for ($j=5;$j<=20;$j++)
                    {
                        for ($i=1;$i<=4;$i++)
                        {
                            $asiento=new Asiento();
                            $asiento->setAvion($avion);
                            $asiento->setVuelo($vuelo);
                            $asiento->setOcupado(false);
                            $asiento->setFila($j);
                            if($i==1)
                            {
                                $asiento->setColumna('A');
                            }
                            else if($i==2)
                            {
                                $asiento->setColumna('B');
                            }
                            else if($i==3)
                            {
                                $asiento->setColumna('C');
                            }
                            else if($i==4)
                            {
                                $asiento->setColumna('D');
                            }

                            if(($j>=5) && ($j<=9))
                            {
                                $asiento->setClase('Prioriario');
                            }
                            else
                            {
                                $asiento->setClase('Regular');
                            }
                            $entityManager->persist($asiento);
                            $entityManager->flush();
                        }
                    }
                }
                else if ($avion->getModelo() == "Boeing")
                {
                    for ($j=1;$j<=3;$j++)
                    {
                        for ($i=1;$i<=4;$i++)
                        {
                            $asiento=new Asiento();
                            $asiento->setAvion($avion);
                            $asiento->setVuelo($vuelo);
                            $asiento->setOcupado(false);
                            $asiento->setFila($j);
                            if($i==1)
                            {
                                $asiento->setColumna('A');
                            }
                            else if($i==2)
                            {
                                $asiento->setColumna('B');
                            }
                            else if($i==3)
                            {
                                $asiento->setColumna('E');
                            }
                            else if($i==4)
                            {
                                $asiento->setColumna('F');
                            }
                            $asiento->setClase('Business');
                            $entityManager->persist($asiento);
                            $entityManager->flush();
                        }
                    }

                   for ($j=5;$j<=20;$j++)
                    {
                        for ($i=1;$i<=6;$i++)
                        {
                            $asiento=new Asiento();
                            $asiento->setAvion($avion);
                            $asiento->setVuelo($vuelo);
                            $asiento->setOcupado(false);
                            $asiento->setFila($j);
                            if($i==1)
                            {
                                $asiento->setColumna('A');
                            }
                            else if($i==2)
                            {
                                $asiento->setColumna('B');
                            }
                            else if($i==3)
                            {
                                $asiento->setColumna('C');
                            }
                            else if($i==4)
                            {
                                $asiento->setColumna('D');
                            }
                            else if($i==5)
                            {
                                $asiento->setColumna('E');
                            }
                            else if($i==6)
                            {
                                $asiento->setColumna('F');
                            }

                            if(($j>=5) && ($j<=9))
                            {
                                $asiento->setClase('Prioriario');
                            }
                            else
                            {
                                $asiento->setClase('Regular');
                            }
                            $entityManager->persist($asiento);
                            $entityManager->flush();
                        }
                    }
                }
            

            return $this->redirect('/admin/listavuelo/1');
        }

        return $this->render('nuevovuelo.html.twig', [
            'nuevovueloForm' => $form->createView(),
            'titulo' => 'Crear'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/editavuelo/{id}', name: 'app_editavuelo')]
    public function editavuelo(String $id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $vuelo = $this->vueloRepository->find($id);
        // $primeraimg=$juego->getImagen();
        // $vuelo->setImagen(null);
        $form = $this->createForm(VueloType::class, $vuelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          
            $entityManager->persist($vuelo);
            $entityManager->flush();

            return $this->redirect('/admin/listavuelo/1');
        }

        return $this->render('nuevovuelo.html.twig', [
            'nuevovueloForm' => $form->createView(),
            'titulo' => 'Editar'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/listavuelo/{pagina}', name: 'app_listavuelo')]
    public function listavuelo(String $pagina,Request $request, EntityManagerInterface $entityManager): Response
    {   
        $totalRegistros = $this->vueloRepository->count(array());
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
        $vuelos=$this->vueloRepository->findBy(array(),['fecha_salida' => 'ASC'],$elementosPorPagina,$inicioLimite);

        return $this->render('admvuelos.html.twig', [
            'vuelos' => $vuelos,
            'totalpgs' => $totalPaginas,
            'pagina' => $pagina,
            'totalreg' => $totalRegistros,
            'iniciolimit' => $inicioLimite
        ]);
    }

    
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/vuelosdisponibles', name: 'app_vuelodisponible')]
    public function vuelodiponible(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $origen = $request->request->get('origen');
        $destino = $request->request->get('destino');
        $fechaida = $request->request->get('fechaida');
        $fechavuelta = $request->request->get('fechavuelta');
        $rutaida = $this->rutaRepository->findOneBy(['origen' => $origen, 'destino' => $destino]);
        $rutavuelta = $this->rutaRepository->findOneBy(['origen' => $destino, 'destino' => $origen]);
        $fechaida = new DateTime($fechaida);
        $fechaFormateadaida = $fechaida->format('Y-m-d');
        $fechavuelta = new DateTime($fechavuelta);
        $fechaFormateadavuelta = $fechavuelta->format('Y-m-d');
        
        $vuelosida = $this->vueloRepository->findBy([
            'ruta' => $rutaida,
        ]);

        for ($i=0;$i<count($vuelosida);$i++)
        {
            if($vuelosida[$i]->getFechaSalida()->format("Y-m-d") != $fechaFormateadaida)
            {
              array_splice($vuelosida, $i, 1);
            }
        }

        $vuelosvuelta = $this->vueloRepository->findBy([
            'ruta' => $rutavuelta,
        ]);

        for ($i=0;$i<count($vuelosvuelta);$i++)
        {
            if($vuelosvuelta[$i]->getFechaSalida()->format("Y-m-d") != $fechaFormateadavuelta)
            {
              array_splice($vuelosvuelta, $i, 1);
            }
        }

        $tarifables=$this->tarifablesRepository->findAll();

        return $this->render('vuelosdisponibles.html.twig', [
            'rutaida' => $rutaida,
            'rutavuelta' => $rutavuelta,
            'fechaida' => $fechaida,
            'fechavuelta' => $fechavuelta,
            'vuelosida' => $vuelosida,
            'vuelosvuelta' => $vuelosvuelta,
            'tarifables' => $tarifables,
        ]);
    }

     
    #[IsGranted('ROLE_ADMIN')]
    #[Route("/admin/deletevuelo/{id}", name: "borravuelos")]
    public function borrarvuelos(int $id): Response
    {
        $this->vueloRepository->remove($this->vueloRepository->find($id),true);

        return $this->redirect('/admin/listavuelo/1');
    }
}