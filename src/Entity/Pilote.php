<?php

namespace App\Entity;

use App\Repository\PiloteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PiloteRepository::class)]
class Pilote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir un nom')]
    #[Assert\Length(min: 2, minMessage: 'Le nom doit comporter au moins {{ limit }} caractères', max: 50, maxMessage: 'Le nom ne peut pas comporter plus de {{ limit }} caractères')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir un prénom')]
    #[Assert\Length(min: 2, minMessage: 'Le prénom doit comporter au moins {{ limit }} caractères', max: 50, maxMessage: 'Le prénom ne peut pas comporter plus de {{ limit }} caractères')]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir un email')]
    #[Assert\Email(message: 'Veuillez saisir un email valide')]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'pilotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Qualification $qualification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getQualification(): ?Qualification
    {
        return $this->qualification;
    }

    public function setQualification(?Qualification $qualification): self
    {
        $this->qualification = $qualification;

        return $this;
    }
}
