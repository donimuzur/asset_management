<?php

namespace App\Entity;

use App\Repository\StatusPembayaranTanahPerusahaanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusPembayaranTanahPerusahaanRepository::class)
 */
class StatusPembayaranTanahPerusahaan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $tahun_pembayaran;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=AssetTanahPerusahaan::class, inversedBy="status_pembayaran")
     * @ORM\JoinColumn(nullable=false)
     */
    private $assetTanahPerusahaan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTahunPembayaran(): ?int
    {
        return $this->tahun_pembayaran;
    }

    public function setTahunPembayaran(int $tahun_pembayaran): self
    {
        $this->tahun_pembayaran = $tahun_pembayaran;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAssetTanahPerusahaan(): ?AssetTanahPerusahaan
    {
        return $this->assetTanahPerusahaan;
    }

    public function setAssetTanahPerusahaan(?AssetTanahPerusahaan $assetTanahPerusahaan): self
    {
        $this->assetTanahPerusahaan = $assetTanahPerusahaan;

        return $this;
    }
}
