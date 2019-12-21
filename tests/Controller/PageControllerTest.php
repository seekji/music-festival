<?php

namespace App\Tests\Admin;

use App\DataFixtures\LoadArtistDataFixture;
use App\DataFixtures\LoadContextDataFixture;
use App\DataFixtures\LoadMenuDataFixture;
use App\DataFixtures\LoadNewsDataFixture;
use App\DataFixtures\LoadPageDataFixture;
use App\DataFixtures\LoadSliderDataFixture;
use App\DataFixtures\LoadZonesDataFixture;
use App\Entity\Locale\LocaleInterface;
use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use App\DataFixtures\LoadAdminDataFixture as FixtureAdmin;

class PageControllerTest extends WebTestCase
{
    protected static $wasSetup = false;

    protected function setUp()
    {
        parent::setUp();

        if (false === static::$wasSetup) {
            $this->loadFixtures([
                LoadContextDataFixture::class,
                LoadMenuDataFixture::class,
                LoadZonesDataFixture::class,
                LoadPageDataFixture::class,
            ]);

            static::$wasSetup = true;
        }
    }

    public function testPagesStatus()
    {
        $pages = $this->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository(Page::class)->findAll();
        $client = static::createClient();

        foreach ($pages as $page) {
            $client->request('GET', $this->getUrl('app.page', ['_locale' => $page->getLocale(), 'slug' => $page->getSlug()]));
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
    }

}