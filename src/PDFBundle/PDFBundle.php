<?php

namespace PDFBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;


class PDFBundle extends Bundle
{
    public function getParent()
    {
        return 'WhiteOctoberTCPDFBundle';
    }
    public function boot()
    {

        if (!$this->container->hasParameter('white_october_tcpdf.tcpdf')) {
            return;
        }

        // Define our TCPDF variables
        $config = $this->container->getParameter('white_october_tcpdf.tcpdf');

        // TCPDF needs some constants defining if our configuration
        // determines we should do so (default true)
        // Set tcpdf.k_tcpdf_external_config to false to use the TCPDF
        // core defaults
        if ($config['k_tcpdf_external_config'])
        {

            foreach ($config as $k => $v)
            {
                $constKey = strtoupper($k);

                if (preg_match("/^pdf_/i", $k)) {
                    if (!defined($constKey)) {
                        define($constKey, $v);
                    }
                }
            }
        }
    }
}
