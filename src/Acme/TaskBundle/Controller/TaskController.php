<?php

namespace Acme\TaskBundle\Controller;

use Acme\TaskBundle\Entity\Category;
use Acme\TaskBundle\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\TaskBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TaskController
 * @package Acme\TaskBundle\Controller
 * @Route("/task")
 */
class TaskController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {
        return $this->render("AcmeTaskBundle:Default:homepage.html.twig");
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/new", name="task_new")
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $this->denyAccessUnlessGranted('view',$task, 'You don\'t have permission' );

        $form = $this->createForm('task', $task);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->container->get('doctrine')->getEntityManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_success', array('id' => $task->getId()));
        }

        return $this->render('AcmeTaskBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("task/success/{id}", name="task_success")
     */
    public function successAction(Task $task)
    {
//        $task = $this->getDoctrine()->getRepository("AcmeTaskBundle:Task")->find($id);
        $task_name = $task->getTask();

        return $this->render('AcmeTaskBundle:Default:success.html.twig', array(
            'task_name' => $task_name,
        ));
    }


    /**
     * @Route("/showAll", name="showAll")
     */
    public function showAllAction()
    {
        $tasks = $this->getDoctrine()->getRepository("AcmeTaskBundle:Task")->findAll();
        if(!$tasks)
        {
            throw $this->createNotFoundException('Not any task has been founded');
        }
        
        return $this->render("AcmeTaskBundle:Default:showAll.html.twig", array(
            'tasks' => $tasks,
        ));
    }

    /**
     * @param $id, $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/show/{id}", name="task_show")
     */
    public function showAction(Task $task)
    {
//        $task = $this->getDoctrine()->getRepository("AcmeTaskBundle:Task")->find($id);
        $this->denyAccessUnlessGranted('view',$task, 'You don\'t have access to this action' );
        if(!$task)
        {
            throw $this->createNotFoundException('Not found task', $id);
        }
        return $this->render("AcmeTaskBundle:Default:show.html.twig", array(
            'task' => $task
        ));
    }

    /**
     * @param $category
     * @Route("/category/{category}", name="show_by_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showByCategoryAction(Category $category)
    {
        $tasks = $this->getDoctrine()->getRepository("AcmeTaskBundle:Task")->findBy(array('category' => $category),array('task' => 'ASC'));
//        $category = $this->getDoctrine()->getRepository("AcmeTaskBundle:Category")->find($category);
        return $this->render("AcmeTaskBundle:Default:show_category.html.twig", array(
            'tasks' => $tasks, 'category' => $category,
        ));

    }

    /**
     * @Route("/show_category", name="show_category")
     */
    public function showCategoryAction()
    {
        $categories = $this->getDoctrine()->getRepository("AcmeTaskBundle:Category")->findAll();

        return $this->render("AcmeTaskBundle:Default:categories.html.twig", array(
            'categories' => $categories,
        ));
    }


    /**
     * @param Request $request
     * @param $id
     * @Route("/task_update/{id}", name="task_update")
     */
    public function updateAction(Request $request, Task $task)
    {
//        $task = $this->getDoctrine()->getRepository("AcmeTaskBundle:Task")->find($id);
        $this->denyAccessUnlessGranted('view',$task, 'You don\'t have access to this action' );
        if(!$task)
        {
            throw $this->createNotFoundException('Not found task', $task);
        }

        $form = $this->createForm('task', $task);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->container->get('doctrine')->getEntityManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute("task_show", array('id' => $task->getId()));
        }

        return $this->render('AcmeTaskBundle:Default:update.html.twig', array(
            'form' => $form->createView(), 'task' => $task,
        ));
    }
}
