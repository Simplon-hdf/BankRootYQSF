<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ApiResource]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $amount = null;

    #[ORM\Column(length: 50)]
    private ?string $label = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_transaction = null;

    #[ORM\ManyToOne(inversedBy: 'debiteur')]
    private ?Account $id_account_debiteur = null;

    #[ORM\ManyToOne(inversedBy: 'crediteur')]
    private ?Account $id_account_crediteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->date_transaction;
    }

    public function setDateTransaction(\DateTimeInterface $date_transaction): self
    {
        $this->date_transaction = $date_transaction;

        return $this;
    }

    public function getIdAccountDebiteur(): ?Account
    {
        return $this->id_account_debiteur;
    }

    public function setIdAccountDebiteur(?Account $id_account_debiteur): self
    {
        $this->id_account_debiteur = $id_account_debiteur;

        return $this;
    }

    public function getIdAccountCrediteur(): ?Account
    {
        return $this->id_account_crediteur;
    }

    public function setIdAccountCrediteur(?Account $id_account_crediteur): self
    {
        $this->id_account_crediteur = $id_account_crediteur;

        return $this;
    }
}
