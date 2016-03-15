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
        $pdf = $this->get("white_october.tcpdf")->create();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $barcodeobj = new TCPDF2DBarcode('http://l.sandbox.com/app_dev.php/print-form', 'QRCODE,H');

        $qr = $barcodeobj->getBarcodeSVGcode( 3, 3, 'black');

        $pdf->AddPage();

    $html = $this->renderView('PDFBundle:Print:print.content.pdf.html.twig', array( 'preview' => false, 'qr' => $qr));
            $pdf->writeHTML($html, true, false, true, false, '');
            //$pdf->Output('example_001.pdf', 'I');
     //       $response = new Response($pdf->Output('example_002.pdf','D'));
     //       $response->headers->set('Content-Type', 'application/pdf');
            //return $response;

    return $this->render('PDFBundle:Print:print.content.pdf.html.twig', array( 'preview' => true, 'qr' => $qr));

    }

}
