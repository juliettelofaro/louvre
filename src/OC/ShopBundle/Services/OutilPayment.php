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


    /**
     * retourne le tarif du billet en fonction de la date de naissance
     *
     *
     * @param Ticket $ticket
     * @return boolean
     * @internal param $datedenaissance
     */
    public function calculPrix(Ticket $ticket){
        $age = $this->calculAge($ticket);
        if ( $age <= $this->ageMaxGratuit ){
           $ticket->setPrix(0);
        }
        elseif ( $age <= $this->ageMaxEnfant )
        {
             $ticket->setPrix($this->tarifEnfant);
        }
        elseif ( $ticket->getReduit())
        {
             $ticket->setPrix($this->tarifReduit);
        }
        elseif( $age >= $this->ageMinSenior)
        {
            $ticket->setPrix($this->tarifSenior);
        }
        else
        {
             $ticket->setPrix($this->tarifNormal);
        }
        //doit rmeplir lattribut $prix de lentité ticket et return cet attribut à calculCommande
    }


    public function calculPrixCommande(Booking $booking)
    {
        $prixTotal = 0;
        //boucle sur les tickets et mise à jour des prix
        foreach($booking->getTickets() as $ticket)
        {
            $this->calculPrix($ticket);
           // $chaqueTicket = $ticket->calculPrix();
            $prixTotal += $ticket->getPrix();
            //doit récupérer lattribut prix renvoyé par calculPrix et l'additioner
        }
        $booking->setPrixTotal($prixTotal);
        return $prixTotal;
    }






    /**
     * retourne l'age en fonction de la date de naissance en datetime
     *
     * @param datetime $datedenaissance
     * @param Ticket $ticket
     * @param Booking $booking
     * @return int $age
     */
    public function calculAge(Ticket $ticket){
        //calculer l'âge qu'il aura
        $datetime2 = $ticket->getDatedenaissance();
        $datetime3 = $ticket->getBooking()->getDatedevisite(); // date de résa
        $age = $datetime3->diff($datetime2, true)->y; // le y = nombre d'années ex : 22
        return $age;
    }



}
?>