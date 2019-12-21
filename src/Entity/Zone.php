<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZoneRepository")
 */
class Zone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $howToRoute = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ZoneLineup", mappedBy="zone", orphanRemoval=true, cascade={"persist"})
     */
    private $lineup;

    public function __construct()
    {
        $this->lineup = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getHowToRoute(): ?array
    {
        return $this->howToRoute;
    }

    public function setHowToRoute(?array $howToRoute): self
    {
        $this->howToRoute = $howToRoute;

        return $this;
    }

    /**
     * @return Collection|ZoneLineup[]
     */
    public function getLineup(): Collection
    {
        return $this->lineup;
    }

    public function addLineup(ZoneLineup $lineup): self
    {
        if (!$this->lineup->contains($lineup)) {
            $this->lineup[] = $lineup;
            $lineup->setZone($this);
        }

        return $this;
    }

    public function removeLineup(ZoneLineup $lineup): self
    {
        if ($this->lineup->contains($lineup)) {
            $this->lineup->removeElement($lineup);
            // set the owning side to null (unless already changed)
            if ($lineup->getZone() === $this) {
                $lineup->setZone(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->city;
    }
}
