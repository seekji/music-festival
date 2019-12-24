<?php

namespace App\DataFixtures;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\Artist;
use App\Entity\Locale\LocaleInterface;
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
 * Class LoadArtistDataFixture
 * @package App\DataFixtures
 */
class LoadArtistDataFixture extends Fixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private const DATA_COUNT = 12;

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
        $file = new UploadedFile(__DIR__ . '/static/artist.jpg', basename(__DIR__ . '/static/artist.jpg'), null, null, null, true);

        $media = new Media();
        $media->setBinaryContent($file);
        $media->setContext('artists');
        $media->setProviderName('sonata.media.provider.image');

        $this->faker = Factory::create();

        for($i = 0; $i <= self::DATA_COUNT; $i++) {
            $artist = new Artist();

            $artist->setName($this->faker->name);
            $artist->setPicture($media);
            $artist->setLocale($this->faker->randomKey(LocaleInterface::LOCALE_LIST));
            $artist->setIsHeadliner($this->faker->boolean(20));
            $artist->setDescription($this->faker->text(100));
            $artist->setStartAt($this->faker->dateTimeBetween('now', '+1 day'));
            $artist->setIsShowTime(true);

            $manager->persist($artist);
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
        return 20;
    }
}