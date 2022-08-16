<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     * @Groups({"api_user_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     * @Groups({"api_user_read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     * @Groups({"api_user_read"})
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     */
    private $address;

    /**
     * @ORM\Column(type="smallint", options={"default" : 1} )
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="posts")
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"api_post_read"})
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="post")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     */
    private $user;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

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
