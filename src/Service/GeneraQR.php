<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Font\NotoSans;

class GeneraQR extends AbstractController
{

    public function Img(): Response
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create('https://www.binaryboxtuts.com/')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $logo = Logo::create('assets/imgs/logoxocas.png')
            ->setResizeToWidth(60);
        $label = Label::create('')->setFont(new NotoSans(8));
 
        $qrCodes = $writer->write($qrCode, $logo)->getDataUri();
        return $qrCodes;
    }

    public function Simple()
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create('https://www.binaryboxtuts.com/')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
 
        $qrCodes = $writer->write($qrCode,null,null)->getDataUri();
        
        return $qrCodes;
    }

    public function Acolor(): Response
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create('https://www.binaryboxtuts.com/')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
    
 
        $qrCodes = $writer->write(
            $qrCode,
            null
            //$label->setText('Color Change')
        )->getDataUri();
 
        $qrCode->setForegroundColor(new Color(0, 0, 0))->setBackgroundColor(new Color(255, 0, 0));
 
        return $qrCodes;
    }


    public function BgColor(): Response
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create('https://www.binaryboxtuts.com/')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
 
        $qrCodes = $writer->write(
            $qrCode,
            null,
            null//$label->setText('Background Color Change') 
        )->getDataUri();
 
        $qrCode->setSize(200)->setForegroundColor(new Color(0, 0, 0))->setBackgroundColor(new Color(255, 255, 255));
     
        return $qrCodes;
    }

    public function ConImg(): Response
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create('https://www.binaryboxtuts.com/')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $logo = Logo::create('assets/imgs/aires2.png')
            ->setResizeToWidth(60);
        $label = Label::create('')->setFont(new NotoSans(8));
 
        $qrCodes= $writer->write(
            $qrCode,
            $logo
            //$label->setText('With Image')->setFont(new NotoSans(20))
        )->getDataUri();
 
        return $qrCodes;
    }

}

?>