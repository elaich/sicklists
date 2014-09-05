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
		$project = new Project();

		$manager->persist($project);
		$manager->flush();

		$this->addReference('project-1', $project);
	}

	public function getOrder()
	{
		return 1;
	}
}

