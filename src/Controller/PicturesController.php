<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pictures", name="pictures_")
 */
class PicturesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(PictureRepository $pictureRepository): Response
    {
        $image = $pictureRepository->findAll();
        return $this->render('pictures/index.html.twig', [
            'images' => $image,
        ]);
    }
}
