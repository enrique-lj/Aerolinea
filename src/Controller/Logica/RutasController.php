<?php

namespace App\Controller\Logica;

use App\Entity\Ruta;
use App\Form\RutaType;
use App\Repository\RutaRepository;
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


class RutasController extends AbstractController
{

    private $rutaRepository;

    public function __construct(RutaRepository $rutaRepository)
    {
        $this->rutaRepository = $rutaRepository;
    }
   

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/nuevaruta', name: 'app_nuevaruta')]
    public function nuevaruta(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ruta = new Ruta();
        $form = $this->createForm(RutaType::class, $ruta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            
           
            $entityManager->persist($ruta);
            $entityManager->flush();

            return $this->redirect('/admin/listaruta/1');
        }

        return $this->render('nuevaruta.html.twig', [
            'nuevarutaForm' => $form->createView(),
            'titulo' => 'Crear'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/editaruta/{id}', name: 'app_editaruta')]
    public function editaruta(String $id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $ruta = $this->rutaRepository->find($id);
       
        $form = $this->createForm(RutaType::class, $ruta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          
            $entityManager->persist($ruta);
            $entityManager->flush();

            return $this->redirect('/admin/listaruta/1');
        }

        return $this->render('nuevaruta.html.twig', [
            'nuevarutaForm' => $form->createView(),
            'titulo' => 'Editar'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/listaruta/{pagina}', name: 'app_listaruta')]
    public function listaruta(String $pagina,Request $request, EntityManagerInterface $entityManager): Response
    {   
        $totalRegistros = $this->rutaRepository->count(array());
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
        $rutas=$this->rutaRepository->findBy(array(),['id' => 'ASC'],$elementosPorPagina,$inicioLimite);

        return $this->render('admrutas.html.twig', [
            'rutas' => $rutas,
            'totalpgs' => $totalPaginas,
            'pagina' => $pagina,
            'totalreg' => $totalRegistros,
            'iniciolimit' => $inicioLimite
        ]);
    }

     
    #[IsGranted('ROLE_ADMIN')]
    #[Route("/admin/deleteruta/{id}", name: "borrarutas")]
    public function borrarrutas(int $id): Response
    {
        $this->rutaRepository->remove($this->rutaRepository->find($id),true);

        return $this->redirect('/admin/listaruta/1');
    }
}