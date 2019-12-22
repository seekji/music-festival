<?php

namespace App\DataFixtures;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\Artist;
use App\Entity\Locale\LocaleInterface;
use App\Entity\Zone;
use App\Entity\ZoneLineup;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadZonesDataFixture extends Fixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private const DATA_COUNT = 5;

    private $container;

    private $faker;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for($i = 0; $i <= self::DATA_COUNT; $i++) {
            $zone = new Zone();

            $zone->setCity($this->faker->city);
            $zone->setDescription($this->faker->text(300));
            $zone->setHowToRoute([
                [
                    'title' => $this->faker->firstName,
                    'description' => $this->faker->text(200)
                ]
            ]);

            $zone->addLineup(
                (new ZoneLineup())
                ->setTitle($this->faker->title)
                ->setTime($this->faker->dateTime)
                ->setDescription($this->faker->text)
            );

            $manager->persist($zone);
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
        return 25;
    }
}