<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['newsletter:read']]
  )]
class Newsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $subscribedat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getSubscribedat(): ?\DateTimeInterface
    {
        return $this->subscribedat;
    }

    public function setSubscribedat(\DateTimeInterface $subscribedat): static
    {
        $this->subscribedat = $subscribedat;

        return $this;
    }
}
