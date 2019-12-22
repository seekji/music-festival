<?php

namespace App\Tests\Admin;

use App\DataFixtures\LoadArtistDataFixture;
use App\DataFixtures\LoadContextDataFixture;
use App\DataFixtures\LoadMenuDataFixture;
use App\DataFixtures\LoadNewsDataFixture;
use App\DataFixtures\LoadPageDataFixture;
use App\DataFixtures\LoadSliderDataFixture;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    protected static $wasSetup = false;

    protected function setUp()
    {
        parent::setUp();

        if (false === static::$wasSetup) {
            $this->loadFixtures([
                LoadContextDataFixture::class,
                LoadSliderDataFixture::class,
                LoadNewsDataFixture::class,
                LoadArtistDataFixture::class,
                LoadMenuDataFixture::class,
            ]);

            static::$wasSetup = true;
        }
    }

    public function testHomePage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEnHomePage()
    {
        $client = static::createClient();

        $client->request('GET', '/en/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}