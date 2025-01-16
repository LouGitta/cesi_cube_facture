<?php

namespace App\Entity;

use App\Repository\LigneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneRepository::class)]
class Ligne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $info1 = null;

    #[ORM\Column(nullable: true)]
    private ?float $info2 = null;

    #[ORM\Column(nullable: true)]
    private ?float $info3 = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite = null;

    #[ORM\Column(nullable: true)]
    private ?float $total = null;

    #[ORM\Column(nullable: true)]
    private ?int $facture_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfo1(): ?float
    {
        return $this->info1;
    }

    public function setInfo1(?float $info1): static
    {
        $this->info1 = $info1;

        return $this;
    }

    public function getInfo2(): ?float
    {
        return $this->info2;
    }

    public function setInfo2(?float $info2): static
    {
        $this->info2 = $info2;

        return $this;
    }

    public function getInfo3(): ?float
    {
        return $this->info3;
    }

    public function setInfo3(?float $info3): static
    {
        $this->info3 = $info3;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(?float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getFactureId(): ?int
    {
        return $this->facture_id;
    }

    public function setFactureId(?int $facture_id): static
    {
        $this->facture_id = $facture_id;

        return $this;
    }
}
