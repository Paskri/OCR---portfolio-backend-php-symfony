<?php

namespace App\Controller;

use App\Entity\Work;
use App\Form\WorkType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN'), Route('/works')]
class WorksController extends AbstractController
{
    #[Route('/', name: 'app_works')]
    public function works(ManagerRegistry $doctrine): Response
    {   
        $repository = $doctrine->getRepository(Work::class);
        $works = $repository->findAll();
        return $this->render('works/index.html.twig', [
            'works' => $works
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/edit/{id?0}', name: 'app_edit_work')]
    public function editWork(
        $id,
        ManagerRegistry $doctrine,
        Request $request
        ): Response
    {
    $repository = $doctrine->getRepository(Work::class);
    $work = $repository->find($id);
    $new= false;
    if (!$work) {
        $new = true;
        $work = new Work();
    }
    $form = $this->createForm(WorkType::class, $work);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        if ($new) {
            $message = "Le projet a été ajouté avec succès";
        } else {
            $message = "Le projet a été édité avec succès";
        }

        $manager = $doctrine->getManager();
        
        $manager->persist($work);
        $manager->flush();
        //dd($work);
        $this->addFlash('success', $message);
        return $this->render('works/workEdit.html.twig', [
            'form' => $form->createView(),
        ]);//$this->redirectToRoute('app_works');
    } else {
        return $this->render('works/workEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/delete/{id}', name: 'app_delete_work')]
    public function workDelete(ManagerRegistry $doctrine, EntityManagerInterface $em, $id): Response
    {
        //get repo
        $repository = $doctrine->getRepository(Work::class);
        // get skill to delete
        $work = $repository->find($id);
        //removing with entityManager
        $em->remove($work);
        //flushing as usual
        $em->flush();
        //adding success message
        $this->addFlash('success', 'Le projet a été supprimé');
        //redirecting
        return $this->redirectToRoute('app_works');
    }

    
}
