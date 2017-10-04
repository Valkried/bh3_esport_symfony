<?php

namespace BH3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string", length=255, nullable=true)
     */
    private $rank = null;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter = null;

    /**
     * @var string
     *
     * @ORM\Column(name="profile", type="string", length=255, nullable=true)
     */
    private $profile = null;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture = 'tete-bh3.png';

    /**
     * @var string
     *
     * @ORM\Column(name="plateforme", type="string", length=255)
     */
    private $plateforme = 'website';

    /**
     * @var bool
     *
     * @ORM\Column(name="staff", type="boolean")
     */
    private $staff = false;

    /**
     * @ORM\ManyToOne(targetEntity="BH3Bundle\Entity\Roster", inversedBy="membres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roster;


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
