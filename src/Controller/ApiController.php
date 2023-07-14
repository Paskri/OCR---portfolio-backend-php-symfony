<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Entity\Work;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/skills', name: 'app_get_skills')]
    public function getSkills(ManagerRegistry $doctrine): Response
    {   
        $repository = $doctrine->getRepository(Skill::class);
        $skills = $repository->findAll();
        $response = $this->json($skills);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        $response->headers->set('Access-Control-Allow-Headers', 'access-control-allow-private-network');

        return $response;
    }
    #[Route('/works', name: 'app_get_works')]
    public function getWorks(ManagerRegistry $doctrine): Response
    {   $repository = $doctrine->getRepository(Work::class);
        $works = $repository->findAll();
        $response = $this->json($works);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        $response->headers->set('Access-Control-Allow-Headers', 'access-control-allow-private-network');

        return $response;
    }
}
