<?php

namespace App\Tests\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use App\DataFixtures\LoadAdminDataFixture as FixtureAdmin;

/**
 * Class AdminFunctionalTest
 * @package App\Tests\Admin
 */
class AdminFunctionalTest extends WebTestCase
{
    protected static $wasSetup = false;

    protected function setUp()
    {
        parent::setUp();

        if (false === static::$wasSetup) {
            $this->loadFixtures([
                FixtureAdmin::class
            ]);

            static::$wasSetup = true;
        }
    }

    /**
     * @return KernelBrowser
     */
    public function testAdminLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('button[type="submit"]')->form();

        $fakeAdmin = FixtureAdmin::getFakeAdmin();

        $form['_username'] = $fakeAdmin->getUsername();
        $form['_password'] = $fakeAdmin->getPlainPassword();

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();

        $client->request('GET', '/admin/dashboard');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        return $client;
    }

    /**
     * @depends      testAdminLogin
     * @dataProvider menuItemsListProvider
     * @param $link
     * @param KernelBrowser $client
     */
    public function testMenuItemList($link, KernelBrowser $client)
    {
        $client->request('GET', $link);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @depends      testAdminLogin
     * @dataProvider menuItemsCreateProvider
     * @param $link
     * @param KernelBrowser $client
     */
    public function testMenuItemCreate($link, KernelBrowser $client)
    {
        $client->request('GET', $link);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @depends testAdminLogin
     *
     * @param KernelBrowser $client
     */
    public function testAdminLogout(KernelBrowser $client)
    {
        $client->request('GET', '/admin/logout');
        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();

        $client->request('GET', '/admin/dashboard');
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    /**
     * @return array
     */
    public function menuItemsCreateProvider()
    {
        return [
            ['/admin/sonata/user/user/create'],
            ['/admin/sonata/user/group/create'],
            ['/admin/sonata/media/media/create?context=default&category=1&hide_context=0'],
            ['/admin/sonata/media/gallery/create?context=default'],
            ['/admin/adw/seo/redirectrule/create'],
            ['/admin/adw/seo/rule/create'],
            ['/robots/edit'],
            ['/admin/app/partner/create'],
            ['/admin/app/artist/create'],
            ['/admin/app/page/create'],
            ['/admin/app/menu/create'],
            ['/admin/app/news/create'],
            ['/admin/app/slider/create'],
            ['/admin/app/zone/create'],
            ['/admin/site/settings/edit'],
        ];
    }


    /**
     * @return array
     */
    public function menuItemsListProvider()
    {
        return [
            ['/admin/sonata/user/user/list'],
            ['/admin/sonata/user/group/list'],
            ['/admin/sonata/media/media/list'],
            ['/admin/sonata/media/gallery/list'],
            ['/admin/adw/seo/redirectrule/list'],
            ['/admin/adw/seo/rule/list'],
            ['/admin/app/partner/list'],
            ['/admin/app/artist/list'],
            ['/admin/app/page/list'],
            ['/admin/app/menu/list'],
            ['/admin/app/news/list'],
            ['/admin/app/slider/list'],
            ['/admin/app/zone/list'],
        ];
    }
}
