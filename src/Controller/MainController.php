<?php

namespace App\Controller;

use App\Entity\Aeropuerto;
use App\Repository\AeropuertoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    private $AeropuertoRepository;

    public function __construct(AeropuertoRepository $aeropuertoRepository)
    {
        $this->AeropuertoRepository = $aeropuertoRepository;
    }
  
    #[Route('/', name: 'home')]
    public function index(): Response
    {

        return $this->render('landin.html.twig',['aeropuertos' => $this->AeropuertoRepository->getaeropuertosjson()]);
       
    }
}