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

    public function addPicture(
        Request $request,
        EntityManagerInterface $entityManager,
        PictureRepository $pictureRepository
    ): Response {
        $image = $pictureRepository->findAll();

        $picture = new Picture();

        $pictureForm = $this
            ->createForm(PictureType::class, $picture)
            ->remove('source')
            ->remove('update_at')
            ->add('send', SubmitType::class)
        ;
        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            $picture->setUpdateAt(new \DateTime());
            //$picture->setCategory($category);
            $entityManager->persist($picture);
            $entityManager->flush();
        }

        return $this->render('pictures/form.html.twig', [
            'images' => $image,
            'pictureForm' => $pictureForm->createView(),
        ]);
    }
}
