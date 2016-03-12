<?php

namespace PDFBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PrintControllerTest extends WebTestCase
{
    public function testCreateforn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createForn');
    }

}
