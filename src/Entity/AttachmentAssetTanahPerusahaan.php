<?php

namespace App\Entity;

use App\Repository\AttachmentAssetTanahPerusahaanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttachmentAssetTanahPerusahaanRepository::class)
 */
class AttachmentAssetTanahPerusahaan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
/**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $attach_desc;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $attach_filename;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attach_size;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $attach_attachment;

    /**
     * @ORM\ManyToOne(targetEntity=AssetUser::class, inversedBy="attachmentAssetTanahPerusahaans")
     */
    private $attached_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $attached_time;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attach_type;

    /**
     * @ORM\ManyToOne(targetEntity=AssetTanahPerusahaan::class, inversedBy="Attachment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $assetTanahPerusahaan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttachDesc(): ?string
    {
        return $this->attach_desc;
    }

    public function setAttachDesc(?string $attach_desc): self
    {
        $this->attach_desc = $attach_desc;

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

    public function getAttachAttachment()
    {
        return $this->attach_attachment;
    }

    public function setAttachAttachment($attach_attachment): self
    {
        $this->attach_attachment = $attach_attachment;

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

    public function getAttachedTime(): ?\DateTimeInterface
    {
        return $this->attached_time;
    }

    public function setAttachedTime(?\DateTimeInterface $attached_time): self
    {
        $this->attached_time = $attached_time;

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
