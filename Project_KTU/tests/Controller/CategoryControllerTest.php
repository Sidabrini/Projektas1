<?php
/**
 * Created by PhpStorm.
 * User: Evaldas
 * Date: 22/05/2019
 * Time: 12:06
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CategoryControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testLogin()
    {
        $this->login();
        $this->client->request('GET', '/admin/category/');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    private function login()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallContext = 'main';

        $token = new UsernamePasswordToken('admin', null, 'main', array('ROLE_ADMIN', 'ROLE_USER'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    public function testCreateNew()
    {
        $this->login();
        $category = 'naujaKategorija';
        $crawler = $this->client->request('GET', '/admin/category/');
        $categoryCount = $crawler->filter('html:contains("'.$category.'")')->count();
        $this->client->request('GET', '/admin/category/new');
        $this->client->submitForm('Save', [
            'category[Name]' => $category
        ]);

        $this->assertTrue($this->client->getResponse()->isRedirect('/admin/category/'));
        $this->client->followRedirect();
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            $categoryCount,
            $this->client
                ->request('GET', '/admin/category/')
                ->filter('html:contains("'.$category.'")')
                ->count());

        $this->editTest($category);
        $this->deleteTest($categoryCount, $category);
    }

    public function deleteTest(int $categoryCount, string $category)
    {
        $usersCount = $this->client
            ->request('GET', '/admin/category/')
            ->filter('a:contains("edit")')
            ->count();
        $link = $this->client
            ->request('GET', '/admin/category/')
            ->filter('a:contains("edit")')
            ->eq($usersCount-1)
            ->link();
        $crawler = $this->client->click($link);
        $this->assertGreaterThan(
            0,
            $crawler->filter('button:contains("Delete")')
                ->count());
        $this->client->submitForm('Delete');
        $this->assertTrue($this->client->getResponse()->isRedirect('/admin/category/'));
        $crawler = $this->client->followRedirect();
        $this->assertSame(
            $categoryCount,
            $crawler->filter('html:contains("'.$category.'")')
                ->count());
    }

    public function editTest(string $category)
    {
        $usersCount = $this->client
            ->request('GET', '/admin/category/')
            ->filter('a:contains("edit")')
            ->count();
        $link = $this->client
            ->request('GET', '/admin/category/')
            ->filter('a:contains("edit")')
            ->eq($usersCount-1)
            ->link();
        $this->client->click($link);
        $this->client->submitForm('Update', [
            'category[Name]' => 'PakeistaKategorija'
        ]);
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $crawler = $this->client->followRedirect();
        $this->assertSame(
            1,
            $crawler->filter('html:contains("PakeistaKategorija")')
                ->count());

        $this->client->click($link);
        $this->client->submitForm('Update', [
            'category[Name]' => $category
        ]);
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $crawler = $this->client->followRedirect();
        $this->assertSame(
            1,
            $crawler->filter('html:contains("'.$category.'")')
                ->count());
    }
}