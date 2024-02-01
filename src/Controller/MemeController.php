<?php

namespace App\Controller;

use App\Entity\Meme;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
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

    #[Route('/meme/{id}', name: 'app_meme_show', requirements: ['id' => '\d+'])]
    public function show(#[MapEntity(expr: 'repository.findWithId(id)')] meme $meme): Response
    {
        return $this->render('meme/show.html.twig', ['meme' => $meme]);
    }
}
