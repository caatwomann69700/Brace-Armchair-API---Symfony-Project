<?php
// src/Entity/Imagelist.php

namespace App\Entity;

use App\Repository\ImagelistRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ImagelistRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['imagelist:read']]
  )]
class Imagelist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Relation ManyToOne avec Product
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'imagelist')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }
}
