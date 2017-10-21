<?php

namespace BH3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partenaire
 *
 * @ORM\Table(name="bh3_partenaires")
 * @ORM\Entity(repositoryClass="BH3Bundle\Repository\PartenaireRepository")
 */
class Partenaire
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
     *    max = 50,
     *    minMessage = "Le nom doit faire au moins 2 caractères",
     *    maxMessage = "Le nom ne doit pas dépasser 50 caractères")
     * @Assert\NotBlank(message = "Le nom doit être rempli")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(
     *    min = 10,
     *    max = 500,
     *    minMessage = "Le contenu doit faire au moins 10 caractères",
     *    maxMessage = "Le contenu ne doit pas dépasser 500 caractères")
     * @Assert\NotBlank(message = "Le contenu doit être rempli")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, unique=true)
     * @Assert\File(
     *    maxSize = "300k",
     *    maxSizeMessage = "Le logo ne doit pas dépasser 300ko",
     *    disallowEmptyMessage = "Le fichier ne doit pas être vide",
     *    notFoundMessage = "Le fichier n'a pas été trouvé")
     * @Assert\Image(
     *    minWidth = 100,
     *    minWidthMessage = "Le logo est trop petit (minimum 100px)",
     *    maxWidth = 500,
     *    maxWidthMessage = "Le logo est trop large (maximum 500px)",
     *    minHeight = 100,
     *    minHeightMessage = "Le logo est trop petit (minimum 100px)",
     *    maxHeight = 150,
     *    maxHeightMessage = "Le logo est trop haut (maximum 150px)",
     *    mimeTypes = {"image/jpeg", "image/png"},
     *    mimeTypesMessage = "Cette image n'est pas valide",
     *    sizeNotDetectedMessage = "La taille de l'image n'a pas pu être détectée")
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     * @Assert\Url(
     *    message = "L'url '{{ value }}' n'est pas valide",
     *    checkDNS = true,
     *    dnsMessage = "L'hôte '{{ value }}' n'a pas pu être trouvé")
     * @Assert\Length(
     *    max = 255,
     *    maxMessage = "L'url ne doit pas dépasser 255 caractères")
     * @Assert\NotBlank(message = "L'url doit être indiquée")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     * @Assert\Url(
     *    message = "L'url '{{ value }}' n'est pas valide",
     *    checkDNS = true,
     *    dnsMessage = "L'hôte '{{ value }}' n'a pas pu être trouvé")
     * @Assert\Length(
     *    max = 255,
     *    maxMessage = "L'url ne doit pas dépasser 255 caractères")
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     * @Assert\Url(
     *    message = "L'url '{{ value }}' n'est pas valide",
     *    checkDNS = true,
     *    dnsMessage = "L'hôte '{{ value }}' n'a pas pu être trouvé")
     * @Assert\Length(
     *    max = 255,
     *    maxMessage = "L'url ne doit pas dépasser 255 caractères")
     */
    private $twitter;


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
     * @return Partenaire
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
     * Set content
     *
     * @param string $content
     *
     * @return Partenaire
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
     * @return Partenaire
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
     * Set url
     *
     * @param string $url
     *
     * @return Partenaire
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

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Partenaire
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Partenaire
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
}

