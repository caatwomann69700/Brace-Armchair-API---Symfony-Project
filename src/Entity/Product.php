<?php
// src/Entity/Product.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['product:read']]
  )]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    // Relation ManyToOne avec Category
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    // Relation ManyToMany avec Order
    #[ORM\ManyToMany(targetEntity: Order::class, mappedBy: 'products')]
    private Collection $orders;

    // Relation OneToOne avec Image
    #[ORM\OneToOne(inversedBy: 'product', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $image = null;

    // Relation OneToMany avec Imagelist
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Imagelist::class, cascade: ['persist', 'remove'])]
    private Collection $imagelist;

    public function __construct()
    {
        $this->imagelist = new ArrayCollection();
        $this->cartItems = new ArrayCollection(); // Initialise la collection des CartItems
        $this->orders = new ArrayCollection(); // Initialise la collection des Orders
    }

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    // Getters et setters pour Category
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }

    // Getters et setters pour Image
    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;
        return $this;
    }

    // Getters et setters pour Imagelist
    public function getImagelist(): Collection
    {
        return $this->imagelist;
    }

    public function addImagelist(Imagelist $imagelist): static
    {
        if (!$this->imagelist->contains($imagelist)) {
            $this->imagelist->add($imagelist);
            $imagelist->setProduct($this);
        }
        return $this;
    }

    public function removeImagelist(Imagelist $imagelist): static
    {
        if ($this->imagelist->removeElement($imagelist)) {
            // Set the owning side to null (unless already changed)
            if ($imagelist->getProduct() === $this) {
                $imagelist->setProduct(null);
            }
        }
        return $this;
    }

    // Getters et setters pour Order
    public function getOrders(): Collection
    {
        return $this->orders;
    }
}
