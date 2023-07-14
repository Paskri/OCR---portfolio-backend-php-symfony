<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Service\UploaderService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Monolog\Level;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\VarDumper\Caster\ImgStub;

#[IsGranted('ROLE_ADMIN'), Route('/skills')]
class SkillsController extends AbstractController
{
    #[Route('/', name: 'app_skills')]
    public function skill(ManagerRegistry $doctrine): Response
    {   
        $repository = $doctrine->getRepository(Skill::class);
        $skills = $repository->findAll();
        return $this->render('skills/index.html.twig', [
            'skills' => $skills
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/edit/{id?0}', name: 'app_edit_skill')]
    public function skillEdit(
        $id,
        ManagerRegistry $doctrine, 
        Request $request, 
        UploaderService $uploaderservice,
        ): Response
    {   
        $repository = $doctrine->getRepository(Skill::class);
        $skill = $repository->find($id);
        $new = false;
        if(!$skill) {
            $new = true;
            $skill = new Skill();
        }
        //création du formulaire (image)
        $form = $this->createForm(SkillType::class, $skill);
        // éventuellement enlever des champs
        // $form->remove('nom du champ')

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $img = $form->get('img')->getData();
    
            if($img) {
                $directory = $this->getParameter('skills_directory');
                $skill->setImg($uploaderservice->uploadFile($img, $directory));
            }
            if ($new) {
                $message = "La compétence a été ajoutée avec succès";
            } else {
                $message = "La compétence a été éditée avec succès";
            }

            $manager = $doctrine->getManager();
            $manager->persist($skill);
            $manager->flush();
            //afficher un message de succès
            $this->addFlash('success', $message);
            //redirection vers page skills
            return $this->redirectToRoute('app_skills');
        } else {
            $directory = $this->getParameter('skills_directory');
            return $this->render('skills/skillEdit.html.twig', [
                'form' => $form->createView()
            ]);
        }
        
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/delete/{id}', methods: ['GET', 'DELETE'], name: 'app_delete_skill')]
    public function skillDelete(EntityManagerInterface $em, ManagerRegistry $doctrine, $id): Response
    {   
        //get repo
        $repository = $doctrine->getRepository(Skill::class);
        // get skill to delete
        $skill = $repository->find($id);
        //removing with entityManager
        $em->remove($skill);
        //flushing as usual
        $em->flush();
        //adding success message
        $this->addFlash('success', 'La compétence a été supprimée');
        //redirecting
        return $this->redirectToRoute('app_skills');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/moveup/{id}', name: 'app_skill_move_up')]
    public function workMoveUp(ManagerRegistry $doctrine, EntityManagerInterface $em, $id): response
    {
        //get repo
        $repository = $doctrine->getRepository(Skill::class);
        // get skill update
        $skill = $repository->find($id);
        $previousSkill = $repository->find($id -1);
        //sauvegarde des données de $skill dans un tableau associatif
        $dataSave = [
            'name' => $skill->getName(),
            'level' => $skill->getLevel(),
            'img' => $skill->getImg(),
            'bgColor' => $skill->getBgColor(),
            'pureName' => $skill->getPureName()
        ];
        
        //descend les valeurs de previousSkill dans skill
        $skill->setName($previousSkill->getName());
        $skill->setLevel($previousSkill->getLevel());
        $skill->setImg($previousSkill->getImg());
        $skill->setBgColor($previousSkill->getBgColor());
        $skill->setPureName($previousSkill->getPureName());

        // place les valeurs sauvegradées de skill dans previous skill
        $previousSkill->setName($dataSave['name']);
        $previousSkill->setLevel($dataSave['level']);
        $previousSkill->setImg($dataSave['img']);
        $previousSkill->setBgColor($dataSave['bgColor']);
        $previousSkill->setPureName($dataSave['pureName']);

        //enregistrement des deux nouveaux contenus
        $manager = $doctrine->getManager();
        $manager->persist($skill);
        $manager->persist($previousSkill);

        //dd($skill, $previousSkill, $nps, $ns);
  
        //flushing as usual
        $em->flush();
        //adding success message
        $this->addFlash('success', 'La compétence à été déplacée vers le haut');
        //redirecting
        return $this->redirectToRoute('app_skills');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/movedown/{id}', name: 'app_skill_move_udown')]
    public function workMoveDown(ManagerRegistry $doctrine, EntityManagerInterface $em, $id): response
    {
        //get repo
        $repository = $doctrine->getRepository(Skill::class);
        // get skill update
        $skill = $repository->find($id);
        $nextSkill = $repository->find($id + 1);
        //sauvegarde des données de $skill dans un tableau associatif
        $dataSave = [
            'name' => $skill->getName(),
            'level' => $skill->getLevel(),
            'img' => $skill->getImg(),
            'bgColor' => $skill->getBgColor(),
            'pureName' => $skill->getPureName()
        ];
        
        //descend les valeurs de previousSkill dans skill
        $skill->setName($nextSkill->getName());
        $skill->setLevel($nextSkill->getLevel());
        $skill->setImg($nextSkill->getImg());
        $skill->setBgColor($nextSkill->getBgColor());
        $skill->setPureName($nextSkill->getPureName());

        // place les valeurs sauvegradées de skill dans previous skill
        $nextSkill->setName($dataSave['name']);
        $nextSkill->setLevel($dataSave['level']);
        $nextSkill->setImg($dataSave['img']);
        $nextSkill->setBgColor($dataSave['bgColor']);
        $nextSkill->setPureName($dataSave['pureName']);

        //enregistrement des deux nouveaux contenus
        $manager = $doctrine->getManager();
        $manager->persist($skill);
        $manager->persist($nextSkill);
        
        //dd($skill, $previousSkill, $nps, $ns);
  
        //flushing as usual
        $em->flush();
        //adding success message
        $this->addFlash('success', 'La compétence à été déplacée vers le bas');
        //redirecting
        return $this->redirectToRoute('app_skills');
    }

}
