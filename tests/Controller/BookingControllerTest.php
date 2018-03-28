<?php

namespace tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BookingControllerTest extends WebTestCase
{
    private $client = null;


    public function testHomeIsUp()
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/booking');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('start', $crawler->filter('.title_start')->text());
    }

    public function testSelectTicketsIsUp()
    {
        $client = static::createClient();

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
        $client = static::createClient();
        $this->client->request('GET', '/tickets/end');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

}