<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CreditRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditRepository::class)]
#[ApiResource]
class Credit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $balance = null;

    #[ORM\Column(nullable: true)]
    private ?bool $administrator_validation = null;

    #[ORM\ManyToOne(inversedBy: 'credits')]
    private ?Admin $id_admin = null;

    #[ORM\ManyToOne(inversedBy: 'credits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $id_client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function isAdministratorValidation(): ?bool
    {
        return $this->administrator_validation;
    }

    public function setAdministratorValidation(?bool $administrator_validation): self
    {
        $this->administrator_validation = $administrator_validation;

        return $this;
    }

    public function getIdAdmin(): ?Admin
    {
        return $this->id_admin;
    }

    public function setIdAdmin(?Admin $id_admin): self
    {
        $this->id_admin = $id_admin;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->id_client;
    }

    public function setIdClient(?Client $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }
}
