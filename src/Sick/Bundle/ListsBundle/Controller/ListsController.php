<?php

namespace Sick\Bundle\ListsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sick\Bundle\ListsBundle\Entity\ListItem;

class ListsController extends Controller
{
    public function indexAction()
    {

		$repository = $this->getDoctrine()
							->getRepository('SickListsBundle:ListItem');

		$items = $repository->findAll();

		$item = new ListItem();

		$form = $this->createFormBuilder($item)
					->setAction($this->generateUrl('sick_lists_postitem'))
					->add('text', 'text', array(
						'attr' => array('placeholder' => 'Enter a task')
					))
					->getForm();

        return $this->render('SickListsBundle:Lists:index.html.twig', array(
			'form' => $form->createView(),
			'items' => $items
		));    
	}

	public function addItemAction(Request $request)
	{
		$item = new ListItem();

		$form = $this->createFormBuilder($item)
					->setAction($this->generateUrl('sick_lists_postitem'))
					->add('text', 'text', array(
						'attr' => array('placeholder' => 'Enter a task')
					))
					->getForm();

		$form->bind($request);

		if ($form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($item);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('sick_lists_homepage'));
	}

}
