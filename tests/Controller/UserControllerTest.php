<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testUser(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/user');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }

    public function tesEditUser(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/user/edit');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
