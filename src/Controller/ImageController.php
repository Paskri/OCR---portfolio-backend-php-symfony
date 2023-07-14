<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/api/images')]
class ImageController extends AbstractController
{
    #[Route('/skills/{image}', name: 'app_get_skill_image')]
    public function getSkills(string $image): Response
    {   

        $filePath = realpath($this->getParameter('kernel.project_dir') . '/public/assets/images/skills/' . $image);

        $response = new BinaryFileResponse($filePath);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        $response->headers->set('Access-Control-Allow-Headers', 'access-control-allow-private-network');

        return $response;
    }
}
