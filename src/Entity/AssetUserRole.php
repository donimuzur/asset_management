<?php

namespace App\Entity;

use App\Repository\AssetUserRoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssetUserRoleRepository::class)
 */
class AssetUserRole
{
    /**
	 * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DisplayName;

    /**
     * @ORM\OneToMany(targetEntity=AssetUser::class, mappedBy="UserRoleId", orphanRemoval=true)
     */
    private $assetUsers;

    public function __construct()
    {
        $this->assetUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->DisplayName;
    }

    public function setDisplayName(string $DisplayName): self
    {
        $this->DisplayName = $DisplayName;

        return $this;
    }

    /**
     * @return Collection|AssetUser[]
     */
    public function getAssetUsers(): Collection
    {
        return $this->assetUsers;
    }

    public function addAssetUser(AssetUser $assetUser): self
    {
        if (!$this->assetUsers->contains($assetUser)) {
            $this->assetUsers[] = $assetUser;
            $assetUser->setUserRoleId($this);
        }

        return $this;
    }

    public function removeAssetUser(AssetUser $assetUser): self
    {
        if ($this->assetUsers->removeElement($assetUser)) {
            // set the owning side to null (unless already changed)
            if ($assetUser->getUserRoleId() === $this) {
                $assetUser->setUserRoleId(null);
            }
        }

        return $this;
    }
}
