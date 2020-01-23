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
use App\Service\SecurityBreachProtection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteArticleController extends AbstractController
{
    /**
     * Deletion of the article requested by an editor.
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SecurityBreachProtection $protect
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/deleteArticle", name="app_delete_article")
     */
    public function deleteArticle(Request $request, EntityManagerInterface $em, SecurityBreachProtection $protect)
    {
        // Check the GET 'id'
        $id = $protect->textProtect($request->get('id'));

        // Delete the article
        $item = $em->getRepository(Item::class)
            ->find($id);
        $em->remove($item);
        $em->flush();

        // Recovery to verify the effective deletion of the user
        $checkDeleteItem = $em->getRepository(Item::class)
            ->find($id);

        if ($checkDeleteItem == null) {
            // Delete all the elements of the article to be deleted
            $picture = $em->getRepository(Picture::class)
                ->findBy(['article' => $id]);

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
                ->findBy(['article' => $id]);

            foreach ($movie as $value) {
                $deleteMovie = $em->getRepository(Movie::class)
                    ->find($value->getId());
                $em->remove($deleteMovie);
                $em->flush();
            }
            $comment = $em->getRepository(Comment::class)
                ->findBy(['article'=> $id]);

            foreach ($comment as $value) {
                $deleteComment = $em->getRepository(Comment::class)
                    ->find($value->getId());
                $em->remove($deleteComment);
                $em->flush();
            }
            $this->addFlash(
                'success',
                'Votre article à été supprimer!!'
            );
            return $this->redirectToRoute('app_homepage');
        }
        $this->addFlash(
            'error',
            'Désolé, nous n\'avons pas pu supprimer l\'article'
        );
        return $this->redirectToRoute('app_detail', [
            'id' => $id
        ]);
    }
}
