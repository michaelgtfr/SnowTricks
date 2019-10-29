<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Item;
use App\Form\CommentForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DetailArticleController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/detail/{id}", name="app_detail")
     */
    public function detailArticle(Request $request, EntityManagerInterface $em )
    {
        $item = $em->getRepository(Item::class)
                    ->find($request->get('id'));

        $pictures = $item->getPictures();

        $movies = $item->getMovies();

        $comments = $em->getRepository(Comment::class)
                    ->commentArticle($request->get('id'));

        $objectComment = new Comment();
        $form = $this->createForm(CommentForm::class, $objectComment );

        return $this->render('detailArticle/detailArticle.html.twig', [
            'item' => $item,
            'pictures' => $pictures,
            'movies' => $movies,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }
}