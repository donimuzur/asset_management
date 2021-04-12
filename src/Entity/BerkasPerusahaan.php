<?php

namespace App\Entity;

use App\Repository\BerkasPerusahaanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BerkasPerusahaanRepository::class)
 */
class BerkasPerusahaan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deskripsi;

     /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $attach_filename;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attach_size;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attach_type;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $attached_time;

    /**
     * @ORM\ManyToOne(targetEntity=AssetUser::class, inversedBy="berkasPerusahaans")
     */
    private $attached_by;

    /**
     * @ORM\ManyToOne(targetEntity=MasterPerusahaan::class, inversedBy="berkasPerusahaans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $perusahaan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeskripsi(): ?string
    {
        return $this->deskripsi;
    }

    public function setDeskripsi(string $deskripsi): self
    {
        $this->deskripsi = $deskripsi;

        return $this;
    }


    public function getAttachFilename(): ?string
    {
        return $this->attach_filename;
    }

    public function setAttachFilename(?string $attach_filename): self
    {
        $this->attach_filename = $attach_filename;

        return $this;
    }

    public function getAttachSize(): ?int
    {
        return $this->attach_size;
    }

    public function setAttachSize(?int $attach_size): self
    {
        $this->attach_size = $attach_size;

        return $this;
    }

    public function getAttachType(): ?string
    {
        return $this->attach_type;
    }

    public function setAttachType(?string $attach_type): self
    {
        $this->attach_type = $attach_type;

        return $this;
    }

    public function getAttachedTime(): ?\DateTimeInterface
    {
        return $this->attached_time;
    }

    public function setAttachedTime(?\DateTimeInterface $attached_time): self
    {
        $this->attached_time = $attached_time;

        return $this;
    }

    public function getAttachedBy(): ?AssetUser
    {
        return $this->attached_by;
    }

    public function setAttachedBy(?AssetUser $attached_by): self
    {
        $this->attached_by = $attached_by;

        return $this;
    }

    public function getPerusahaan(): ?MasterPerusahaan
    {
        return $this->perusahaan;
    }

    public function setPerusahaan(?MasterPerusahaan $perusahaan): self
    {
        $this->perusahaan = $perusahaan;

        return $this;
    }
}
