<?php

namespace App\Entity;

use App\Repository\AssetTanahPerusahaanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssetTanahPerusahaanRepository::class)
 */
class AssetTanahPerusahaan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $luasan;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $no_shm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nama_pemilik;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Status;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $status_pembayaran;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $keterangan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lokasi;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $provinsi;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $kabupaten_kota;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $kecamatan;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $desa;

    /**
     * @ORM\OneToMany(targetEntity=AttachmentAssetTanahPerusahaan::class, mappedBy="assetTanahPerusahaan", orphanRemoval=true)
     */
    private $Attachment;

    public function __construct()
    {
        $this->Attachment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLuasan(): ?string
    {
        return $this->luasan;
    }

    public function setLuasan(?string $Luasan): self
    {
        $this->luasan = $Luasan;

        return $this;
    }

    public function getNoShm(): ?string
    {
        return $this->no_shm;
    }

    public function setNoShm(?string $no_shm): self
    {
        $this->no_shm = strtoupper($no_shm);

        return $this;
    }

    public function getNamaPemilik(): ?string
    {
        return $this->nama_pemilik;
    }

    public function setNamaPemilik(?string $nama_pemilik): self
    {
        $this->nama_pemilik = $nama_pemilik;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getStatusPembayaran(): ?string
    {
        return $this->status_pembayaran;
    }

    public function setStatusPembayaran(?string $status_pembayaran): self
    {
        $this->status_pembayaran = $status_pembayaran;

        return $this;
    }

    public function getKeterangan(): ?string
    {
        return $this->keterangan;
    }

    public function setKeterangan(?string $keterangan): self
    {
        $this->keterangan = $keterangan;

        return $this;
    }

    public function getLokasi(): ?string
    {
        return $this->lokasi;
    }

    public function setLokasi(?string $lokasi): self
    {
        $this->lokasi = $lokasi;

        return $this;
    }

    public function getProvinsi(): ?string
    {
        return $this->provinsi;
    }

    public function setProvinsi(?string $provinsi): self
    {
        $this->provinsi = strtoupper($provinsi);

        return $this;
    }

    public function getKabupatenKota(): ?string
    {
        return $this->kabupaten_kota;
    }

    public function setKabupatenKota(?string $kabupaten_kota): self
    {
        $this->kabupaten_kota = strtoupper($kabupaten_kota);

        return $this;
    }

    public function getKecamatan(): ?string
    {
        return $this->kecamatan;
    }

    public function setKecamatan(?string $kecamatan): self
    {
        $this->kecamatan = strtoupper($kecamatan);

        return $this;
    }

    public function getDesa(): ?string
    {
        return $this->desa;
    }

    public function setDesa(?string $desa): self
    {
        $this->desa = strtoupper($desa);

        return $this;
    }

    /**
     * @return Collection|AttachmentAssetTanahPerusahaan[]
     */
    public function getAttachment(): Collection
    {
        return $this->Attachment;
    }

    public function addAttachment(AttachmentAssetTanahPerusahaan $attachment): self
    {
        if (!$this->Attachment->contains($attachment)) {
            $this->Attachment[] = $attachment;
            $attachment->setAssetTanahPerusahaan($this);
        }

        return $this;
    }

    public function removeAttachment(AttachmentAssetTanahPerusahaan $attachment): self
    {
        if ($this->Attachment->removeElement($attachment)) {
            // set the owning side to null (unless already changed)
            if ($attachment->getAssetTanahPerusahaan() === $this) {
                $attachment->setAssetTanahPerusahaan(null);
            }
        }

        return $this;
    }
}
