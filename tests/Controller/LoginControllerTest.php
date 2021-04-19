<?php 

// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use App\Entity\AssetUser;
use App\Repository\AssetUserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(AssetUserRepository::class);

        // retrieve the test user
        $testUser = new AssetUser();
        $testUser->setUserName('donimuzur');
        $testUser->setUserPassword('Itsugaya04101993');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // test e.g. the profile page
        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
    }
}