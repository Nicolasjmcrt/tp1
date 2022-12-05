<?php

namespace App\Entity;

use App\Repository\QualificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QualificationRepository::class)]
class Qualification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    #[Assert\NotBlank(message: 'Veuillez saisir un code')]
    #[Assert\Length(min: 2, minMessage: 'Le code doit comporter au moins {{ limit }} caractères', max: 8, maxMessage: 'Le code ne peut pas comporter plus de {{ limit }} caractères')]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir un libellé')]
    #[Assert\Length(min: 5, minMessage: 'Le libellé doit comporter au moins {{ limit }} caractères')]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'qualification', targetEntity: Pilote::class)]
    private Collection $pilotes;

    public function __construct()
    {
        $this->pilotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Pilote>
     */
    public function getPilotes(): Collection
    {
        return $this->pilotes;
    }

    public function addPilote(Pilote $pilote): self
    {
        if (!$this->pilotes->contains($pilote)) {
            $this->pilotes->add($pilote);
            $pilote->setQualification($this);
        }

        return $this;
    }

    public function removePilote(Pilote $pilote): self
    {
        if ($this->pilotes->removeElement($pilote)) {
            // set the owning side to null (unless already changed)
            if ($pilote->getQualification() === $this) {
                $pilote->setQualification(null);
            }
        }

        return $this;
    }
}
