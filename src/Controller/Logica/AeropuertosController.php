<?php

namespace App\Controller\Logica;

use App\Entity\Aeropuerto;
use App\Form\AeropuertoType;
use App\Repository\AeropuertoRepository;
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


class AeropuertosController extends AbstractController
{

    private $aeropuertoRepository;

    public function __construct(AeropuertoRepository $aeropuertoRepository)
    {
        $this->aeropuertoRepository = $aeropuertoRepository;
    }
   

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/nuevoaeropuerto', name: 'app_nuevoaeropuerto')]
    public function nuevoaeropuerto(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aeropuerto = new Aeropuerto();
        $form = $this->createForm(AeropuertoType::class, $aeropuerto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            
           
            $entityManager->persist($aeropuerto);
            $entityManager->flush();

            return $this->redirect('/admin/listaaeropuerto/1');
        }

        return $this->render('nuevoaeropuerto.html.twig', [
            'nuevoaeropuertoForm' => $form->createView(),
            'titulo' => 'Crear'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/editaeropuerto/{id}', name: 'app_editaaeropuerto')]
    public function editaaeropuerto(String $id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $aeropuerto = $this->aeropuertoRepository->find($id);
       
        $form = $this->createForm(AeropuertoType::class, $aeropuerto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          
            $entityManager->persist($aeropuerto);
            $entityManager->flush();

            return $this->redirect('/admin/listaaeropuerto/1');
        }

        return $this->render('nuevoaeropuerto.html.twig', [
            'nuevoaeropuertoForm' => $form->createView(),
            'titulo' => 'Editar'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/listaaeropuerto/{pagina}', name: 'app_listaaeropuerto')]
    public function listaaeropuerto(String $pagina,Request $request, EntityManagerInterface $entityManager): Response
    {   
        $totalRegistros = $this->aeropuertoRepository->count(array());
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
        $aeropuertos=$this->aeropuertoRepository->findBy(array(),['nombre' => 'ASC'],$elementosPorPagina,$inicioLimite);

        return $this->render('admaeropuertos.html.twig', [
            'aeropuertos' => $aeropuertos,
            'totalpgs' => $totalPaginas,
            'pagina' => $pagina,
            'totalreg' => $totalRegistros,
            'iniciolimit' => $inicioLimite
        ]);
    }

     
    #[IsGranted('ROLE_ADMIN')]
    #[Route("/admin/deleteaeropuerto/{id}", name: "borraaeropuertos")]
    public function borraraeropuertos(int $id): Response
    {
        $this->aeropuertoRepository->remove($this->aeropuertoRepository->find($id),true);

        return $this->redirect('/admin/listaaeropuerto/1');
    }
}