<?php

namespace Sick\Bundle\ListsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SickListsBundle:Default:index.html.twig', array('name' => $name));
    }
}
