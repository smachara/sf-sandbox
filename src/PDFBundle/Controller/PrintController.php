<?php

namespace PDFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use WhiteOctober\TCPDFBundle as TCPDF;

class PrintController extends Controller
{
    /**
     * @Route("/print-form")
     */
    public function printAction()
    {

        $pdf = $this->get("white_october.tcpdf")->create();
/*
    //--------------------------------------------------------
    // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT,
                PDF_MARGIN_TOP,
                PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // ---------------------------------------------------------
    //// set default font subsetting mode
            $pdf->setFontSubsetting(true);
*/
//// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

//-------------------------------------------------

// define some HTML content with style
    $html = $this->renderView('PDFBundle:Print:print.content.pdf.html.twig', array( 'preview' => false));
   // dump($html);
   // die();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('example_001.pdf', 'I');
        $response = new Response($pdf->Output('example_002.pdf','D'));
        $response->headers->set('Content-Type', 'application/pdf');
        return $response;
        //return $this->render('PDFBundle:Print:print.content.pdf.html.twig', array( 'preview' => true));

    }

}
