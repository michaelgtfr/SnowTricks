<?php
/**
 * User: michaelgtfr
 * Date: 04/12/2019
 * Time: 06:34
 */

namespace App\Controller;

use App\Entity\Movie;
use App\Service\SecurityBreachProtection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeletedMovie extends AbstractController
{
    /**
     * Removal of a video link via an asynchronous ajax way
     * @Route("/deleteMovie", name="app_deleted_movie")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SecurityBreachProtection $protect
     * @return Response
     */
    public function deletedMovie(Request $request, EntityManagerInterface $em, SecurityBreachProtection $protect)
    {
        // Check the GET 'name'
        $name = $protect->textProtect($request->get('name'));

        $movie = $em->getRepository(Movie::class)
            ->find($name);
        $em->remove($movie);
        $em->flush();

        // Recovery to verify the effective deletion of the user
        $checkDeleteMovie = $em->getRepository(Movie::class)
            ->find($name);

        if ($checkDeleteMovie == null) {
            return new Response('', 200);
        }
        return new Response('Désolé mais un problème à eu lieu, veuillez réessayer ultérieurement', 500);
    }
}
