<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AvionController extends AbstractController
{
  
    #[Route('/nuevoavion', name: 'nuevoavion')]
    public function index(): Response
    {
        return $this->render('nuevoavion.html.twig');
       
    }
}

?>