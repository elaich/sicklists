<?php

namespace Sick\Bundle\ListsBundle\Controller;

use Sick\Bundle\ListsBundle\Entity\Project;
use Sick\Bundle\ListsBundle\Form\ProjectType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller
{
	public function indexAction()
	{
		$repository = $this->getDoctrine()
							->getRepository('SickListsBundle:Project');
		$projects = $repository->findAll();

		$project = new Project();
		$form = $this->createForm(new ProjectType(), $project);

		return $this->render('SickListsBundle:Projects:projects.html.twig', array(
			'form' => $form->createView(),
			'projects' => $projects
		));
	}

	public function addProjectAction(Request $request)
	{
		$project = new Project();
		$form = $this->createForm(new ProjectType(), $project);

		$form->bind($request);

		if ($form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($project);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('sick_lists_homepage'));
	}
}
