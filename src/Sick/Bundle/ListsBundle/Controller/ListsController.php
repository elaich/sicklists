<?php

namespace Sick\Bundle\ListsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListsController extends Controller
{
    public function indexAction()
    {

		$repository = $this->getDoctrine()
							->getRepository('SickListsBundle:ListItem');

		$items = $repository->findAll();

        return $this->render('SickListsBundle:Lists:index.html.twig', array(
			'items' => $items
		));    
	}

}
