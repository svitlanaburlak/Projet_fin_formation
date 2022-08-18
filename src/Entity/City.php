<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"api_city_list"})
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     * @Groups({"api_user_read"})
     * @Groups({"api_category_post"})
     * @Groups({"admin_user_list"})
     * @Groups({"admin_user_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"api_city_list"})
     * @Groups({"api_city_read"})
     * @Groups({"api_post_read"})
     * @Groups({"api_user_read"})
     * @Groups({"api_category_post"})
     * @Groups({"admin_user_list"})
     * @Groups({"admin_user_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2048)
     * @Groups({"api_city_list"})
     * @Groups({"api_city_read"})
     * @Groups({"admin_user_list"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"api_city_list"})
     * @Groups({"api_city_read"})
     * @Groups({"admin_user_list"})
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"api_city_list"})
     * @Groups({"api_city_read"})
     * @Groups({"admin_user_list"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Groups({"api_city_list"})
     * @Groups({"api_city_read"})
     * @Groups({"admin_user_list"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="city", orphanRemoval=true)
     * @Groups({"api_city_read"})
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="city")
     * @Groups({"api_city_read"})
     */
    private $users;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString() 
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCity($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getCity() === $this) {
                $post->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCity($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCity() === $this) {
                $user->setCity(null);
            }
        }

        return $this;
    }
}
