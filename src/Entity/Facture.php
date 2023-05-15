<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?User $users = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_creat = null;

    #[ORM\OneToMany(mappedBy: 'facture', targetEntity: Commandes::class)]
    private Collection $facture;

    public function __construct()
    {
        $this->facture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getDateCreat(): ?\DateTimeInterface
    {
        return $this->date_creat;
    }

    public function setDateCreat(?\DateTimeInterface $date_creat): self
    {
        $this->date_creat = $date_creat;

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
    public function getFacture(): Collection
    {
        return $this->facture;
    }

    public function addFacture(Commandes $facture): self
    {
        if (!$this->facture->contains($facture)) {
            $this->facture->add($facture);
            $facture->setFacture($this);
        }

        return $this;
    }

    public function removeFacture(Commandes $facture): self
    {
        if ($this->facture->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getFacture() === $this) {
                $facture->setFacture(null);
            }
        }

        return $this;
    }
}
