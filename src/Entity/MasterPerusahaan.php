<?php

namespace App\Entity;

use App\Repository\MasterPerusahaanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MasterPerusahaanRepository::class)
 */
class MasterPerusahaan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nama_perusahaan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=BerkasPerusahaan::class, mappedBy="perusahaan", orphanRemoval=true)
     */
    private $berkasPerusahaans;

    public function __construct()
    {
        $this->berkasPerusahaans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamaPerusahaan(): ?string
    {
        return $this->nama_perusahaan;
    }

    public function setNamaPerusahaan(string $nama_perusahaan): self
    {
        $this->nama_perusahaan = strtoupper($nama_perusahaan);

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|BerkasPerusahaan[]
     */
    public function getBerkasPerusahaans(): Collection
    {
        return $this->berkasPerusahaans;
    }

    public function addBerkasPerusahaan(BerkasPerusahaan $berkasPerusahaan): self
    {
        if (!$this->berkasPerusahaans->contains($berkasPerusahaan)) {
            $this->berkasPerusahaans[] = $berkasPerusahaan;
            $berkasPerusahaan->setPerusahaan($this);
        }

        return $this;
    }

    public function removeBerkasPerusahaan(BerkasPerusahaan $berkasPerusahaan): self
    {
        if ($this->berkasPerusahaans->removeElement($berkasPerusahaan)) {
            // set the owning side to null (unless already changed)
            if ($berkasPerusahaan->getPerusahaan() === $this) {
                $berkasPerusahaan->setPerusahaan(null);
            }
        }

        return $this;
    }
}
