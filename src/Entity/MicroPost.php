<?php

namespace App\Entity;

use App\Repository\MicroPostRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


/**
 * @ORM\Entity(repositoryClass=MicroPostRepository::class)
 */


class MicroPost
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
    private $text;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $subject;
//
//    /**
//     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="post")
//     */
//    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     */
    private $user;

    public function __toString()
    {
        return $this->date . $this->id;

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

//    public function getUser(): ?User
//    {
//        return $this->user;
//    }
//
//    public function setUser(?User $user): self
//    {
//        $this->user = $user;
//
//        return $this;
//    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

//    /**
//     * NOTE: This is not a mapped field of entity metadata, just a simple property.
//     *
//     * @Vich\UploadableField(mapping="posts", fileNameProperty="imageName", size="imageSize")
//     *
//     * @var File
//     */
//    private $imageFile;
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     *
//     * @var string
//     */
//    private $imageName;
//
//    /**
//     * @ORM\Column(type="integer")
//     *
//     * @var integer
//     */
//    private $imageSize;
//
//    /**
//     * @ORM\Column(type="datetime")
//     *
//     * @var \DateTime
//     */
//    private $updatedAt;
//
//    /**
//     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
//     * of 'UploadedFile' is injected into this setter to trigger the update. If this
//     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
//     * must be able to accept an instance of 'File' as the bundle will inject one here
//     * during Doctrine hydration.
//     *
//     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
//     */
//    public function setImageFile(?File $imageFile = null): void
//    {
//        $this->imageFile = $imageFile;
//
//        if (null !== $imageFile) {
//            // It is required that at least one field changes if you are using doctrine
//            // otherwise the event listeners won't be called and the file is lost
//            $this->updatedAt = new \DateTimeImmutable();
//        }
//    }
//
//    public function getImageFile(): ?File
//    {
//        return $this->imageFile;
//    }
//
//    public function setImageName(?string $imageName): void
//    {
//        $this->imageName = $imageName;
//    }
//
//    public function getImageName(): ?string
//    {
//        return $this->imageName;
//    }
//
//    public function setImageSize(?int $imageSize): void
//    {
//        $this->imageSize = $imageSize;
//    }
//
//    public function getImageSize(): ?int
//    {
//        return $this->imageSize;
//    }

//    /**
//     * @param DateTime $updatedAt
//     */
//    public function setUpdatedAt(DateTime $updatedAt): void
//    {
//        $this->updatedAt = $updatedAt;
//    }

//    /**
//     * @return DateTime
//     */
//    public function getUpdatedAt(): DateTime
//    {
//        return $this->updatedAt;
//    }
//    /**
//     * @param DateTime $updatedAt
//     */
//    public function setUpdatedAt(DateTime $updatedAt): void
//    {
//        $this->updatedAt = $updatedAt;
//    }

public function getUser(): ?User
{
    return $this->user;
}

public function setUser(?User $user): self
{
    $this->user = $user;

    return $this;
}


}
