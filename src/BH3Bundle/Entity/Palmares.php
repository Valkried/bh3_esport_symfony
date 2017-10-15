<?php

namespace BH3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Palmares
 *
 * @ORM\Table(name="bh3_palmares")
 * @ORM\Entity(repositoryClass="BH3Bundle\Repository\PalmaresRepository")
 */
class Palmares
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
     * @ORM\Column(name="game", type="string", length=255)
     * @Assert\NotBlank(message = "Le jeu doit être renseigné")
     */
    private $game;

    /**
     * @var string
     *
     * @ORM\Column(name="roster", type="string", length=255)
     * @Assert\Length(
     *    min = 2,
     *    max = 25,
     *    minMessage = "Le roster doit faire au moins 2 caractères",
     *    maxMessage = "Le roster ne doit pas dépasser 25 caractères")
     * @Assert\NotBlank(message = "Le roster doit être renseigné")
     */
    private $roster;

    /**
     * @var string
     *
     * @ORM\Column(name="event", type="string", length=255)
     * @Assert\Length(
     *    min = 2,
     *    max = 25,
     *    minMessage = "L'événement doit faire au moins 2 caractères",
     *    maxMessage = "L'événement ne doit pas dépasser 25 caractères")
     * @Assert\NotBlank(message = "L'événement doit être renseigné")
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255)
     * @Assert\Length(
     *    min = 2,
     *    max = 25,
     *    minMessage = "La localisation doit faire au moins 2 caractères",
     *    maxMessage = "La localisation ne doit pas dépasser 25 caractères")
     * @Assert\NotBlank(message = "La localisation doit être renseignée")
     */
    private $localisation;

    /**
     * @var string
     *
     * @ORM\Column(name="ranking", type="string", length=255)
     * @Assert\Length(
     *    min = 2,
     *    max = 10,
     *    minMessage = "Le rang doit faire au moins 2 caractères",
     *    maxMessage = "Le rang ne doit pas dépasser 10 caractères")
     * @Assert\NotBlank(message = "Le rang doit être renseigné")
     */
    private $ranking;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="smallint", length=255)
     * @Assert\Type("int")
     * @Assert\Range(
     *      min = 2000,
     *      max = 2050,
     *      minMessage = "La date ne peut être inférieure à 2000",
     *      maxMessage = "La date ne peut être supérieure à 2050")
     */
    private $date;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"game"}, unique=false)
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;


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
     * Set game
     *
     * @param string $game
     *
     * @return Palmares
     */
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return string
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set roster
     *
     * @param string $roster
     *
     * @return Palmares
     */
    public function setRoster($roster)
    {
        $this->roster = $roster;

        return $this;
    }

    /**
     * Get roster
     *
     * @return string
     */
    public function getRoster()
    {
        return $this->roster;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return Palmares
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     *
     * @return Palmares
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set ranking
     *
     * @param string $ranking
     *
     * @return Palmares
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * Get ranking
     *
     * @return string
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Palmares
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Palmares
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
        return $this->picture.'.png';
    }
}
