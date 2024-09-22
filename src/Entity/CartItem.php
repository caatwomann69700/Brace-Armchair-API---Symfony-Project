<?php
// src/Entity/CartItem.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CartItemRepository;
use App\Entity\Cart;
use App\Entity\Product;
use ApiPlatform\Metadata\ApiResource;
use symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CartItemRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['cartitem:read']]
  )]
class Cartitem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $quantity; // Déclaré comme non nullable

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $cart = null;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        $this->cart = $cart;

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
