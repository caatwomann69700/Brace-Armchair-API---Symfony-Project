<?php
// src/Entity/Cart.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\CartItem;
use ApiPlatform\Metadata\ApiResource;
use symfony\Component\Serializer\Attribute\Groups;
#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['cart:read']]
  )]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Relation ManyToOne avec User
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'carts')]
    private ?User $user = null;

    #[ORM\Column(type: 'float')]
    private float $totalPrice = 0.0;

    // Relation OneToMany avec CartItem
    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: CartItem::class, cascade: ['persist', 'remove'])]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(CartItem $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setCart($this);
            $this->updateTotalPrice();
        }

        return $this;
    }

    public function removeItem(CartItem $item): static
    {
        if ($this->items->removeElement($item)) {
            if ($item->getCart() === $this) {
                $item->setCart(null);
                $this->updateTotalPrice();
            }
        }

        return $this;
    }

    private function updateTotalPrice(): void
    {
        $this->totalPrice = 0.0;

        foreach ($this->items as $item) {
            $this->totalPrice += $item->getProduct()->getPrice() * $item->getQuantity();
        }
    }
}
