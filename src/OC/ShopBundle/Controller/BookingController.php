<?php

namespace OC\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookingController extends Controller
{
    public function startAction()
    {
        return $this->render('shop/start.html.twig');
    }
}
