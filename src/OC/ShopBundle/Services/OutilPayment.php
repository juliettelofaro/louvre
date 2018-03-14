<?php

namespace OC\ShopBundle\Services;
use OC\ShopBundle\Entity\Booking;
use OC\ShopBundle\Entity\Ticket;



class OutilPayment
{
    //ces valeurs sont stockées dans les paramètres et récupérées via le constructeur
    private $ageMaxGratuit;
    private $ageMaxEnfant;
    private $tarifEnfant;
    private $ageMinSenior;
    private $tarifSenior;
    private $tarifNormal;
    private $tarifReduit;
    /**
     * OutilPayment constructor.
     * @param $ageMaxGratuit
     * @param $ageMaxEnfant
     * @param $tarifEnfant
     * @param $ageMinSenior
     * @param $tarifSenior
     * @param $tarifNormal
     * @param $tarifReduit
     */
    public function __construct()
    {
        $this->ageMaxGratuit = 4;
        $this->ageMaxEnfant = 12;
        $this->tarifEnfant = 8;
        $this->ageMinSenior = 60;
        $this->tarifSenior = 12;
        $this->tarifNormal = 16;
        $this->tarifReduit = 10;
    }

    public function calculPrixCommande(Booking $booking)
    {
        //boucle sur les tickets et mise à jour des prix
    }

    /**
     * retourne le tarif du billet en fonction de la date de naissance
     *
     *
     * @param Ticket $ticket
     * @return boolean
     * @internal param $datedenaissance
     */
    private function calculPrix(Ticket $ticket){
        $datedenaissance = $ticket->getDatedenaissance();
        $age = $this->calculAge($datedenaissance);
        if ( $age <= $this->ageMaxGratuit ){
            $prix = 0;
        }
        elseif ( $age <= $this->ageMaxEnfant )
        {
            $prix = $this->tarifEnfant;
        }
        elseif ( $ticket->getReduit())
        {
            $prix = $this->tarifReduit;
        }
        elseif( $age >= $this->ageMinSenior)
        {
            $prix = $this->tarifSenior;
        }
        else
        {
            $prix = $this->tarifNormal;
        }

        return true;
    }
    /**
     * retourne l'age en fonction de la date de naissance en datetime
     *
     * @param datetime $datedenaissance
     * @return int $age
     */
    public function calculAge($datedenaissance){
        $age = idate('Y') - $datedenaissance->format('Y');
        return $age;
    }
    public function isAdulte(Ticket $ticket)
    {
        if($this->calculAge($ticket->getDatedenaissance()) > $this->ageMaxEnfant )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>