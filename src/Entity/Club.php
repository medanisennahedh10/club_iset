<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    /**
     * @var Collection<int, Evenement>
     */
    #[ORM\OneToMany(targetEntity: Evenement::class, mappedBy: 'Club')]
    private Collection $evenements;

    /**
     * @var Collection<int, Recrutement>
     */
    #[ORM\OneToMany(targetEntity: Recrutement::class, mappedBy: 'club_id', orphanRemoval: true)]
    private Collection $recrutements;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->recrutements = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setClub($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getClub() === $this) {
                $evenement->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recrutement>
     */
    public function getRecrutements(): Collection
    {
        return $this->recrutements;
    }

    public function addRecrutement(Recrutement $recrutement): static
    {
        if (!$this->recrutements->contains($recrutement)) {
            $this->recrutements->add($recrutement);
            $recrutement->setClubId($this);
        }

        return $this;
    }

    public function removeRecrutement(Recrutement $recrutement): static
    {
        if ($this->recrutements->removeElement($recrutement)) {
            // set the owning side to null (unless already changed)
            if ($recrutement->getClubId() === $this) {
                $recrutement->setClubId(null);
            }
        }

        return $this;
    }
}
