<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatControllerTest extends WebTestCase
{
    public function testStat(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/stat');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
