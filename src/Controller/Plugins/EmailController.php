<?php
namespace App\Controller\Plugins;

use App\Entity\Facturacion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Service\EnviaCorreo;
use App\Service\CrearPDF;
use Doctrine\Persistence\ManagerRegistry;


class EmailController extends AbstractController
{

    private $mailer;


    public function __construct(private ManagerRegistry $doctrine,EnviaCorreo $mailer)
     {
         $this->mailer = $mailer;
      
     }

    #[Route('/admin/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('enrique.lopez.jime@gmail.com')
            ->to('elopjim366@g.educaand.es')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Primer Correo Prueba')
            ->text('Hola holaaa este es un correo de prueba jejeje')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        // ...
    }

    #[Route('/admin/sendimg')]
    public function sendImg(MailerInterface $mailer): Response
    {
        $email = (new TemplatedEmail())
        ->from('enrique.lopez.jime@gmail.com')
        ->to(new Address('elopjim366@g.educaand.es'))
        ->subject('CARTEL')
        ->addPart((new DataPart(fopen('C:\xampp\htdocs\symfony\asociacion\public\assets\imgs\cartel2.jpg', 'r'), 'cartel2', 'image/jpg'))->asInline())
        ->html('<img src="cid:cartel">')
        ->html('<div background="cid:cartel">  </div> ')
        ->htmlTemplate('emails.html.twig')
        ->context([
            'expiration_date' => new \DateTime('+7 days'),
            'username' => 'enrique',
        ]);

        try {
            $mailer->send($email);
        return 'ok';
        } catch (TransportExceptionInterface $e) {
            return 'some error prevented the email sending; display an';
            // error message or try to resend the message
        }
    }

    #[Route('/admin/pdf')]
    public function invitar():Response
    {
         return $this->mailer->InvitacionPdf3();
    }

   
}
?>