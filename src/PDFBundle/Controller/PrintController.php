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

        return $this->render('PDFBundle:Print:print.html.twig', array(
            'pdf' => $pdf,
        ));
    }

}
