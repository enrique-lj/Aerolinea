<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Facturacion;
use App\Entity\Reserva;
use App\Entity\User;
use App\Service\GeneraQR;

class CrearPDF extends AbstractController
{

    private $qr;

    public function __construct(GeneraQR $qr)
    {
        $this->qr = $qr;
    }

    public function generarfactura1(Facturacion $factura1,int $preciototal)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        
     
            $html = $this->renderView('facturacion.html.twig', [
                "factura1" => $factura1,
                "preciototal" => $preciototal,
                "qr" => $this->qr->Simple(),
            ]);
        
       
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        header("Content-type: facturacion/pdf");
        header("Content-Disposition: inline; filename=documento.pdf");
        $dompdf->render();
        $dompdf->stream("facturacion.pdf", [
            "Attachment" => true
        ]);

        return $dompdf->output();

        // Output the generated PDF to Browser (inline view)
        /*$dompdf->stream("invitacion.pdf", [
            "Attachment" => false
        ]);*/
    }

    public function generarfactura2(Facturacion $factura1,Facturacion $factura2 = null ,int $preciototal)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        
     
            $html = $this->renderView('facturacion.html.twig', [
                "factura1" => $factura1,
                "factura2" => $factura2,
                "preciototal" => $preciototal,
                "qr" => $this->qr->Simple(),
            ]);
      
       
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        header("Content-type: facturacion/pdf");
        header("Content-Disposition: inline; filename=documento.pdf");
        $dompdf->render();
        $dompdf->stream("facturacion.pdf", [
            "Attachment" => true
        ]);

        return $dompdf->output();

        // Output the generated PDF to Browser (inline view)
        /*$dompdf->stream("invitacion.pdf", [
            "Attachment" => false
        ]);*/
    }


    public function generartarjeta(Reserva $reserva)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        
        $html = $this->renderView('tarjetaembarque.html.twig', [
            "reserva" => $reserva,
            "qr" => $this->qr->Simple(),
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=documento.pdf");
        $dompdf->render();
        $dompdf->stream("invitacion.pdf", [
            "Attachment" => false
        ]);

        return $dompdf->output();

        // Output the generated PDF to Browser (inline view)
        /*$dompdf->stream("invitacion.pdf", [
            "Attachment" => false
        ]);*/
    }

}

?>