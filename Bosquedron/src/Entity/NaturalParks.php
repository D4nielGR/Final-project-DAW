<?php

namespace App\Entity;

use App\Repository\NaturalParksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NaturalParksRepository::class)]
class NaturalParks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $website = null;

    #[ORM\Column(length: 4000)]
    private ?string $presentation = null;

    #[ORM\Column(length: 255)]
    private ?string $openingTimes = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $entryFee = null;

    #[ORM\Column(length: 255)]
    private ?string $declaredIn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getOpeningTimes(): ?string
    {
        return $this->openingTimes;
    }

    public function setOpeningTimes(?string $openingTimes): static
    {
        $this->openingTimes = $openingTimes;

        return $this;
    }

    public function getEntryFee(): ?string
    {
        return $this->entryFee;
    }

    public function setEntryFee(?string $entryFee): static
    {
        $this->entryFee = $entryFee;

        return $this;
    }

    public function getDeclaredIn(): ?string
    {
        return $this->declaredIn;
    }

    public function setDeclaredIn(?string $declaredIn): static
    {
        $this->declaredIn = $declaredIn;

        return $this;
    }
}
