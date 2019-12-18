<?php

    namespace App\Twig;

    use App\Service\SettingsService;
    use Twig\Extension\AbstractExtension;
    use Twig\TwigFunction;
    use Twig\TwigFilter;

    class AppExtension extends AbstractExtension
    {

        private $settingsService;

        public function __construct(SettingsService $settingsService)
        {
            $this->settingsService = $settingsService;
        }

        /**
         * @return array|TwigFilter[]
         */
        public function getFilters()
        {
            return [
                new TwigFilter('phoneHref', [$this, 'phoneHref']),
            ];
        }

        public function getFunctions()
        {
            return [
                new TwigFunction('getSiteSettingByKey', [$this, 'getSiteSettingByKey']),
                new TwigFunction('getLocalSiteSettingByKey', [$this, 'getLocalSiteSettingByKey']),
            ];
        }

        /**
         * @param $phone
         * @return string|string[]|null
         */
        public function phoneHref($phone)
        {
            return preg_replace('/[^0-9]/', '', $phone);
        }

        public function getSiteSettingByKey(string $key): ?string
        {
            return $this->settingsService->getValues()[$key] ?? null;
        }

        public function getLocalSiteSettingByKey(string $locale, string $key): ?string
        {
            return $this->settingsService->getValues()[$locale . '_' . $key] ?? null;
        }
    }