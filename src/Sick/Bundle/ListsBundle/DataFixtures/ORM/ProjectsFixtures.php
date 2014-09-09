<?php
namespace Sick\Bundle\ListsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sick\Bundle\ListsBundle\Entity\Project;

class ProjectsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$project1 = new Project();
		$project1->setText('A little project');

		$manager->persist($project1);
		$manager->flush();

		$project2 = new Project();
		$project2->setText('Another little project');

		$manager->persist($project2);
		$manager->flush();

		$this->addReference('project-1', $project1);
		$this->addReference('project-2', $project2);
	}

	public function getOrder()
	{
		return 1;
	}
}

