<?php

namespace App\Entity;

use App\Repository\StatusPembayaranTanahPribadiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusPembayaranTanahPribadiRepository::class)
 */
class StatusPembayaranTanahPribadi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tahun_pembayaran;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=AssetTanahPribadi::class, inversedBy="status_pembayaran")
     */
    private $assetTanahPribadi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTahunPembayaran(): ?int
    {
        return $this->tahun_pembayaran;
    }

    public function setTahunPembayaran(?int $tahun_pembayaran): self
    {
        $this->tahun_pembayaran = $tahun_pembayaran;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAssetTanahPribadi(): ?AssetTanahPribadi
    {
        return $this->assetTanahPribadi;
    }

    public function setAssetTanahPribadi(?AssetTanahPribadi $assetTanahPribadi): self
    {
        $this->assetTanahPribadi = $assetTanahPribadi;

        return $this;
    }
}
