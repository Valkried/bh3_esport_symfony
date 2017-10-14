<?php

namespace BH3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Roster
 *
 * @ORM\Table(name="bh3_rosters")
 * @ORM\Entity(repositoryClass="BH3Bundle\Repository\RosterRepository")
 */
class Roster
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\Length(
     *    min = 2,
     *    max = 60,
     *    minMessage = "Le titre doit faire au moins 2 caractères",
     *    maxMessage = "Le titre ne doit pas dépasser 60 caractères")
     * @Assert\NotBlank(message = "Le titre doit être renseigné")
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, unique=true)
     * @Assert\File(
     *    maxSize = "300k",
     *    maxSizeMessage = "L'image ne doit pas dépasser 300ko",
     *    disallowEmptyMessage = "Le fichier ne doit pas être vide",
     *    notFoundMessage = "Le fichier n'a pas été trouvé")
     * @Assert\Image(
     *    minWidth = 1280,
     *    minWidthMessage = "L'image est trop petite (1280*410px)",
     *    maxWidth = 1280,
     *    maxWidthMessage = "L'image est trop large (1280*410px)",
     *    minHeight = 410,
     *    minHeightMessage = "L'image est trop petite (1280*410px)",
     *    maxHeight = 410,
     *    maxHeightMessage = "L'image est trop haute (1280*410px)",
     *    mimeTypes = {"image/jpeg", "image/png"},
     *    mimeTypesMessage = "Cette image n'est pas valide",
     *    sizeNotDetectedMessage = "La taille de l'image n'a pas pu être détectée")
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="BH3Bundle\Entity\Membre", mappedBy="roster")
     */
    private $membres;


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
     * Set name
     *
     * @param string $name
     *
     * @return Roster
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
     * Set picture
     *
     * @param string $picture
     *
     * @return Roster
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
     * Constructor
     */
    public function __construct()
    {
        $this->membres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add membre
     *
     * @param \BH3Bundle\Entity\Membre $membre
     *
     * @return Roster
     */
    public function addMembre(\BH3Bundle\Entity\Membre $membre)
    {
        $this->membres[] = $membre;

        $membre->setRoster($this);

        return $this;
    }

    /**
     * Remove membre
     *
     * @param \BH3Bundle\Entity\Membre $membre
     */
    public function removeMembre(\BH3Bundle\Entity\Membre $membre)
    {
        $this->membres->removeElement($membre);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Roster
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
