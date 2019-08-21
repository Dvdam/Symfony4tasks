<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TaskType;
use Symfony\Component\Security\Core\User\UserInterface;


class TaskController extends AbstractController
{
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $task_repo = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $task_repo->findBy([], ['id' => 'DESC']);
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);

    }

    // Metodo para mostrar una tarea en particular
    public function detail(Task $task)
    {
        if(!$task){
        return $this->redirectToRoute('tasks');
        }

        return $this->render('task/detail.html.twig', [
            'task' => $task
        ]);
    }

    // Metodo para crear nuevas tareas
    public function creation(Request $request, UserInterface $user)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
 
            $task->setCreatedAt(new \DateTime('now'));
            $task->setUser($user);

            // var_dump($task);

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();


            return $this->redirect(
                $this->generateUrl('task_detail', ['id' => $task->getId()]
                )
            );
        }

        return $this->render('task/creation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Metodo para mostrar las tareas propias de cada usuario
    public function myTask(UserInterface $user)    
    {
        $tasks = $user->getTasks();

        return $this->render('task/my-tasks.html.twig',[
            'tasks' => $tasks
        ]);

    }

    // Metodo para Editar una Tarea
    public function edit(Request $request, UserInterface $user,Task $task)    
    {
        // var_dump($task);
        // if($user && $user->getId() == $task->getUser()->getId() ){
        if(!$user || $user->getId() != $task->getUser()->getId() ){
            return $this->redirectToRoute('tasks');
        }

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
 
            // $task->setCreatedAt(new \DateTime('now'));
            // $task->setUser($user);

            // var_dump($task);

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();


            return $this->redirect(
                $this->generateUrl('task_detail', ['id' => $task->getId()]
                )
            );
        }

        return $this->render('task/creation.html.twig',[
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

    // Metodo para Eliminar Tarea

    public function delete(UserInterface $user,Task $task)
    {
        if(!$user || $user->getId() != $task->getUser()->getId()){
            return $this->redirectToRoute('tasks');
        }

        if(!$task){
            return $this->redirectToRoute('tasks');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('tasks');

    }

    
}
