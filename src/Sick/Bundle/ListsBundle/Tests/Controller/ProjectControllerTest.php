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
			'text' => 'A Project'
		));

		$this->assertCount(1, $crawler->filter('#content.items li:contains("A Project")'));
	}
}
