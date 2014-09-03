<?php

namespace Sick\Bundle\ListsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListsController extends Controller
{
    public function indexAction()
    {
        return $this->render('SickListsBundle:Lists:index.html.twig', array(
                // ...
		));    
	}

}
