<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use App\Service\CrearPDF;
use App\Entity\Facturacion;
use App\Entity\Reserva;



class EnviaCorreo
{

    private $pdf;
    private $mailer;

    public function __construct(CrearPDF $pdf,MailerInterface $mailer)
    {
        $this->pdf = $pdf;
        $this->mailer = $mailer;
    }

    
    public function enviaCorreo(): void
    {    

        $email = (new Email())
        ->from('enrique.lopez.jime@gmail.com')
        ->to('enrique.lopez.jime@gmail.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('presentacion')
        ->text('hola')
        ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }

    public function NotificaCancelacion(Reserva $reserva): void
    {    

        $email = (new Email())
        ->from('enrique.lopez.jime@gmail.com')
        ->to('enrique.lopez.jime@gmail.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Cancelación de reserva')
        ->text('Cancelación de reserva de mesa '.$reserva->getMesa()->getId().' y juego '.$reserva->getJuego()->getNombre().'
        a dia '.$reserva->getFechacancelacion()->format('Y-m-d').'');
        

        $this->mailer->send($email);
    }

    public function enviofactura1(Facturacion $factura1,int $preciototal): void
    {    
      
            $email = (new TemplatedEmail())
            ->from('enrique.lopez.jime@gmail.com')
            ->to('enrique.lopez.jime@gmail.com')
            ->subject('Factura reserva de vuelo Aires')
            ->text('Factura de su ultima reserva con Aires. Gracias por su confianza.')
            //->html('<img src="cid:cartel'.$ev->getCartel().'">')
            ->attach($this->pdf->generarfactura1($factura1,$preciototal),"aplication.pdf")
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'enrique',
            ]);
               
            $this->mailer->send($email);

    }

    public function enviofactura2(Facturacion $factura1,Facturacion $factura2,int $preciototal): void
    {    
      
            $email = (new TemplatedEmail())
            ->from('enrique.lopez.jime@gmail.com')
            ->to('enrique.lopez.jime@gmail.com')
            ->subject('Factura reserva de vuelo Aires')
            ->text('Factura de su ultima reserva con Aires. Gracias por su confianza.')
            //->html('<img src="cid:cartel'.$ev->getCartel().'">')
            ->attach($this->pdf->generarfactura2($factura1,$factura2,$preciototal),"aplication.pdf")
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'enrique',
            ]);
               
            $this->mailer->send($email);

    }

    public function enviotarjeta(Reserva $reserva): void
    {    

        $email = (new TemplatedEmail())
        ->from('enrique.lopez.jime@gmail.com')
        ->to('enrique.lopez.jime@gmail.com')
        ->subject('Tarjeta de embarque')
        ->text('Aqui tiene su tarjeta de embaque. Esperamos que tenga un buen viaje.')
        //->html('<img src="cid:cartel'.$ev->getCartel().'">')
        ->attach($this->pdf->generartarjeta($reserva),"aplication.pdf")
        ->context([
            'expiration_date' => new \DateTime('+7 days'),
            'username' => 'enrique',
        ]);
           
        $this->mailer->send($email);  

    }

}

?>