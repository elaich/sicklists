<?php
namespace Sick\Bundle\ListsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sick\Bundle\ListsBundle\Entity\ListItem;

class ListsFixtures implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$item = new ListItem();
		$item->setText("Buy 20 grams");

		$manager->persist($item);
		$manager->flush();
	}
}
