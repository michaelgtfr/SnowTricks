<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Item;
use App\Form\CommentForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class DetailArticleController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/detail/{id}", name="app_detail")
     */
    public function detailArticle(Request $request, EntityManagerInterface $em, Security $security)
    {
        $item = $em->getRepository(Item::class)
                    ->find($request->get('id'));

        //form of comment in the detail of article
        $objectComment = new Comment();
        $form = $this->createForm(CommentForm::class, $objectComment );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $data->setDateCreate(new \DateTime());
            $security->getUser()->addComment($data);
            $item->addComment($data);

            $em->persist($data);
            $em->flush();

            $this ->addFlash( 'success' , 'votre commentaire à été enregistré !');
        }

        $pictures = $item->getPictures();

        $movies = $item->getMovies();

        $comments = $em->getRepository(Comment::class)
                    ->commentArticle($request->get('id'), 0);

        $numberItems = $em->getRepository(Comment::class)
                    ->countCommentArticle($request->get('id'));

        return $this->render('detailArticle/detailArticle.html.twig', [
            'item' => $item,
            'pictures' => $pictures,
            'movies' => $movies,
            'comments' => $comments,
            'numberItems' => $numberItems,
            'form' => $form->createView(),
        ]);
    }
}
