<?php

namespace PDFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use WhiteOctober\TCPDFBundle as TCPDF;
use TCPDF2DBarcode;
class PrintController extends Controller
{
    /**
     * @Route("/print-form")
     */
    public function printAction()
    {
        $barcodeobj = new TCPDF2DBarcode('http://l.sandbox.com/app_dev.php/print-form', 'QRCODE,H');
        $qr = $barcodeobj->getBarcodeSVGcode( 3, 3, 'black');
        return $this->render('PDFBundle:Print:print.html.twig', array( 'preview' => true, 'qr' => $qr));
    }

}
