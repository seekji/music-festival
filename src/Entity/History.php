<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository")
 */
class History
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
    private $year;

    /**
     * @ORM\Column(type="array")
     */
    private $lineup = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $viewers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $viewersTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(
     *     targetEntity="App\Application\Sonata\MediaBundle\Entity\Media",
     *     cascade={"persist"},
     * )
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Page", inversedBy="history", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $page;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getLineup(): ?array
    {
        return $this->lineup;
    }

    public function setLineup(array $lineup): self
    {
        $this->lineup = $lineup;

        return $this;
    }

    public function getViewers(): ?int
    {
        return $this->viewers;
    }

    public function setViewers(int $viewers): self
    {
        $this->viewers = $viewers;

        return $this;
    }

    public function getViewersTitle(): ?string
    {
        return $this->viewersTitle;
    }

    public function setViewersTitle(string $viewersTitle): self
    {
        $this->viewersTitle = $viewersTitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return null|Media
     */
    public function getPicture(): ?Media
    {
        return $this->picture;
    }

    /**
     * @param Media $picture
     *
     * @return $this
     */
    public function setPicture(?Media $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function __toString(): string
    {
        return $this->year;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }
}
