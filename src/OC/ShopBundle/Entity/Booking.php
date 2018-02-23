<?php

namespace OC\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="OC\ShopBundle\Repository\BookingRepository")
 */
class Booking
{
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
     * @Assert\Time()
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
     * @ASSERT\Range(
     *     min = 1,
     *     max = 10
     * )
     */
    protected $tickets;


 public function __construct()
    {
    
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = str_split(str_shuffle($str), 4)[0];
        $this->code = rand(1000,9999).$str;
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
}

