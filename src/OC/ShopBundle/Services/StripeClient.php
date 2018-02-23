<?php

/*Un service est juste une class que l'on appelle. Pourquoi ne pas le mettre dans le controller ? Pour faire plus propre . bref. On le déclare ensuite au conteneur de services. Pour récupérer ce service ds le controller on fait :
$antispam = $this->container->get('oc_platform.antispam');*/

namespace OC\ShopBundle\Services;

use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;

class StripeClient
{
	private $config;
    private $em;
    private $logger;

    public function __construct($secretKey, array $config, EntityManagerInterface $em, LoggerInterface $logger)
    {
        Stripe::setApiKey($secretKey);
        $this->config = $config;
        $this->em = $em;
        $this->logger = $logger;
    }

    public function createCharge($params, $token)
    {
        $this->config['premium_amount'] = 10;

        try {
            $charge = Charge::create([
                'amount' => $params['amount'] * 100,
                'currency' => $this->config['currency'],
                'description' => 'Testing payment',
                'source' => $token,
                'receipt_email' => $params['email'],
            ]);
        } catch (\Stripe\Error\Base $e) {
            $this->logger->error(sprintf('%s exception encountered when creating a payment: "%s"', get_class($e), $e->getMessage()), ['exception' => $e]);
            throw $e;
        }
    }
}