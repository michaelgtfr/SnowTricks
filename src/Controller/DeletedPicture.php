<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/12/2019
 * Time: 20:58
 */

namespace App\Controller;


use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeletedPicture extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @Route("/deletedPicture", name="app_deleted_picture")
     */
    public function deletedPicture(Request $request, EntityManagerInterface $em)
    {
        $name = $request->get('name');

        $picture = $em->getRepository(Picture::class)
            ->find($name);
        $em->remove($picture);
        $em->flush($picture);

        // Récupération pour vérifier la suppression effective de l'utilisateur
        $verifDeletePicture = $em->getRepository(Picture::class)
            ->find($name);

        if ($verifDeletePicture == null) {
            return new Response('picture traité', 200);
        }
        return new Response('picture non traité!!', 200);

    }
}
