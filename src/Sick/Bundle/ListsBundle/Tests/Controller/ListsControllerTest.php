<?php

namespace Sick\Bundle\ListsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListsControllerTest extends WebTestCase
{
	protected $client;

	public function setUp()
	{
		parent::setUp();

		$this->client = static::createClient();
	}

	public function testIndex()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertGreaterThan(
			0,
			$crawler->filter('html:contains("1: Buy 20 grams")')->count(),
			"Didn't may be you have to do something"
		);
	}

	public function testFormToAddItems()
	{
		$crawler = $this->client->request('GET', '/');

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
		$this->client->request('POST', '/items/new', array('text' => 'Call abdelatif'));

		$this->assertEquals(302, $this->client->getResponse()->getStatusCode());
	}

	public function testPostItemRequestRoute()
	{
		$this->client->request('POST', '/items/new', array('text' => 'Call abdelatif'));

		$this->assertEquals('sick_lists_postitem', 
			$this->client->getRequest()->attributes->get('_route'));
	}

	public function testPostItemRequestMethod()
	{
		$this->client->request('POST', '/items/new', array('text' => 'Call abdelatif'));

		$this->assertEquals('Sick\Bundle\ListsBundle\Controller\ListsController::addItemAction',
			$this->client->getRequest()->attributes->get('_controller'));

	}

	public function testPostItem()
	{
		$this->client->followRedirects(true);

		$crawler = $this->client->request('GET', '/');

		$form = $crawler->filter('form')->form();

		$crawler = $this->client->submit($form, array(
			'form[text]' => 'Call abdelatif'
		));

		$this->assertGreaterThan(
			0,
			$crawler->filter('html:contains("1: Buy 20 grams")')->count(),
			'post is fchkel'
		);

		$this->assertGreaterThan(
			0,
			$crawler->filter('html:contains("Call abdelatif")')->count()
		);

		// deleting the just added item
		
		$em = $this::$kernel->getContainer()->get('doctrine')->getManager();
		$repository = $em->getRepository('SickListsBundle:ListItem');
		$itemsToBeDeleted = $repository->findBy(array('text' => 'Call abdelatif'));

		foreach ($itemsToBeDeleted as $item)
			$em->remove($item);
		$em->flush();
	}

}
