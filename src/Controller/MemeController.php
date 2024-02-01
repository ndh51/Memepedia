<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemeController extends AbstractController
{
    #[Route('/meme', name: 'app_meme')]
    public function index(): Response
    {
        return $this->render('meme/index.html.twig', [
            'controller_name' => 'MemeController',
        ]);
    }
}
