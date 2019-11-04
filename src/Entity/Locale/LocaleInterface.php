<?php

namespace App\Entity\Locale;

/**
 * Interface LocaleInterface
 * @package App\Entity\Locale
 */
interface LocaleInterface
{
    /**
     * En locale.
     */
    public const LAN_EN = 'en';

    /**
     * Ru locale.
     */
    public const LAN_RU = 'ru';

    /**
     * List of available locales.
     */
    public const LOCALE_LIST = [
        self::LAN_RU => 'Ру',
        self::LAN_EN => 'En'
    ];

    /**
     * @param string $locale
     * @return self
     */
    public function setLocale(string $locale);

    /**
     * @return string
     */
    public function getLocale(): string;
}