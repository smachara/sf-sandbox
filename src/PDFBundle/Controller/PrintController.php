<?php

namespace PDFBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PrintController extends Controller
{
    /**
     * @Route("/print-form")
     */
    public function printAction()
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
        $pdf->setFontSubsetting(false);

// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->renderView('PDFBundle:Print:print.html.twig', array());
        dump($html);
        die();
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    }

}
