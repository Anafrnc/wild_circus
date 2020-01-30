<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pictures", name="pictures_")
 */
class PicturesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('pictures/index.html.twig', [
            'controller_name' => 'PicturesController',
        ]);
    }
}
