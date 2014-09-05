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
		$item = new ListItem();
		$item->setText("Buy 20 grams");
		$item->setProject($this->getReference('project-1'));

		$manager->persist($item);
		$manager->flush();
	}

	public function getOrder()
	{
		return 2;
	}
}
