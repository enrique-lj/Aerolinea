<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentController extends AbstractController
{

    #[Route('/payment', name: 'payment')]
    public function index(): Response
    {
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }


    #[Route('/checkout')]
    public function checkout(Request $request,$stripeSK): Response
    {
        Stripe::setApiKey($stripeSK);
       $precio = intval(str_replace(",", "", $request->request->get('preciototal')));
       $precio=$precio.'00';
       $precio = intval($precio);
       $vueloidaid=$request->request->get('vueloidaid');
       $vuelovueltaid=$request->request->get('vuelovueltaid');
       $asientoidaid=$request->request->get('asientoidaid');
       $asientovueltaid=$request->request->get('asientovueltaid');
       $tarifaid=$request->request->get('tarifaid');


       $successUrlParams = [
        'vueloidaid' => $vueloidaid,
        'asientoidaid' => $asientoidaid,
        'tarifaid' => $tarifaid,
    ];

    if ($vuelovueltaid !== null && $asientovueltaid !== null) {
        $successUrlParams['vuelovueltaid'] = $vuelovueltaid;
        $successUrlParams['asientovueltaid'] = $asientovueltaid;
        $successUrl = $this->generateUrl('finalizareservadoble', $successUrlParams, UrlGeneratorInterface::ABSOLUTE_URL);
    }   
    else
    {
        $successUrl = $this->generateUrl('finalizareserva', $successUrlParams, UrlGeneratorInterface::ABSOLUTE_URL);
    }
       
    

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => 'Reserva Vuelos',
                        ],
                        'unit_amount'  => $precio,
                    ],
                    'quantity'   => 1,
                ]
            ],
            'mode'                 => 'payment',
            'success_url'          => $successUrl,
            'cancel_url'           => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($session->url, 303);
    }


    #[Route('/success-url', name: 'success_url')]
    public function successUrl(): Response
    {
        return $this->render('payment/success.html.twig', []);
    }


    #[Route('/cancel-url', name: 'cancel_url')]
    public function cancelUrl(): Response
    {
        return $this->render('payment/cancel.html.twig', []);
    }
}