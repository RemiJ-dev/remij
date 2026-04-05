<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RobotsActionTest extends WebTestCase
{
    public function testRobotsReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/robots.txt');

        self::assertResponseIsSuccessful();
    }
}
