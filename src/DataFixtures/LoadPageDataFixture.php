<?php

namespace App\DataFixtures;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\History;
use App\Entity\Locale\LocaleInterface;
use App\Entity\Page;
use App\Entity\Zone;
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
 * Class LoadPageDataFixture
 * @package App\DataFixtures
 */
class LoadPageDataFixture extends Fixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private const DATA_COUNT = 15;

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
        $zones = $manager->getRepository(Zone::class)->findAll();
        $this->faker = Factory::create();

        $file = new UploadedFile(__DIR__ . '/static/history.png', basename(__DIR__ . '/static/history.png'), null, null, null, true);

        $media = new Media();
        $media->setBinaryContent($file);
        $media->setContext('artists');
        $media->setProviderName('sonata.media.provider.image');

        for($i = 0; $i <= self::DATA_COUNT; $i++) {
            $page = new Page();

            $page->setTitle($this->faker->text(20));
            $page->setIsActive(true);
            $page->setSubTitle($this->faker->text(10));
            $page->setSlug($page->getTitle());
            $page->setLocale($this->faker->randomKey(LocaleInterface::LOCALE_LIST));
            $page->setTemplate($this->faker->randomKey(Page::TEMPLATES));
            $page->setDescription($this->faker->text(500));
            $page->setCoordinates('33.33;33.33');
            $page->setHowToRoute([['title' => $this->faker->title, 'description' => $this->faker->text]]);
            $page->setInfoLinks([['title' => $this->faker->title, 'link' => $this->faker->url]]);
            $page->setMapLink($this->faker->url);
            $page->addZone($zones[array_rand($zones)]);
            $page->addHistory(
                (new History())
                    ->setYear($this->faker->year)
                    ->setDescription($this->faker->text)
                    ->setViewers($this->faker->randomNumber())
                    ->setViewersTitle($this->faker->title)
                    ->setPage($page)
                    ->setPicture($media)
                    ->setLineup([$this->faker->name, $this->faker->name])
            );


            $manager->persist($page);
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
        return 40;
    }
}