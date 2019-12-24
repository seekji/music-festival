<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use App\Entity\Locale\LocaleInterface;
use App\Entity\Locale\LocaleTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist implements LocaleInterface
{
    use Timestampable, LocaleTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $sort = 100;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHeadliner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startAt;

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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isShowTime = true;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSort(): ?int
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     * @return $this
     */
    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsHeadliner(): ?bool
    {
        return $this->isHeadliner;
    }

    /**
     * @param bool $isHeadliner
     * @return $this
     */
    public function setIsHeadliner(bool $isHeadliner): self
    {
        $this->isHeadliner = $isHeadliner;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    /**
     * @param \DateTimeInterface $startAt
     * @return $this
     */
    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getName();
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsShowTime(): ?bool
    {
        return $this->isShowTime;
    }

    public function setIsShowTime(bool $isShowTime): self
    {
        $this->isShowTime = $isShowTime;

        return $this;
    }
}
