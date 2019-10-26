<?php

    namespace App\Twig;

    use Twig\Extension\AbstractExtension;
    use Twig\TwigFunction;
    use Twig\TwigFilter;

    class AppExtension extends AbstractExtension
    {
        /**
         * @return array|TwigFilter[]
         */
        public function getFilters()
        {
            return [
                new TwigFilter('phoneHref', [$this, 'phoneHref']),
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
    }