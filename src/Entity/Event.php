<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @Assert\Length(
     *   min = 3,
     *   minMessage = "Le nom doit avoir au minimum {{ limit }} caractères",   
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Assert\DateTime() 
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @Assert\DateTime()
     * @Assert\GreaterThan(propertyPath="startAt")
     *
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @Assert\Type(type = "float")
     * @Assert\GreaterThan(0) 
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $poster;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="events")
     */
    private $categories;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(nullable=true)
     */
    private $owner;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\OneToMany(targetEntity="App\Entity\Participation", mappedBy="event", orphanRemoval=true)
     */
    private $participations;

    /**
     * @Assert\NotBlank(
     * message = "Merci de renseigner ce champ !"   
     * )
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="event")
     */
    private $comments;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->comments = new ArrayCollection();
        
        $this->createdAt = new \DateTime();
        
        $this->startAt = new \DateTime();
        $this->endAt = new \DateTime();
        
        $this->name = 'yoyo';
        $this->price = '10';
        $this->content = 'yo';
        $this->poster = 'yo';

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(? \DateTimeInterface $createdAt): self 
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(? \DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(? \DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setEvent($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getEvent() === $this) {
                $participation->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }
}
