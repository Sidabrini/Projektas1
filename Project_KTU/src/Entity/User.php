<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("Email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank
     */
    private $Lastname;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $Birthdate;

    /**
     * @ORM\Column(type="string", length=70)
     * @Assert\NotBlank
     * @Assert\Length(max = 70)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $Password_hash;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsAdmin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="Creator", orphanRemoval=true)
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->Birthdate;
    }

    public function setBirthdate(\DateTimeInterface $Birthdate): self
    {
        $this->Birthdate = $Birthdate;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->Password_hash;
    }

    public function setPasswordHash(string $Password_hash): self
    {
        $this->Password_hash = $Password_hash;

        return $this;
    }

    public function setPassword(string $password): void
    {
        $this->setPasswordHash(password_hash($password,1));
    }

    public function getIsAdmin(): ?bool
    {
        return $this->IsAdmin;
    }

    public function setIsAdmin(?bool $IsAdmin): self
    {
        $this->IsAdmin = $IsAdmin;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setCreator($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getCreator() === $this) {
                $event->setCreator(null);
            }
        }

        return $this;
    }

    public function  __toString()
    {
        return (string) $this->getId();
    }

    public function getRoles()
    {
        if($this->getIsAdmin() !== null &&
            $this->getIsAdmin() == "true"){
            return [
                'ROLE_ADMIN',
                'ROLE_USER'
            ];
        }

        return [
            'ROLE_USER'
        ];
    }
    public function getPassword()
    {
        return $this->getPasswordHash();
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function  getUsername()
    {
        return $this->getEmail();
    }
    public  function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
