<?php
/**
 * User: michaelgtfr
 * Date: 03/12/2019
 * Time: 20:58
 */

namespace App\Controller;

use App\Entity\Picture;
use App\Service\ProcessingFiles;
use App\Service\SecurityBreachProtection;
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
     * @param SecurityBreachProtection $protect
     * @return Response
     */
    public function deletedPicture(Request $request, EntityManagerInterface $em, SecurityBreachProtection $protect)
    {
        // Check GET 'name'
        $name = $protect->textProtect($request->get('name'));

        // recover the object and delete it
        $picture = $em->getRepository(Picture::class)
            ->find($name);

        (new ProcessingFiles())->deletePicture(
            'imgPost',
            $picture->getName(),
            $picture->getExtension(),
            $picture->getId(),
            $em
        );

        // Recovery to verify the effective deletion of the user
        $checkDeletePicture = $em->getRepository(Picture::class)
            ->find($name);

        if ($checkDeletePicture == null) {
            return new Response('La photo à été supprimer', 200);
        }
        return new Response('Désolé mais un problème à eu lieu veuillez réessayer ultérieurement!!', 500);
    }
}
