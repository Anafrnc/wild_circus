<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
