<?php

namespace Sick\Bundle\ListsBundle\Controller;

use Sick\Bundle\ListsBundle\Entity\Project;
use Sick\Bundle\ListsBundle\Form\ProjectType;

use Sick\Bundle\ListsBundle\Form\ListItemType;
use Sick\Bundle\ListsBundle\Entity\ListItem;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller
{
	public function indexAction($project_id)
	{
		$repository = $this->getDoctrine()
							->getRepository('SickListsBundle:Project');
		$projects = $repository->findAll();

		$project = new Project();
		$form = $this->createForm(new ProjectType(), $project);

		return $this->render('SickListsBundle:Projects:projects.html.twig', array(
			'form' => $form->createView(),
			'projects' => $projects,
			'project_id' => $project_id,
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

	public function showProjectAction($id)
	{
		$repository = $this->getDoctrine()
							->getRepository('SickListsBundle:ListItem');

		$items = $repository->findBy(array('project' => $id));

		$item = new ListItem();

		$form = $this->createForm(new ListItemType(), $item);

        return $this->render('SickListsBundle:Lists:index.html.twig', array(
			'form' => $form->createView(),
			'items' => $items,
			'project_id' => $id,
		)); 
	}

	public function addTaskToProjectAction(Request $request, $id)
	{
		$repository = $this->getDoctrine()
							->getRepository('SickListsBundle:Project');
		$project = $repository->find($id);

		$task = new ListItem();
		$task->setProject($project);

		$form = $this->createForm(new ListItemType(), $task);

		$form->bind($request);
		if ($form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($task);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('sick_lists_show_project', array(
			'id' => $id)));
	}
}
