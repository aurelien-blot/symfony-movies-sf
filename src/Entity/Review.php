<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *     min="3",
     *     minMessage="Votre username est trop court, 3 caractères minimum",
     *     max="255",
     *     maxMessage="Votre username est trop long, 255 caractères max."
     *
     * )
     * @Assert\NotBlank(message="Votre username est manquant, fumier.")
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @Assert\Email(message="Votre email est pourrave")
     * @Assert\NotBlank(message="Vous avez oublié d'indiquer votre email, vilain")
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     */
    private $movie;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "id"  =>  $this->getId(),
            "username"   =>  $this->getUsername(),
            "email"   =>  $this->getEmail(),
            "content"    =>  $this->getContent()
        ];
    }
}
