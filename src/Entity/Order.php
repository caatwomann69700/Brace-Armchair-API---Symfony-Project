<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\ApiResource;
use symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['order:read']]
  )]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ordernumber = null;

    #[ORM\Column]
    private ?float $totalamount = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingadress = null;

    #[ORM\Column(length: 255)]
    private ?string $paymentmethod = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingmethod = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $shippingconst = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createdat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $updatedat = null;

    // Relation ManyToOne avec User
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // Relation OneToMany avec Product
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'orders')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdernumber(): ?string
    {
        return $this->ordernumber;
    }

    public function setOrdernumber(string $ordernumber): static
    {
        $this->ordernumber = $ordernumber;

        return $this;
    }

    public function getTotalamount(): ?float
    {
        return $this->totalamount;
    }

    public function setTotalamount(float $totalamount): static
    {
        $this->totalamount = $totalamount;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getShippingadress(): ?string
    {
        return $this->shippingadress;
    }

    public function setShippingadress(string $shippingadress): static
    {
        $this->shippingadress = $shippingadress;

        return $this;
    }

    public function getPaymentmethod(): ?string
    {
        return $this->paymentmethod;
    }

    public function setPaymentmethod(string $paymentmethod): static
    {
        $this->paymentmethod = $paymentmethod;

        return $this;
    }

    public function getShippingmethod(): ?string
    {
        return $this->shippingmethod;
    }

    public function setShippingmethod(string $shippingmethod): static
    {
        $this->shippingmethod = $shippingmethod;

        return $this;
    }

    public function getShippingconst(): ?string
    {
        return $this->shippingconst;
    }

    public function setShippingconst(string $shippingconst): static
    {
        $this->shippingconst = $shippingconst;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): static
    {
        $this->createdat = $createdat;

        return $this;
    }

    public function getUpdatedat(): ?\DateTimeInterface
    {
        return $this->updatedat;
    }

    public function setUpdatedat(\DateTimeInterface $updatedat): static
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    // Getters et setters pour User
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    // Getters et setters pour Product
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        $this->products->removeElement($product);

        return $this;
    }
}
