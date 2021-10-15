<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function callBook(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/book');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }

    public function callLoan(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/loan');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }

    public function callMoreLoan(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/loan/more/2');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
