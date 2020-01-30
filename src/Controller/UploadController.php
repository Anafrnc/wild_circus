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
 * @Route("/upload", name="upload_")
 */
class UploadController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('upload/index.html.twig', [
        ]);
    }

    public function upload(
        Request $request,
        EntityManagerInterface $entityManager,
        PictureRepository $pictureRepository
    ): Response {
        $image = $pictureRepository->findAll();

        $picture = new Picture();

        $uploadForm = $this
            ->createForm(PictureType::class, $picture)
            ->remove('source')
            ->remove('update_at')
            ->add('send', SubmitType::class)
        ;
        $uploadForm->handleRequest($request);

        if ($uploadForm->isSubmitted() && $uploadForm->isValid()) {
            $picture->setUpdateAt(new \DateTime());
            //$picture->setCategory($category);
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('gallery_index');
        }

        return $this->render('upload/form.html.twig', [
            'uploadForm' => $uploadForm->createView(),
        ]);
    }

}
