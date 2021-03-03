<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentsRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("produit:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("produit:read")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups("produit:read")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("produit:read")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="comment")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="comment")
     */
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
