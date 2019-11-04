<?php

namespace App\Entity\Locale;

/**
 * Trait LocaleMethodsTrait
 * @package App\Entity\Locale
 */
trait LocaleTrait
{
    /**
     * @var string
     * @ORM\Column(type="string", length=3)
     */
    private $locale;

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }
}