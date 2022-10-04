<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    // #[ORM\ManyToMany(targetEntity: Account::class, inversedBy: 'transactions')]
    // private Collection $id_account_crediteur;

    // #[ORM\ManyToMany(targetEntity: Account::class, inversedBy: 'transactions')]
    // private Collection $id_account_debiteur;

    public function __construct()
    {
        $this->id_account_crediteur = new ArrayCollection();
        $this->id_account_debiteur = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Account>
     */
    public function getIdAccountCrediteur(): Collection
    {
        return $this->id_account_crediteur;
    }

    public function addIdAccountCrediteur(Account $idAccountCrediteur): self
    {
        if (!$this->id_account_crediteur->contains($idAccountCrediteur)) {
            $this->id_account_crediteur->add($idAccountCrediteur);
        }

        return $this;
    }

    public function removeIdAccountCrediteur(Account $idAccountCrediteur): self
    {
        $this->id_account_crediteur->removeElement($idAccountCrediteur);

        return $this;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getIdAccountDebiteur(): Collection
    {
        return $this->id_account_debiteur;
    }

    public function addIdAccountDebiteur(Account $idAccountDebiteur): self
    {
        if (!$this->id_account_debiteur->contains($idAccountDebiteur)) {
            $this->id_account_debiteur->add($idAccountDebiteur);
        }

        return $this;
    }

    public function removeIdAccountDebiteur(Account $idAccountDebiteur): self
    {
        $this->id_account_debiteur->removeElement($idAccountDebiteur);

        return $this;
    }
}
