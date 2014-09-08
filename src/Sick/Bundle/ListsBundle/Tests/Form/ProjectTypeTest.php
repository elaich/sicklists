<?php

namespace Sick\Bundle\ListsBundle\Tests\Form;

use Sick\Bundle\ListsBundle\Form\ProjectType;
use Sick\Bundle\ListsBundle\Entity\Project;

use Symfony\Component\Form\Test\TypeTestCase;

class ProjectTypeTest extends TypeTestCase
{

	public function testSubmitValidData()
	{
		$formData = array (
			'text' => 'A project'
		);

		$projectType = new ProjectType();
		$form = $this->factory->create($projectType);

		$project = new Project();
		$project->setText($formData['text']);

		$form->submit($formData);

		$this->assertTrue($form->isSynchronized());
		$this->assertEquals($project, $form->getData());

		$view = $form->createView();
		$children = $view->children;

		forEach (array_keys($formData) as $key)
		{
			$this->assertArrayHasKey($key, $children);
		}
	}
}
