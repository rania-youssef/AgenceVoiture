<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RentalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalRepository::class)]
#[ApiResource]
class Rental
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'rentals')]
    private $CustomerID;

    #[ORM\ManyToOne(targetEntity: Car::class, inversedBy: 'rentals')]
    private $CarID;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $RentalStartDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $RentalEndDate;

    #[ORM\Column(type: 'float', nullable: true)]
    private $TotalCost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerID(): ?Customer
    {
        return $this->CustomerID;
    }

    public function setCustomerID(?Customer $CustomerID): self
    {
        $this->CustomerID = $CustomerID;

        return $this;
    }

    public function getCarID(): ?Car
    {
        return $this->CarID;
    }

    public function setCarID(?Car $CarID): self
    {
        $this->CarID = $CarID;

        return $this;
    }

    public function getRentalStartDate(): ?\DateTimeInterface
    {
        return $this->RentalStartDate;
    }

    public function setRentalStartDate(?\DateTimeInterface $RentalStartDate): self
    {
        $this->RentalStartDate = $RentalStartDate;

        return $this;
    }

    public function getRentalEndDate(): ?\DateTimeInterface
    {
        return $this->RentalEndDate;
    }

    public function setRentalEndDate(?\DateTimeInterface $RentalEndDate): self
    {
        $this->RentalEndDate = $RentalEndDate;

        return $this;
    }

    public function getTotalCost(): ?float
    {
        return $this->TotalCost;
    }

    public function setTotalCost(?float $TotalCost): self
    {
        $this->TotalCost = $TotalCost;

        return $this;
    }
}
