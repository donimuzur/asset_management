<?php

namespace App\Entity;

use App\Repository\StatusPembayaranBangunanPribadiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusPembayaranBangunanPribadiRepository::class)
 */
class StatusPembayaranBangunanPribadi
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
     * @ORM\ManyToOne(targetEntity=AssetBangunanPribadi::class, inversedBy="status_pembayaran")
     */
    private $assetBangunanPribadi;

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

    public function getAssetBangunanPribadi(): ?AssetBangunanPribadi
    {
        return $this->assetBangunanPribadi;
    }

    public function setAssetBangunanPribadi(?AssetBangunanPribadi $assetBangunanPribadi): self
    {
        $this->assetBangunanPribadi = $assetBangunanPribadi;

        return $this;
    }
}
