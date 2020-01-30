<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PicturesController extends AbstractController
{
    /**
     * @Route("/pictures", name="pictures")
     */
    public function index()
    {
        return $this->render('pictures/index.html.twig', [
            'controller_name' => 'PicturesController',
        ]);
    }
}
