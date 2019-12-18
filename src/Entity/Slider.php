<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\Locale\LocaleInterface;
use App\Entity\Locale\LocaleTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SliderRepository")
 */
class Slider implements LocaleInterface
{
    use Timestampable, LocaleTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $sort = 100;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

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

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getPicture(): ?Media
    {
        return $this->picture;
    }

    public function setPicture(?Media $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
