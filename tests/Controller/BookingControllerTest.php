<?php

namespace tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class BookingControllerTest extends WebTestCase
{
    private $client = null;




    public function testHomeIsUp()
    {

        $client = static::createClient();

        //effectuer une requête -> création du client HTTP (navigateur)
        $crawler = $client->request('GET', '/booking');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        //Permet de verifier si dans le contenu div (start) on a une class .title_start
        $this->assertContains('start', $crawler->filter('.title_start')->text());

    }

    public function testSelectTicketsIsUp()
    {
        $client = static::createClient();
        //effectuer une requête -> création du client HTTP (navigateur)
        $crawler = $client->request('get', '/booking');
        $form = $crawler->selectButton('Valider')->form();
        $form['nbTickets'] = 2;

        $crawler = $client->submit($form);


        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }

    public function testRecapIsUp()
    {
        $client = static::createClient();
        $this->client->request('GET', '/tickets/payment');
        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }

    public function testConfirmationIsUp()
    {
        //effectuer une requête -> création du client HTTP (navigateur)
        $client = static::createClient();
        $this->client->request('GET', '/tickets/end');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

}