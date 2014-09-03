<?php

namespace Sick\Bundle\ListsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

		$this->assertGreaterThan(
			0,
			$crawler->filter('html:contains("1: Buy 20 grams")')->count(),
			"Didn't may be you have to do something"
		);
    }

}
