<?php
/**
 * User: michaelgtfr
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Item;
use App\Entity\Movie;
use App\Entity\Picture;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DeleteArticleController
{
    /**
     * Deletion of the article requested by an editor.
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UrlGeneratorInterface $generator
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/deleteArticle", name="app_delete_article")
     */
    public function deleteArticle(Request $request, EntityManagerInterface $em, UrlGeneratorInterface $generator,
                                  Session $session)
    {
        // Delete the article
        $item = $em->getRepository(Item::class)
            ->find($request->get('id'));

        if ($item->getId() == null) {
            $session->getFlashBag()->add(
                'error',
                'Désolé, nous n\'avons pas pu supprimer l\'article'
            );
            $router = $generator->generate('app_detail', ['id' => $request->get('id')] );
            return new RedirectResponse($router, 302);
        }
        $em->remove($item);
        $em->flush();

        // Delete all the elements of the article to be deleted
        $picture = $em->getRepository(Picture::class)
            ->findBy(['article' => $request->get('id')]);

        foreach ($picture as $value) {
            (new ProcessingFiles())->deletePicture(
                'imgPost',
                $value->getName(),
                $value->getExtension(),
                $value->getId(),
                $em
            );
        }
        $movie = $em->getRepository(Movie::class)
            ->findBy(['article' => $request->get('id')]);

        foreach ($movie as $value) {
            $deleteMovie = $em->getRepository(Movie::class)
                ->find($value->getId());
            $em->remove($deleteMovie);
            $em->flush();
        }
        $comment = $em->getRepository(Comment::class)
            ->findBy(['article'=> $request->get('id')]);

        foreach ($comment as $value) {
            $deleteComment = $em->getRepository(Comment::class)
                ->find($value->getId());
            $em->remove($deleteComment);
            $em->flush();
        }
        $session->getFlashBag()->add(
            'success',
            'Votre article à été supprimer!!'
        );
        $router = $generator->generate('app_homepage');
        return new RedirectResponse($router, 302);
    }
}
