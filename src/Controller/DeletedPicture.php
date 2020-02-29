<?php
/**
 * User: michaelgtfr
 * Date: 03/12/2019
 * Time: 20:58
 */

namespace App\Controller;

use App\Entity\Picture;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeletedPicture extends AbstractController
{
    /**
     * Deleting an image asynchronously via jax
     * @Route("/deletedPicture", name="app_deleted_picture")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function deletedPicture(Request $request, EntityManagerInterface $em)
    {
        // recover the object and delete it
        $picture = $em->getRepository(Picture::class)
            ->find($request->get('name'));

        (new ProcessingFiles())->deletePicture(
            'imgPost',
            $picture->getName(),
            $picture->getExtension(),
            $picture->getId(),
            $em
        );

        return new Response('La photo à été supprimer', 200);
    }
}
