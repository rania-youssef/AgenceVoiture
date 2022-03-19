<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use ApiPlatform\Core\Annotation\ApiResource;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
/**
     * @ApiResource(
     * collectionOperations={"get"},
     * itemOperations={"get"})
     */

class Comment
{
    /*
    @Groups({"read:comment"})
    */ 
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'Content')]
    /*
    @Groups({"read:comment"})
    */
    private $auteur;

    #[ORM\ManyToOne(targetEntity: Voiture::class, inversedBy: 'comments')]

    private $voiture;

    #[ORM\Column(type: 'string', length: 255)]
    /*
    @Groups({"read:comment"})
    */
    private $content;

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

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

}
