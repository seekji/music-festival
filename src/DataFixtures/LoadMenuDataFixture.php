<?php

namespace App\DataFixtures;

use App\Entity\Locale\LocaleInterface;
use App\Entity\Menu;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadMenuDataFixture
 * @package App\DataFixtures
 */
class LoadMenuDataFixture extends Fixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private const DATA_COUNT = 10;

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
        $this->faker = Factory::create();

        for($i = 0; $i <= self::DATA_COUNT; $i++) {
            $page = new Menu();

            $page->setTitle($this->faker->text(5));
            $page->setLink($this->faker->url);
            $page->setLocale($this->faker->randomKey(LocaleInterface::LOCALE_LIST));
            $page->setLocation($this->faker->randomKey(Menu::LOCATION_LIST));

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
        return 50;
    }
}