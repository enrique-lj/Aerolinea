<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;



class ProfileController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    #[Route('/profile/{email}', name: 'app_user_profile')]
    public function mostrarperfil(String $email,Request $request,EntityManagerInterface $entityManager): Response
    {
        $usuario=$this->userRepository->findOneByEmail($email);
        $form = $this->createForm(RegistrationFormType::class, $usuario);
        $form->handleRequest($request);
        return $this->render('profile/index.html.twig', [
            'registrationForm' => $form->createView(),
            'usuario' => $usuario,
        ]);
    }


    #[Route('/profile/editarperfil/{id}', name: 'app_edit_profile')]
    public function editarperfil(string $id,Request $request,UserPasswordHasherInterface $userPasswordHasher,EntityManagerInterface $entityManager): Response
    {
        
        $usuario = $this->userRepository->find($id);
        
        $form = $this->createForm(RegistrationFormType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $usuario->setPassword(
                $userPasswordHasher->hashPassword(
                    $usuario,
                    $form->get('plainPassword')->getData()
                )
            );
     
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirect("/profile/". $usuario->getEmail());
        }

        return $this->render('profile/editar.html.twig', [
            'registrationForm' => $form->createView(),
            'usuario' => $usuario,
        ]);
    }

    
}
?>