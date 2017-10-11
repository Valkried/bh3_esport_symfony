<?php

namespace BH3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Membre
 *
 * @ORM\Table(name="bh3_membres")
 * @ORM\Entity(repositoryClass="BH3Bundle\Repository\MembreRepository")
 */
class Membre
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
     * @ORM\Column(name="pseudo", type="string", length=255, unique=true)
     * @Assert\Length(
     *    min = 2,
     *    max = 60,
     *    minMessage = "Le pseudo doit faire au moins 2 caractères",
     *    maxMessage = "Le pseudo ne doit pas dépasser 60 caractères")
     * @Assert\NotBlank(message = "Le pseudo doit être renseigné")
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(
     *    min = 2,
     *    max = 60,
     *    minMessage = "Le prénom doit faire au moins 2 caractères",
     *    maxMessage = "Le prénom ne doit pas dépasser 60 caractères")
     * @Assert\NotBlank(message = "Le prénom doit être renseigné")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(message = "L'email {{ value }} n'est pas valide", checkMX = true)
     * @Assert\NotBlank(message = "L'email doit être renseigné")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string", length=255, nullable=true)
     * @Assert\Length(
     *    max = 60,
     *    maxMessage = "La fonction ne doit pas dépasser 60 caractères")
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     * @Assert\Length(
     *    max = 255,
     *    maxMessage = "Le twitter ne doit pas dépasser 255 caractères")
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="profile", type="string", length=255, nullable=true)
     * @Assert\Url(
     *    message = "L'url '{{ value }}' n'est pas valide",
     *    checkDNS = true,
     *    dnsMessage = "L'hôte '{{ value }}' n'a pas pu être trouvé")
     * @Assert\Length(
     *    max = 255,
     *    maxMessage = "L'url ne doit pas dépasser 255 caractères")
     */
    private $profile;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     * @Assert\File(
     *    maxSize = "100k",
     *    maxSizeMessage = "L'image ne doit pas dépasser 100ko",
     *    disallowEmptyMessage = "Le fichier ne doit pas être vide",
     *    notFoundMessage = "Le fichier n'a pas été trouvé")
     * @Assert\Image(
     *    minWidth = 250,
     *    minWidthMessage = "L'image est trop petite (250*250px)",
     *    maxWidth = 250,
     *    maxWidthMessage = "L'image est trop large (250*250px)",
     *    minHeight = 250,
     *    minHeightMessage = "L'image est trop petite (250*250px)",
     *    maxHeight = 250,
     *    maxHeightMessage = "L'image est trop haute (250*250px)",
     *    mimeTypes = {"image/jpeg", "image/png"},
     *    mimeTypesMessage = "Cette image n'est pas valide",
     *    sizeNotDetectedMessage = "La taille de l'image n'a pas pu être détectée")
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="plateforme", type="string", length=255)
     * @Assert\Length(
     *    max = 255,
     *    maxMessage = "La plateforme ne doit pas dépasser 255 caractères")
     */
    private $plateforme;

    /**
     * @var bool
     *
     * @ORM\Column(name="staff", type="boolean")
     * @Assert\Type(
     *     type="bool",
     *     message="La valeur {{ value }} n'est pas valide {{ type }}")
     * @Assert\NotBlank(message = "La plateforme doit être sélectionnée")
     */
    private $staff;

    /**
     * @ORM\ManyToOne(targetEntity="BH3Bundle\Entity\Roster", inversedBy="membres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roster;


    public function __construct()
    {
        $this->setRank(null);
        $this->setTwitter(null);
        $this->setProfile(null);
        $this->setPlateforme('website');
        $this->setStaff(false);
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
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Membre
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Membre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Membre
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
     * Set rank
     *
     * @param string $rank
     *
     * @return Membre
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return string
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Membre
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set profile
     *
     * @param string $profile
     *
     * @return Membre
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Membre
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set plateforme
     *
     * @param string $plateforme
     *
     * @return Membre
     */
    public function setPlateforme($plateforme)
    {
        $this->plateforme = $plateforme;

        return $this;
    }

    /**
     * Get plateforme
     *
     * @return string
     */
    public function getPlateforme()
    {
        return $this->plateforme;
    }

    /**
     * Set staff
     *
     * @param boolean $staff
     *
     * @return Membre
     */
    public function setStaff($staff)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
     * Get staff
     *
     * @return bool
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Set roster
     *
     * @param \BH3Bundle\Entity\Roster $roster
     *
     * @return Membre
     */
    public function setRoster(\BH3Bundle\Entity\Roster $roster)
    {
        $this->roster = $roster;

        return $this;
    }

    /**
     * Get roster
     *
     * @return \BH3Bundle\Entity\Roster
     */
    public function getRoster()
    {
        return $this->roster;
    }
}
