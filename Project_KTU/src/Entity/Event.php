<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank
     * @Assert\Length(max = 30)
     */
    private $Category;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank
     * @Assert\Length(max = 30)
     */
    private $City;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank
     * @Assert\Length(max = 40)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank
     * @Assert\Length(max = 40)
     */
    private $Place;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $Date;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank
     */
    private $Time;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank
     */
    private $Duration;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private $Price;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $Description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Creator;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->Place;
    }

    public function setPlace(string $Place): self
    {
        $this->Place = $Place;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->Time;
    }

    public function setTime(\DateTimeInterface $Time): self
    {
        $this->Time = $Time;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->Duration;
    }

    public function setDuration(\DateTimeInterface $Duration): self
    {
        $this->Duration = $Duration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->Creator;
    }

    public function setCreator(?User $Creator): self
    {
        $this->Creator = $Creator;

        return $this;
    }
}
