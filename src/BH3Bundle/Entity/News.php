<?php

namespace BH3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table(name="bh3_news")
 * @ORM\Entity(repositoryClass="BH3Bundle\Repository\NewsRepository")
 */
class News
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Assert\Length(
     *    min = 10,
     *    max = 60,
     *    minMessage = "Le titre doit faire au moins 10 caractères",
     *    maxMessage = "Le titre ne doit pas dépasser 60 caractères")
     * @Assert\NotBlank(message = "Le titre doit être renseigné")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(
     *    min = 50,
     *    minMessage = "Le contenu doit faire au moins 50 caractères")
     * @Assert\NotBlank(message = "Le contenu doit être renseigné")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="BH3Bundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

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
     *    minWidthMessage = "L'image est trop petite (1280*512px)",
     *    maxWidth = 1280,
     *    maxWidthMessage = "L'image est trop large (1280*512px)",
     *    minHeight = 512,
     *    minHeightMessage = "L'image est trop petite (1280*512px)",
     *    maxHeight = 512,
     *    maxHeightMessage = "L'image est trop haute (1280*512px)",
     *    mimeTypes = {"image/jpeg", "image/png"},
     *    mimeTypesMessage = "Cette image n'est pas valide",
     *    sizeNotDetectedMessage = "La taille de l'image n'a pas pu être détectée")
     */
    private $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     * @Assert\Type(
     *     type="bool",
     *     message="La valeur {{ value }} n'est pas valide {{ type }}")
     */
    private $published;


    public function __construct()
    {
        $this->setDate(new \Datetime);
        $this->setPublished(false);
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
     * Set title
     *
     * @param string $title
     *
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return News
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return News
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return News
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set author
     *
     * @param \BH3Bundle\Entity\User $author
     *
     * @return News
     */
    public function setAuthor(\BH3Bundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \BH3Bundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
