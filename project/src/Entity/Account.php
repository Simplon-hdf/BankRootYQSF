<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ApiResource]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $unique_number = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $balance = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column(length: 34)]
    private ?string $iban = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    private ?User $id_user = null;

    #[ORM\OneToMany(mappedBy: 'id_account', targetEntity: Credit::class)]
    private Collection $credits;

    #[ORM\OneToMany(mappedBy: 'id_account', targetEntity: Operation::class)]
    private Collection $operations;

    #[ORM\OneToMany(mappedBy: 'id_account_debiteur', targetEntity: Transaction::class)]
    private Collection $debiteur;

    #[ORM\OneToMany(mappedBy: 'id_account_crediteur', targetEntity: Transaction::class)]
    private Collection $crediteur;

    public function __construct()
    {
        $this->credits = new ArrayCollection();
        $this->operations = new ArrayCollection();
        $this->debiteur = new ArrayCollection();
        $this->crediteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniqueNumber(): ?int
    {
        return $this->unique_number;
    }

    public function setUniqueNumber(int $unique_number): self
    {
        $this->unique_number = $unique_number;

        return $this;
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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection<int, Credit>
     */
    public function getCredits(): Collection
    {
        return $this->credits;
    }

    public function addCredit(Credit $credit): self
    {
        if (!$this->credits->contains($credit)) {
            $this->credits->add($credit);
            $credit->setIdAccount($this);
        }

        return $this;
    }

    public function removeCredit(Credit $credit): self
    {
        if ($this->credits->removeElement($credit)) {
            // set the owning side to null (unless already changed)
            if ($credit->getIdAccount() === $this) {
                $credit->setIdAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Operation>
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations->add($operation);
            $operation->setIdAccount($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getIdAccount() === $this) {
                $operation->setIdAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getDebiteur(): Collection
    {
        return $this->debiteur;
    }

    public function addDebiteur(Transaction $debiteur): self
    {
        if (!$this->debiteur->contains($debiteur)) {
            $this->debiteur->add($debiteur);
            $debiteur->setIdAccountDebiteur($this);
        }

        return $this;
    }

    public function removeDebiteur(Transaction $debiteur): self
    {
        if ($this->debiteur->removeElement($debiteur)) {
            // set the owning side to null (unless already changed)
            if ($debiteur->getIdAccountDebiteur() === $this) {
                $debiteur->setIdAccountDebiteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getCrediteur(): Collection
    {
        return $this->crediteur;
    }

    public function addCrediteur(Transaction $crediteur): self
    {
        if (!$this->crediteur->contains($crediteur)) {
            $this->crediteur->add($crediteur);
            $crediteur->setIdAccountCrediteur($this);
        }

        return $this;
    }

    public function removeCrediteur(Transaction $crediteur): self
    {
        if ($this->crediteur->removeElement($crediteur)) {
            // set the owning side to null (unless already changed)
            if ($crediteur->getIdAccountCrediteur() === $this) {
                $crediteur->setIdAccountCrediteur(null);
            }
        }

        return $this;
    }
}
