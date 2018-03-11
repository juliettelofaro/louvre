<?php

namespace OC\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use OC\ShopBundle\Validator as MyAssert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="OC\ShopBundle\Repository\BookingRepository")
 * @MyAssert\CanBeFullDay()
 * @MyAssert\NoFull()
 * @MyAssert\NoHoliday()
 */
class Booking
{

    const MAX_TICKETS_PER_DAY = 1000;
    const LIMIT_HALF_DAY_HOUR = 14;
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
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedevisite", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     * @Assert\GreaterThanOrEqual(
     *      "today",
     *      message = "merci ne pas choisir une date antérieure à celle du jour.."
     * )
     */
    private $datedevisite;

    /**
     * @var bool
     *
     * @ORM\Column(name="duree", type="boolean")
     * @Assert\Type(type="boolean")
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;


    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="booking",cascade={"persist"})

     */
    protected $tickets;



    /**

    * @Assert\NotBlank()
     * @ASSERT\Range(
     *     min = 1,
     *     max = 10
     * )

     */
    private $nbTickets;

    public function getNbTickets()
    {
        return $this->nbTickets;
    }
    public function setNbTickets($nbTickets)
    {
        $this->nbTickets =  $nbTickets;
    }

 public function __construct()
    {
    $this->datedevisite = new \DateTime();
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = str_split(str_shuffle($str), 4)[0];
        $this->code = rand(1000,9999).$str;
        $this->tickets = new ArrayCollection();
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
     * @return Booking
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
     * @return Booking
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
     * Set email
     *
     * @param string $email
     *
     * @return Booking
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set datedevisite
     *
     * @param \DateTime $datedevisite
     *
     * @return Booking
     */
    public function setDatedevisite($datedevisite)
    {
        $this->datedevisite = $datedevisite;

        return $this;
    }

    /**
     * Get datedevisite
     *
     * @return \DateTime
     */
    public function getDatedevisite()
    {
        return $this->datedevisite;
    }

    /**
     * Set duree
     *
     * @param boolean $duree
     *
     * @return Booking
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return bool
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Booking
     */
    public function setCode($code)
    {
        $this->code = strtolower($code);

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }


        /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Add ticket
     *
     * @param \OC\ShopBundle\Entity\Ticket $ticket
     *
     * @return Booking
     */
    public function addTickets(\OC\ShopBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \OC\ShopBundle\Entity\Ticket $ticket
     */
    public function removeTickets(\OC\ShopBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }
}
