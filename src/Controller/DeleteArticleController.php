<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Item;
use App\Entity\Movie;
use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DeleteArticleController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/deleteArticle/{$id}", name="app_delete_article")
     */

    public function deleteArticle(Request $request, EntityManagerInterface $em)
    {
        $id = $request->get('id');

        //suppression de tout les éléments de l'article à supprimer
        $item = $em->getRepository(Item::class)
            ->find($id);
        $em->remove($item);
        $em->flush($item);


        // Récupération pour vérifier la suppression effective de l'utilisateur
        $verifDeleteItem = $em->getRepository(Item::class)
            ->find($id);

        if ($verifDeleteItem == null) {

            $picture = $em->getRepository(Picture::class)
                ->findBy(['article' => $id]);

            foreach ($picture as $value) {
                $deletePicture = $em->getRepository(Picture::class)
                    ->find($value->getId());
                $em->remove($deletePicture);
                $em->flush($deletePicture);
            }

            $movie = $em->getRepository(Movie::class)
                ->findBy(['article' => $id]);

            foreach ($movie as $value) {
                $deleteMovie = $em->getRepository(Movie::class)
                    ->find($value->getId());
                $em->remove($deleteMovie);
                $em->flush($deleteMovie);
            }

            $comment = $em->getRepository(Comment::class)
                ->findBy(['article'=> $id]);

            foreach ($comment as $value) {
                $deleteComment = $em->getRepository(Comment::class)
                    ->find($value->getId());
                $em->remove($deleteComment);
                $em->flush($deleteComment);
            }

            $message = "Votre article a été supprime!!";

            return $this->redirectToRoute('app_homepage', [
                'message' => $message
            ]);
        }

        $message = "Désolé, nous n'avons pas pu supprimer l'article";

        return $this->redirectToRoute('app_detail', [
            'message' => $message,
            'id' => $id
        ]);

    }
}