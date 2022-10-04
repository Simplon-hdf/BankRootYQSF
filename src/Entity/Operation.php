<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OperationRepository::class)]
#[ApiResource]
class Operation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_operation = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    // #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'operations')]
    // private Collection $id_client;

    // #[ORM\ManyToMany(targetEntity: Account::class, inversedBy: 'operations')]
    // private Collection $id_account;

    public function __construct()
    {
        $this->id_client = new ArrayCollection();
        $this->id_account = new ArrayCollection();
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

    public function getDateOperation(): ?\DateTimeInterface
    {
        return $this->date_operation;
    }

    public function setDateOperation(\DateTimeInterface $date_operation): self
    {
        $this->date_operation = $date_operation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getIdClient(): Collection
    {
        return $this->id_client;
    }

    public function addIdClient(Client $idClient): self
    {
        if (!$this->id_client->contains($idClient)) {
            $this->id_client->add($idClient);
        }

        return $this;
    }

    public function removeIdClient(Client $idClient): self
    {
        $this->id_client->removeElement($idClient);

        return $this;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getIdAccount(): Collection
    {
        return $this->id_account;
    }

    public function addIdAccount(Account $idAccount): self
    {
        if (!$this->id_account->contains($idAccount)) {
            $this->id_account->add($idAccount);
        }

        return $this;
    }

    public function removeIdAccount(Account $idAccount): self
    {
        $this->id_account->removeElement($idAccount);

        return $this;
    }
}
