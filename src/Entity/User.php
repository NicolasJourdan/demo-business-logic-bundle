<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"api"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"api"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"api"})
     */
    private $money;

    /**
     * @ORM\Column(type="array")
     *
     * @Groups({"api"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"api"})
     */
    private $totalWonBets;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"api"})
     */
    private $totalLostBets;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->money = 0;
        $this->totalLostBets = 0;
        $this->totalWonBets = 0;
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function setMoney(int $money): self
    {
        $this->money = $money;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRole(string $role): self
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(string $role): self
    {
        if (in_array($role, $this->roles)) {
            unset($this->roles[array_search($role, $this->roles)]);
        }

        return $this;
    }

    public function getTotalWonBets(): ?int
    {
        return $this->totalWonBets;
    }

    public function setTotalWonBets(int $totalWonBets): self
    {
        $this->totalWonBets = $totalWonBets;

        return $this;
    }

    public function getTotalLostBets(): ?int
    {
        return $this->totalLostBets;
    }

    public function setTotalLostBets(int $totalLostBets): self
    {
        $this->totalLostBets = $totalLostBets;

        return $this;
    }

    /**
     * @Groups({"api"})
     *
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->createdAt->format('d-m-Y');
    }
}
