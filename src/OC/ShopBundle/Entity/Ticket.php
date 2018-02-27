<?php

namespace OC\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="OC\ShopBundle\Repository\TicketRepository")
 */
class Ticket
{
    
 /**
 * @ORM\ManyToOne(targetEntity="Booking", inversedBy="tickets", cascade={"persist"})
 * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
 */
    private $booking;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Regex( pattern="#^(?!-)[\p{L}- ]{2,20}[^\-]$#u", message="prenom.wrong")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Regex( pattern="#^(?!-)[\p{L}- ]{2,20}[^\-]$#u", message="nom.wrong")
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedenaissance", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     * @Assert\LessThan(
     *     "today",
     *     message = "merci de vérifier la date de naissance"
     * )
     */
    private $datedenaissance;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduit", type="boolean")
     */
    private $reduit;

    /**
     * @var int
     *
     * @ORM\Column(name="booking_id", type="integer")
     */
    private $bookingId;




    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->reduced      = false;
        $this->type         = 'NORMAL';
    }






    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Ticket
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Ticket
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set datedenaissance
     *
     * @param \DateTime $datedenaissance
     *
     * @return Ticket
     */
    public function setDatedenaissance($datedenaissance)
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }

    /**
     * Get datedenaissance
     *
     * @return \DateTime
     */
    public function getDatedenaissance()
    {
        return $this->datedenaissance;
    }

    /**
     * Set reduit
     *
     * @param boolean $reduit
     *
     * @return Ticket
     */
    public function setReduit($reduit)
    {
        $this->reduit = $reduit;

        return $this;
    }

    /**
     * Get reduit
     *
     * @return bool
     */
    public function getReduit()
    {
        return $this->reduit;
    }

    /**
     * Set bookingId
     *
     * @param integer $bookingId
     *
     * @return Ticket
     */
    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;

        return $this;
    }

    /**
     * Get bookingId
     *
     * @return int
     */
    public function getBookingId()
    {
        return $this->bookingId;
    }


    public function getAge()
    {
        return $this->getDatedenaissance()->diff(new \DateTime())->y;
    }
}

