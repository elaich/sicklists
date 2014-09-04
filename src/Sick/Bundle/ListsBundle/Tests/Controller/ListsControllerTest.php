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

	public function testFormToAddItems()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/');

		$form = $crawler->filter('form');

		$this->assertGreaterThan(
			0,
			$form->count(),
			"Didn't find the form"
		);

		$input = $form->filter('input[name="form[text]"]');

		$this->assertEquals('Enter a task', $input->attr('placeholder'), "Add the placeholder ;)");
	}

	public function testPostItemResponse()
	{
		$client = static::createClient();

		$client->request('POST', '/items/new', array('text' => 'Call abdelatif'));

		$this->assertEquals(302, $client->getResponse()->getStatusCode());
	}

	public function testPostItemRequestRoute()
	{
		$client = static::createClient();

		$client->request('POST', '/items/new', array('text' => 'Call abdelatif'));

		$this->assertEquals('sick_lists_postitem', 
			$client->getRequest()->attributes->get('_route'));
	}

	public function testPostItemRequestMethod()
	{
		$client = static::createClient();

		$client->request('POST', '/items/new', array('text' => 'Call abdelatif'));

		$this->assertEquals('Sick\Bundle\ListsBundle\Controller\ListsController::addItemAction',
			$client->getRequest()->attributes->get('_controller'));
		
	}

	public function testPostItem()
	{
		$client = static::createClient();
		$client->followRedirects(true);

		$crawler = $client->request('GET', '/');

		$form = $crawler->filter('form')->form();

		$crawler = $client->submit($form, array(
			'form[text]' => 'Call abdelatif'
		));

		print_r($crawler->text());

		$this->assertGreaterThan(
			0,
			$crawler->filter('html:contains("1: Buy 20 grams")')->count(),
			'post is fchkel'
		);

		$this->assertGreaterThan(
			0,
			$crawler->filter('html:contains("Call abdelatif")')->count()
		);
	}

}
