<?php

namespace PDFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use WhiteOctober\TCPDFBundle as TCPDF;

class PdfController extends Controller
{
    /**
     * @Route("/Inscription")
     */
    public function InscriptionAction()
    {


        $pdf = $this->get("white_october.tcpdf")->create();
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
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

// Set some content to print
        $html = <<<EOD
               <!doctype html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <title>Document</title>

                    </head>
                    <body>
                    <img src="bundle\logo_sca.png" width="20%" alt="">
                    </body>
               </html>
EOD;

// Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');

        $response = new Response($pdf->Output('example_002.pdf','D'));
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;


        //return $this->render('AppBundle:PdfController:inscription.html.twig', array(
            // ...
       // ));
    }

}
