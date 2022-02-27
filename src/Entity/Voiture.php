<?php

namespace App\Entity;

use Assert\NotBlank;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VoitureRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: VoitureRepository::class)]
/**
 * @ApiResource(
 *     normalizationContext={"groups"={"voiture:read"}},
 *     denormalizationContext={"groups"={"voiture:write"}})
 * */

class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /** 
     * @Groups("voiture:read")
     * @Groups("voiture:write")
      */ 
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /** 
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     * @Groups("voiture:read")
     * @Groups("voiture:write")
      */
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Groups("voiture:write")
     * @Groups("voiture:read")
     */
    private $model;

    #[ORM\Column(type: 'datetime')]
    /** 
     * @Groups("voiture:read")
     * @Groups("voiture:write")
      */
    private $annee;

    #[ORM\Column(type: 'string', length: 255)]
    /** 
     * @Groups("voiture:read")
     * @Groups("voiture:write")
      */
    private $location;

    #[ORM\Column(type: 'string', length: 255)]
    /** 
     * @Groups("voiture:read")
     * @Groups("voiture:write")
     *  @Assert\NotBlank(message="La description est obligatoire ")
     * @Assert\Length(min=3)
      */
    private $description;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Comment::class)]
    
    private $comments;

    #[ORM\Column(type: 'array')]
   
    private $imges = [];
/** 
     * @Groups("voiture:read")
     * @Groups("voiture:write")
      */
    #[ORM\Column(type: 'string', length: 255)]
    private $price;
    /** 
     * @Groups("voiture:read")
     * @Groups("voiture:write")
      */ 

    #[ORM\Column(type: 'string', length: 255)]
    private $ville;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee( $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setVoiture($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getVoiture() === $this) {
                $comment->setVoiture(null);
            }
        }

        return $this;
    }

    public function getImges(): ?array
    {
        return $this->imges;
    }

    public function setImges(array $imges): self
    {
        $this->imges = $imges;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    

   
}
