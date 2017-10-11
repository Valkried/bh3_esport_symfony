<?php

namespace BH3Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Email
 *
 * @ORM\Table(name="bh3_emails")
 * @ORM\Entity(repositoryClass="BH3Bundle\Repository\EmailRepository")
 */
class Email
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(
     *    min = 2,
     *    max = 50,
     *    minMessage = "Le nom doit faire au moins 2 caractères",
     *    maxMessage = "Le champ ne doit pas dépasser 50 caractères")
     * @Assert\NotBlank(message = "Le nom doit être renseigné")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message = "L'email {{ value }} n'est pas valide", checkMX = true)
     * @Assert\NotBlank(message = "L'email doit être renseigné")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     * @Assert\Length(
     *    min = 2,
     *    max = 255,
     *    minMessage = "Le sujet doit faire au moins 2 caractères",
     *    maxMessage = "Le champ ne doit pas dépasser 255 caractères")
     * @Assert\NotBlank(message = "Le sujet doit être renseigné")
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(
     *    min = 2,
     *    max = 1000,
     *    minMessage = "Le contenu doit faire au moins 2 caractères",
     *    maxMessage = "Le champ ne doit pas dépasser 1000 caractères")
     * @Assert\NotBlank(message = "Le contenu doit être renseigné")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;


    public function __construct()
    {
        $this->setDate(new \Datetime());
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
     * Set name
     *
     * @param string $name
     *
     * @return Email
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
     * @return Email
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
     * Set subject
     *
     * @param string $subject
     *
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Email
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Email
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
}

