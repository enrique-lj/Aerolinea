<?php

namespace App\Controller\Logica;

use App\Entity\Avion;
use App\Form\AvionType;
use App\Repository\AvionRepository;
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


class AvionesController extends AbstractController
{

    private $avionRepository;

    public function __construct(AvionRepository $avionRepository)
    {
        $this->avionRepository = $avionRepository;
    }
   

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/nuevoavion2', name: 'app_nuevoavion')]
    public function nuevoavion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avion = new Avion();
        $form = $this->createForm(AvionType::class, $avion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            
           
            $entityManager->persist($avion);
            $entityManager->flush();

            return $this->redirect('/admin/listaavion/1');
        }

        return $this->render('nuevoavion2.html.twig', [
            'nuevoavionForm' => $form->createView(),
            'titulo' => 'Crear'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/editaavion/{id}', name: 'app_editaavion')]
    public function editaaeropuerto(String $id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $avion = $this->avionRepository->find($id);
       
        $form = $this->createForm(AvionType::class, $avion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          
            $entityManager->persist($avion);
            $entityManager->flush();

            return $this->redirect('/admin/listaavion/1');
        }

        return $this->render('nuevoavion.html.twig', [
            'nuevoavionForm' => $form->createView(),
            'titulo' => 'Editar'
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/listaavion/{pagina}', name: 'app_listaavion')]
    public function listaavion(String $pagina,Request $request, EntityManagerInterface $entityManager): Response
    {   
        $totalRegistros = $this->avionRepository->count(array());
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
        $aviones=$this->avionRepository->findBy(array(),['codigo' => 'ASC'],$elementosPorPagina,$inicioLimite);

        return $this->render('admaviones.html.twig', [
            'aviones' => $aviones,
            'totalpgs' => $totalPaginas,
            'pagina' => $pagina,
            'totalreg' => $totalRegistros,
            'iniciolimit' => $inicioLimite
        ]);
    }

     
    #[IsGranted('ROLE_ADMIN')]
    #[Route("/admin/deleteavion/{id}", name: "borraaviones")]
    public function borraraviones(int $id): Response
    {
        $this->avionRepository->remove($this->avionRepository->find($id),true);

        return $this->redirect('/admin/listaavion/1');
    }

   
}