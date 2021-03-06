<?php
/**
 * User: michaelgtfr
 * Date: 04/12/2019
 * Time: 06:34
 */

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeletedMovie
{
    /**
     * Removal of a video link via an asynchronous ajax way
     * @Route("/deleteMovie", name="app_deleted_movie")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function deletedMovie(Request $request, EntityManagerInterface $em)
    {
        $movie = $em->getRepository(Movie::class)
            ->find($request->get('name'));
        $em->remove($movie);
        $em->flush();

        return new Response('La vidéo à ètè supprimé', 200);
    }
}
