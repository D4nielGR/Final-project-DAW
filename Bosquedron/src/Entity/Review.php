<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 2, scale: 1)]
    private ?string $valoration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reviewText = null;

    #[ORM\Column]
    private ?int $parkId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $reviewDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getValoration(): ?string
    {
        return $this->valoration;
    }

    public function setValoration(string $valoration): static
    {
        $this->valoration = $valoration;

        return $this;
    }

    public function getReviewText(): ?string
    {
        return $this->reviewText;
    }

    public function setReviewText(?string $reviewText): static
    {
        $this->reviewText = $reviewText;

        return $this;
    }

    public function getParkId(): ?int
    {
        return $this->parkId;
    }

    public function setParkId(int $parkId): static
    {
        $this->parkId = $parkId;

        return $this;
    }

    public function getReviewDate(): ?\DateTimeInterface
    {
        return $this->reviewDate;
    }

    public function setReviewDate(\DateTimeInterface $reviewDate): static
    {
        $this->reviewDate = $reviewDate;

        return $this;
    }
}
