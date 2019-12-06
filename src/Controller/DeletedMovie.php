<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/12/2019
 * Time: 06:34
 */

namespace App\Controller;


use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeletedMovie extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @Route("/deleteMovie", name="app_deleted_movie")
     */
    public function deletedMovie(Request $request, EntityManagerInterface $em)
    {
        $name = $request->get('name');

        $movie = $em->getRepository(Movie::class)
            ->find($name);

        $em->remove($movie);
        $em->flush($movie);

        // Récupération pour vérifier la suppression effective de l'utilisateur
        $verifDeleteMovie = $em->getRepository(Movie::class)
            ->find($name);

        if ($verifDeleteMovie == null) {
            return new Response('picture traité', 200);
        }
        return new Response('picture non traité!!', 200);
    }
}