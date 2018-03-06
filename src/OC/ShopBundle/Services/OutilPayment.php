<?php

namespace OC\ShopBundle\Services\OutilPayment;
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
    public function __construct($ageMaxGratuit, $ageMaxEnfant, $tarifEnfant, $ageMinSenior, $tarifSenior, $tarifNormal, $tarifReduit)
    {
        $this->ageMaxGratuit = $ageMaxGratuit;
        $this->ageMaxEnfant = $ageMaxEnfant;
        $this->tarifEnfant = $tarifEnfant;
        $this->ageMinSenior = $ageMinSenior;
        $this->tarifSenior = $tarifSenior;
        $this->tarifNormal = $tarifNormal;
        $this->tarifReduit = $tarifReduit;
    }
    /**
     * retourne le tarif du billet en fonction de la date de naissance
     *
     *
     * @param Ticket $ticket
     * @return boolean
     * @internal param $datedenaissance
     */
    public function calculPrix(Ticket $ticket){
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