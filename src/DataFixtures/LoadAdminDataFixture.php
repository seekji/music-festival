<?php

namespace App\DataFixtures;

use App\Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAdminDataFixture
 * @package App\DataFixtures
 */
class LoadAdminDataFixture extends Fixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

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
        $manager->persist(static::getFakeAdmin());
        $manager->persist(static::getFakeModerator());

        $manager->flush();
    }

    /**
     * @return User
     */
    public static function getFakeAdmin(): User
    {
        $admin = new User();

        $admin->setEmail('admin@symfony.com');
        $admin->setUsername('admin');
        $admin->setPlainPassword('admin');
        $admin->setEnabled(true);
        $admin->setSuperAdmin(true);

        return $admin;
    }

    /**
     * @return User
     */
    public static function getFakeModerator(): User
    {
        $moderator = (new User())
            ->setEmail('moderator@symfony.com')
            ->setUsername('moderator')
            ->setPlainPassword('moderator')
            ->setEnabled(true)
            ->setRoles([
                'ROLE_ADMIN',
            ]);

        return $moderator;
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 0;
    }
}