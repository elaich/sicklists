<?php

namespace Sick\Bundle\ListsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase 
{
	public function testAddProject()
	{
		$client = static::createClient();
		$client->followRedirects();
		$crawler = $client->request('GET', '/');

		$add_project_link = $crawler->filter('#left-menu a:contains("Add Project")');

		$this->assertEquals(1, $add_project_link->count());

		$crawler = $client->click($add_project_link->link());

		$form = $crawler->selectButton('Add Project')->form();

		$crawler = $client->submit($form, array(
			'sick_bundle_listsbundle_project[text]' => 'A Project'
		));

		$this->assertEquals(1, $crawler->filter('#left-menu li:contains("A Project")')->count());

		$em = $this::$kernel->getContainer()->get('doctrine')->getManager();
		$repository = $em->getRepository('SickListsBundle:Project');
		$itemsToBeDeleted = $repository->findBy(array('text' => 'A Project'));

		foreach ($itemsToBeDeleted as $item)
			$em->remove($item);
		$em->flush();

	}

	public function testEditProject()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/');

		$project_link = $crawler->selectLink('A little project')->link();

		$crawler = $client->click($project_link);

		$this->assertEquals(1, $crawler->filter('#content li:contains("Buy 20 grams")')->count());
		$this->assertEquals(0, $crawler->filter('#content li:contains("Smoke 20 grams")')->count());
	}

	public function testAddTaskToProject()
	{
		$client = static::createClient();
		$crawler = $client->request('GET', '/');

		$project_link = $crawler->selectLink('A little project')->link();

		$crawler = $client->click($project_link);

		$form = $crawler->filter('#content form')->form();

		$crawler = $client->submit($form, array(
			'sick_lists_form[text]' => 'Can you do this?'
		));

		$uri = $client->getRequest()->getUri();
		$this->assertRegExp('/http:\/\/localhost\/projects\/\d+\/new/', $uri);

		$crawler = $client->followRedirect();
		$uri = $client->getRequest()->getUri();
		$this->assertRegExp('/http:\/\/localhost\/projects\/\d+/', $uri);

		$this->assertEquals(1, $crawler->filter('#content li:contains("Can you do this?")')->count());

		$em = $this::$kernel->getContainer()->get('doctrine')->getManager();
		$repository = $em->getRepository('SickListsBundle:ListItem');
		$itemsToBeDeleted = $repository->findBy(array('text' => 'Can you do this?'));

		foreach ($itemsToBeDeleted as $item)
			$em->remove($item);
		$em->flush();
	}

}
