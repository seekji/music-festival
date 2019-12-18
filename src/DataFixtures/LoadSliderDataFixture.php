<?php

namespace App\DataFixtures;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\Locale\LocaleInterface;
use App\Entity\Partner;
use App\Entity\Slider;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class LoadSliderDataFixture
 * @package App\DataFixtures
 */
class LoadSliderDataFixture extends Fixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private const DATA_COUNT = 7;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $file = new UploadedFile(__DIR__ . '/static/main_slider.jpg', basename(__DIR__ . '/static/main_slider.jpg'), null, null, null, true);

        $media = new Media();
        $media->setBinaryContent($file);
        $media->setContext('slider');
        $media->setProviderName('sonata.media.provider.image');

        $this->faker = Factory::create();

        for($i = 0; $i <= self::DATA_COUNT; $i++) {
            $slider = new Slider();

            $slider->setTitle($this->faker->name);
            $slider->setPicture($media);
            $slider->setLocale($this->faker->randomKey(LocaleInterface::LOCALE_LIST));
            $slider->setIsActive(true);

            $manager->persist($slider);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 70;
    }
}