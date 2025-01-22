<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/scripts/statistique_crypto')]
final class indexController extends AbstractController{
    #[Route('/index', name: 'app_scripts_statistique_crypto_index')]
    public function index(): Response
    {

        return $this->render('scripts/statistique_crypto/index/index.html.twig', [
            'controller_name' => 'indexController',
        ]);
    }
}
