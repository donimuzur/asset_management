<?php

namespace App\Entity;

use App\Repository\AssetUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=AssetUserRepository::class)
 */
class AssetUser implements UserInterface
{
    /**
	 * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $UserName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UserPassword;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Deleted;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedDate;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $CreatedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ModifiedDate;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ModifiedBy;

    /**
     * @ORM\ManyToOne(targetEntity=AssetUserRole::class, inversedBy="assetUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserRoleId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FullName;

    /**
     * @ORM\OneToMany(targetEntity=AttachmentAssetKendaraanMotor::class, mappedBy="attached_by")
     */
    private $attachmentAssetKendaraanMotors;

    /**
     * @ORM\OneToMany(targetEntity=AttachmentAssetKendaraanMobil::class, mappedBy="attached_by")
     */
    private $attachmentAssetKendaraanMobils;

    public function __construct()
    {
        $this->attachmentAssetKendaraanMotors = new ArrayCollection();
        $this->attachmentAssetKendaraanMobils = new ArrayCollection();
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

   
    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }
    
    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }
   
    public function getRoles(): array
    {
        // guarantee every user at least has ROLE_USER
        $roles[] = $this->getUserRoleId()->getName();
        return array_unique($roles);
    }
    
    public function getPassword()
    {
        return $this->UserPassword;
    }

    public function getUserPassword(): ?string
    {
        return $this->UserPassword;
    }

    public function setUserPassword(string $UserPassword): self
    {
        $this->UserPassword = $UserPassword;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->Deleted;
    }

    public function setDeleted(bool $Deleted): self
    {
        $this->Deleted = $Deleted;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(bool $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->CreatedDate;
    }

    public function setCreatedDate(\DateTimeInterface $CreatedDate): self
    {
        $this->CreatedDate = $CreatedDate;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->CreatedBy;
    }

    public function setCreatedBy(?string $CreatedBy): self
    {
        $this->CreatedBy = $CreatedBy;

        return $this;
    }

    public function getModifiedDate(): ?\DateTimeInterface
    {
        return $this->ModifiedDate;
    }

    public function setModifiedDate(?\DateTimeInterface $ModifiedDate): self
    {
        $this->ModifiedDate = $ModifiedDate;

        return $this;
    }

    public function getModifiedBy(): ?string
    {
        return $this->ModifiedBy;
    }

    public function setModifiedBy(?string $ModifiedBy): self
    {
        $this->ModifiedBy = $ModifiedBy;

        return $this;
    }

    public function getUserRoleId(): ?AssetUserRole
    {
        return $this->UserRoleId;
    }

    public function setUserRoleId(?AssetUserRole $UserRoleId): self
    {
        $this->UserRoleId = $UserRoleId;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->FullName;
    }

    public function setFullName(string $FullName): self
    {
        $this->FullName = $FullName;

        return $this;
    }

    /**
     * @return Collection|AttachmentAssetKendaraanMotor[]
     */
    public function getAttachmentAssetKendaraanMotors(): Collection
    {
        return $this->attachmentAssetKendaraanMotors;
    }

    public function addAttachmentAssetKendaraanMotor(AttachmentAssetKendaraanMotor $attachmentAssetKendaraanMotor): self
    {
        if (!$this->attachmentAssetKendaraanMotors->contains($attachmentAssetKendaraanMotor)) {
            $this->attachmentAssetKendaraanMotors[] = $attachmentAssetKendaraanMotor;
            $attachmentAssetKendaraanMotor->setAttachedBy($this);
        }

        return $this;
    }

    public function removeAttachmentAssetKendaraanMotor(AttachmentAssetKendaraanMotor $attachmentAssetKendaraanMotor): self
    {
        if ($this->attachmentAssetKendaraanMotors->removeElement($attachmentAssetKendaraanMotor)) {
            // set the owning side to null (unless already changed)
            if ($attachmentAssetKendaraanMotor->getAttachedBy() === $this) {
                $attachmentAssetKendaraanMotor->setAttachedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AttachmentAssetKendaraanMobil[]
     */
    public function getAttachmentAssetKendaraanMobils(): Collection
    {
        return $this->attachmentAssetKendaraanMobils;
    }

    public function addAttachmentAssetKendaraanMobil(AttachmentAssetKendaraanMobil $attachmentAssetKendaraanMobil): self
    {
        if (!$this->attachmentAssetKendaraanMobils->contains($attachmentAssetKendaraanMobil)) {
            $this->attachmentAssetKendaraanMobils[] = $attachmentAssetKendaraanMobil;
            $attachmentAssetKendaraanMobil->setAttachedBy($this);
        }

        return $this;
    }

    public function removeAttachmentAssetKendaraanMobil(AttachmentAssetKendaraanMobil $attachmentAssetKendaraanMobil): self
    {
        if ($this->attachmentAssetKendaraanMobils->removeElement($attachmentAssetKendaraanMobil)) {
            // set the owning side to null (unless already changed)
            if ($attachmentAssetKendaraanMobil->getAttachedBy() === $this) {
                $attachmentAssetKendaraanMobil->setAttachedBy(null);
            }
        }

        return $this;
    }
}
