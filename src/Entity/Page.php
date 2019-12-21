<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\Locale\LocaleTrait;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Sluggable\Sluggable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @UniqueEntity("slug", message="slug.not_unique")
 */
class Page
{
    use Timestampable, LocaleTrait, Sluggable;

    public const TEMPLATE_CONTENT = 1;
    public const TEMPLATE_HISTORY = 2;
    public const TEMPLATE_INFO = 3;
    public const TEMPLATE_PLACE = 4;
    public const TEMPLATE_FAN = 5;

    const TEMPLATES = [
        self::TEMPLATE_CONTENT => 'static',
        self::TEMPLATE_HISTORY => 'history',
        self::TEMPLATE_INFO => 'info',
        self::TEMPLATE_PLACE => 'place',
        self::TEMPLATE_FAN => 'fan-zones',
    ];

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
    private $template = self::TEMPLATE_CONTENT;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\History", mappedBy="page", orphanRemoval=true, cascade={"persist"})
     */
    private $history;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordinates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mapLink;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $howToRoute = [];

    public function __construct()
    {
        $this->history = new ArrayCollection();
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

    /**
     * @return int|null
     */
    public function getTemplate(): ?int
    {
        return $this->template;
    }

    /**
     * @param int $template
     * @return Page
     */
    public function setTemplate(int $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return $this
     */
    public function setSlug($slug): self
    {
        $this->slug = self::slugify($slug);

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @static
     *
     * @param string $text
     *
     * @return string
     */
    public static function slugify($text): string
    {
        $text = Slugify::create()->slugify($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    /**
     * Returns an array of the fields used to generate the slug.
     *
     * @return array
     */
    public function getSluggableFields(): array
    {
        return ['title'];
    }

    /**
     * Disable slug regeneration in update.
     *
     * @return bool
     */
    public function getRegenerateSlugOnUpdate(): bool
    {
        return false;
    }

    public function __toString(): ?string
    {
        return $this->title;
    }

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function setSubTitle(?string $subTitle): self
    {
        $this->subTitle = $subTitle;

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
     * @return Collection|History[]
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(History $history): self
    {
        if (!$this->history->contains($history)) {
            $this->history[] = $history;
            $history->setPage($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->history->contains($history)) {
            $this->history->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getPage() === $this) {
                $history->setPage(null);
            }
        }

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

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(?string $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getMapLink(): ?string
    {
        return $this->mapLink;
    }

    public function setMapLink(?string $mapLink): self
    {
        $this->mapLink = $mapLink;

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
}
