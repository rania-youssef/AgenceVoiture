<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ApiResource]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $Make;

    #[ORM\Column(type: 'string', length: 200)]
    private $Model;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $Year;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $RegistrationNumber;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $DailyRate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Availability;

    #[ORM\OneToMany(mappedBy: 'CarID', targetEntity: Rental::class)]
    private $rentals;

    public function __construct()
    {
        $this->rentals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->Make;
    }

    public function setMake(?string $Make): self
    {
        $this->Make = $Make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(string $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->Year;
    }

    public function setYear(?string $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->RegistrationNumber;
    }

    public function setRegistrationNumber(?string $RegistrationNumber): self
    {
        $this->RegistrationNumber = $RegistrationNumber;

        return $this;
    }

    public function getDailyRate(): ?string
    {
        return $this->DailyRate;
    }

    public function setDailyRate(?string $DailyRate): self
    {
        $this->DailyRate = $DailyRate;

        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->Availability;
    }

    public function setAvailability(?string $Availability): self
    {
        $this->Availability = $Availability;

        return $this;
    }

    /**
     * @return Collection<int, Rental>
     */
    public function getRentals(): Collection
    {
        return $this->rentals;
    }

    public function addRental(Rental $rental): self
    {
        if (!$this->rentals->contains($rental)) {
            $this->rentals[] = $rental;
            $rental->setCarID($this);
        }

        return $this;
    }

    public function removeRental(Rental $rental): self
    {
        if ($this->rentals->removeElement($rental)) {
            // set the owning side to null (unless already changed)
            if ($rental->getCarID() === $this) {
                $rental->setCarID(null);
            }
        }

        return $this;
    }
}
