<?php
namespace Sick\Bundle\ListsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sick\Bundle\ListsBundle\Entity\ListItem;

class ListsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$item1 = new ListItem();
		$item1->setText("Buy 20 grams");
		$item1->setProject($this->getReference('project-1'));

		$manager->persist($item1);
		$manager->flush();

		$item2 = new ListItem();
		$item2->setText("Smoke 20 grams");
		$item2->setProject($this->getReference('project-2'));

		$manager->persist($item2);
		$manager->flush();
	}

	public function getOrder()
	{
		return 2;
	}
}
