<?php

namespace App\Entity;

use App\Repository\AssetKendaraanMotorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\AST\Functions\UpperFunction;

/**
 * @ORM\Entity(repositoryClass=AssetKendaraanMotorRepository::class)
 */
class AssetKendaraanMotor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $Tahun;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Pic;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Keterangan;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $PoliceNumber;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $EngineNumber;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ChasisNumber;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Manfucaturer;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Model;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Series;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Color;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Transmission;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $FuelType;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Airbag;

    /**
     * @ORM\OneToMany(targetEntity=AttachmentAssetKendaraanMotor::class, mappedBy="assetKendaraanMotor",  cascade={"remove"})
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

    public function getTahun(): ?string
    {
        return $this->Tahun;
    }

    public function setTahun(?string $Tahun): self
    {
        $this->Tahun = $Tahun;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getPic(): ?string
    {
        return $this->Pic;
    }

    public function setPic(?string $Pic): self
    {
        $this->Pic = $Pic;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getKeterangan(): ?string
    {
        return $this->Keterangan;
    }

    public function setKeterangan(?string $Keterangan): self
    {
        $this->Keterangan = $Keterangan;

        return $this;
    }

    public function getPoliceNumber(): ?string
    {
        
        return $this->PoliceNumber;
    }

    public function setPoliceNumber(?string $PoliceNumber): self
    {
        $PoliceNumber = preg_replace('/\s*/', '', $PoliceNumber);
        $PoliceNumber = strtoupper($PoliceNumber);
        $this->PoliceNumber = $PoliceNumber;

        return $this;
    }

    public function getEngineNumber(): ?string
    {
        return $this->EngineNumber;
    }

    public function setEngineNumber(?string $EngineNumber): self
    {
        $EngineNumber = preg_replace('/\s*/', '', $EngineNumber);
        $EngineNumber = strtoupper($EngineNumber);
        $this->EngineNumber = $EngineNumber;

        return $this;
    }

    public function getChasisNumber(): ?string
    {
        return $this->ChasisNumber;
    }

    public function setChasisNumber(?string $ChasisNumber): self
    {
        $ChasisNumber = preg_replace('/\s*/', '', $ChasisNumber);
        $ChasisNumber = strtoupper($ChasisNumber);
        $this->ChasisNumber = $ChasisNumber;

        return $this;
    }

    public function getManfucaturer(): ?string
    {
        return $this->Manfucaturer;
    }

    public function setManfucaturer(?string $Manfucaturer): self
    {
        $this->Manfucaturer = $Manfucaturer;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(?string $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    public function getSeries(): ?string
    {
        return $this->Series;
    }

    public function setSeries(?string $Series): self
    {
        $this->Series = $Series;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(?string $Color): self
    {
        $this->Color = $Color;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->Transmission;
    }

    public function setTransmission(?string $Transmission): self
    {
        $this->Transmission = $Transmission;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->FuelType;
    }

    public function setFuelType(?string $FuelType): self
    {
        $this->FuelType = $FuelType;

        return $this;
    }

    public function getAirbag(): ?bool
    {
        return $this->Airbag;
    }

    public function setAirbag(bool $Airbag): self
    {
        $this->Airbag = $Airbag;

        return $this;
    }

    /**
     * @return Collection|AttachmentAssetKendaraanMotor[]
     */
    public function getAttachment(): Collection
    {
        return $this->Attachment;
    }

    public function addAttachment(AttachmentAssetKendaraanMotor $attachment): self
    {
        if (!$this->Attachment->contains($attachment)) {
            $this->Attachment[] = $attachment;
            $attachment->setAssetKendaraanMotor($this);
        }

        return $this;
    }

    public function removeAttachment(AttachmentAssetKendaraanMotor $attachment): self
    {
        if ($this->Attachment->removeElement($attachment)) {
            // set the owning side to null (unless already changed)
            if ($attachment->getAssetKendaraanMotor() === $this) {
                $attachment->setAssetKendaraanMotor(null);
            }
        }

        return $this;
    }
}
