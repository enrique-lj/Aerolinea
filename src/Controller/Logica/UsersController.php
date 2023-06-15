<?php

namespace App\Controller\Logica;

use App\Entity\User;
use App\Form\UsuarioType;
use App\Repository\UserRepository;
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


class UsersController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
   

    // #[IsGranted('ROLE_ADMIN')]
    // #[Route('/admin/nuevousuario', name: 'app_nuevousuario')]
    // public function nuevousuario(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $usuario = new User();
    //     $form = $this->createForm(UsuarioType::class, $usuario);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

            
            
           
    //         $entityManager->persist($usuario);
    //         $entityManager->flush();

    //         return $this->redirect('/admin/listausuario/1');
    //     }

    //     return $this->render('nuevousuario.html.twig', [
    //         'nuevousuarioForm' => $form->createView(),
    //         'titulo' => 'Crear'
    //     ]);
    // }


    // #[IsGranted('ROLE_ADMIN')]
    // #[Route('/admin/editausuario/{id}', name: 'app_editausuario')]
    // public function editausuario(String $id,Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $usuario = $this->userRepository->find($id);
       
    //     $form = $this->createForm(UsuarioType::class, $usuario);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

          
    //         $entityManager->persist($usuario);
    //         $entityManager->flush();

    //         return $this->redirect('/admin/listausuario/1');
    //     }

    //     return $this->render('nuevousuario.html.twig', [
    //         'nuevousuarioForm' => $form->createView(),
    //         'titulo' => 'Editar'
    //     ]);
    // }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/listausuario/{pagina}', name: 'app_listausuario')]
    public function listausuario(String $pagina,Request $request, EntityManagerInterface $entityManager): Response
    {   
        $totalRegistros = $this->userRepository->count(array());
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
        $usuarios=$this->userRepository->findBy(array(),['apellido1' => 'ASC'],$elementosPorPagina,$inicioLimite);

        return $this->render('admusuarios.html.twig', [
            'usuarios' => $usuarios,
            'totalpgs' => $totalPaginas,
            'pagina' => $pagina,
            'totalreg' => $totalRegistros,
            'iniciolimit' => $inicioLimite
        ]);
    }

     
    // #[IsGranted('ROLE_ADMIN')]
    // #[Route("/admin/deleteusuario/{id}", name: "borrausuarios")]
    // public function borrarusuarios(int $id): Response
    // {
    //     $this->userRepository->remove($this->userRepository->find($id),true);

    //     return $this->redirect('/admin/listausuario/1');
    // }
}