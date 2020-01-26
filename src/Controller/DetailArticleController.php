<?php
/**
 * User: michaelgtfr
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Item;
use App\Form\CommentForm;
use App\Service\SecurityBreachProtection;
use App\TreatmentForm\CommentDetailArticleTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DetailArticleController extends AbstractController
{
    /**
     * Display of the details of an article and a form for comments
     * @Route("/detail/{id}", name="app_detail")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Security $security
     * @param SecurityBreachProtection $protect
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function detailArticle(Request $request, EntityManagerInterface $em,
                                  Security $security, SecurityBreachProtection $protect)
    {
        //Check the GET 'id'
        $id = $protect->textProtect($request->get('id'));

        $item = $em->getRepository(Item::class)
                    ->find($id);

        //form of comment in the detail of article
        $objectComment = new Comment();
        $form = $this->createForm(CommentForm::class, $objectComment );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // data processing
            $treatment = (new CommentDetailArticleTreatment())
                ->treatment($item, $form, $security, $em);

            if ($treatment == true) {
                $this ->addFlash( 'success' , 'votre commentaire à été enregistré !');
            } else {
                $this ->addFlash(
                    'error' ,
                    'Désolé, votre commentaire n\' pas été pris en compte veuillez réessayer ultérieurement.'
                );
            }
        }

        $pictures = $item->getPictures();
        if(!$pictures[0]) {
            $pictures = null;
        }

        $movies = $item->getMovies();

        $comments = $em->getRepository(Comment::class)
                    ->commentArticle($request->get('id'), 0);

        $numberItems = $em->getRepository(Comment::class)
                    ->countCommentArticle($request->get('id'));

        return $this->render('article/detailArticle.html.twig', [
            'item' => $item,
            'pictures' => $pictures,
            'movies' => $movies,
            'comments' => $comments,
            'numberItems' => $numberItems,
            'form' => $form->createView(),
        ]);
    }
}
