<?php
/**
 * Created by PhpStorm.
 * User: Evaldas
 * Date: 19/05/2019
 * Time: 19:12
 */

namespace App\Tests\Controller;


use App\Form\UserType;
use phpDocumentor\Reflection\Types\This;
use App\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Doctrine\Common\Persistence\ObjectManager;

class UserControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testLogin()
    {
        $this->login();
        $this->client->request('GET', '/admin/user/');

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
        $email = 'pastas@gmail.com';
        $crawler = $this->client->request('GET', '/admin/user/');
        $usersCount = $crawler->filter('html:contains("'.$email.'")')->count();
        $this->client->request('GET', '/admin/user/new');
        $this->client->submitForm('Save', [
            'user[Name]' => 'vardas',
            'user[LastName]' => 'pavarde',
            'user[BirthDate][year]' => '1991',
            'user[BirthDate][month]' => '1',
            'user[BirthDate][day]' => '20',
            'user[Email]' => $email,
            'user[Password]' => 'slaptazodis',
        ]);

        $this->assertTrue($this->client->getResponse()->isRedirect('/admin/user/'));
        $this->client->followRedirect();
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            $usersCount,
            $this->client
                ->request('GET', '/admin/user/')
                ->filter('html:contains("'.$email.'")')
                ->count());

        $this->editTest($email);
        $this->deleteTest($usersCount, $email);
    }

    public function deleteTest(int $usersCountBefore, string $email)
    {
        $usersCount = $this->client
            ->request('GET', '/admin/user/')
            ->filter('a:contains("edit")')
            ->count();
        $link = $this->client
            ->request('GET', '/admin/user/')
            ->filter('a:contains("edit")')
            ->eq($usersCount-1)
            ->link();
        $crawler = $this->client->click($link);
        $this->assertGreaterThan(
            0,
            $crawler->filter('button:contains("Delete")')
                ->count());
        $this->client->submitForm('Delete');
        $this->assertTrue($this->client->getResponse()->isRedirect('/admin/user/'));
        $crawler = $this->client->followRedirect();
        $this->assertSame(
            $usersCountBefore,
            $crawler->filter('html:contains("'.$email.'")')
                ->count());
    }

    public function editTest(string $email)
    {
        $usersCount = $this->client
            ->request('GET', '/admin/user/')
            ->filter('a:contains("edit")')
            ->count();
        $link = $this->client
            ->request('GET', '/admin/user/')
            ->filter('a:contains("edit")')
            ->eq($usersCount-1)
            ->link();
        $this->client->click($link);
        $this->client->submitForm('Update', [
            'user[Email]' => 'naujaspastas@gmail.com'
        ]);
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $crawler = $this->client->followRedirect();
        $this->assertSame(
            1,
            $crawler->filter('html:contains("naujaspastas@gmail.com")')
                ->count());

        $this->client->click($link);
        $this->client->submitForm('Update', [
            'user[Email]' => $email
        ]);
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $crawler = $this->client->followRedirect();
        $this->assertSame(
            1,
            $crawler->filter('html:contains("'.$email.'")')
                ->count());
    }
}