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

    #[ORM\OneToOne(inversedBy: 'account', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $id_client = null;

    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'operation')]
    private Collection $clients;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'accounts')]
    private Collection $transaction;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'transaction')]
    private Collection $accounts;

    //#[ORM\ManyToMany(targetEntity: Operation::class, mappedBy: 'id_account')]
    //private Collection $operations;

    // #[ORM\ManyToMany(targetEntity: Transaction::class, mappedBy: 'id_account_crediteur')]
    // private Collection $transactions;

    public function __construct()
    {
        $this->operations = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->transaction = new ArrayCollection();
        $this->accounts = new ArrayCollection();
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

    public function getIdClient(): ?Client
    {
        return $this->id_client;
    }

    public function setIdClient(Client $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    // /**
    //  * @return Collection<int, Operation>
    //  */
    // public function getOperations(): Collection
    // {
    //     return $this->operations;
    // }

    // public function addOperation(Operation $operation): self
    // {
    //     if (!$this->operations->contains($operation)) {
    //         $this->operations->add($operation);
    //         $operation->addIdAccount($this);
    //     }

    //     return $this;
    // }

    // public function removeOperation(Operation $operation): self
    // {
    //     if ($this->operations->removeElement($operation)) {
    //         $operation->removeIdAccount($this);
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Transaction>
    //  */
    // public function getTransactions(): Collection
    // {
    //     return $this->transactions;
    // }

    // public function addTransaction(Transaction $transaction): self
    // {
    //     if (!$this->transactions->contains($transaction)) {
    //         $this->transactions->add($transaction);
    //         $transaction->addIdAccountCrediteur($this);
    //     }

    //     return $this;
    // }

    // public function removeTransaction(Transaction $transaction): self
    // {
    //     if ($this->transactions->removeElement($transaction)) {
    //         $transaction->removeIdAccountCrediteur($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->addOperation($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            $client->removeOperation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getTransaction(): Collection
    {
        return $this->transaction;
    }

    public function addTransaction(self $transaction): self
    {
        if (!$this->transaction->contains($transaction)) {
            $this->transaction->add($transaction);
        }

        return $this;
    }

    public function removeTransaction(self $transaction): self
    {
        $this->transaction->removeElement($transaction);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(self $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts->add($account);
            $account->addTransaction($this);
        }

        return $this;
    }

    public function removeAccount(self $account): self
    {
        if ($this->accounts->removeElement($account)) {
            $account->removeTransaction($this);
        }

        return $this;
    }
}
