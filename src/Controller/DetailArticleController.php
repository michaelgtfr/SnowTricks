<?php
/**
 * User: michaelgtfr
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Item;
use App\Form\CommentForm;
use App\TreatmentForm\CommentDetailArticleTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class DetailArticleController
{
    /**
     * Display of the details of an article and a form for comments
     * @Route("/detail/{id}", name="app_detail")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Security $security
     * @param UrlGeneratorInterface $generator
     * @param Session $session
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function detailArticle(Request $request, EntityManagerInterface $em, Security $security,
                                  UrlGeneratorInterface $generator, Session $session, FormFactoryInterface $formFactory,
                                  Environment $twig)
    {
        $item = $em->getRepository(Item::class)
                    ->find($request->get('id'));

        if ($item === null) {
            $router = $generator->generate('app_homepage');
            return new RedirectResponse($router, 302);
        }

        //form of comment in the detail of article
        $objectComment = new Comment();
        $form = $formFactory->create(CommentForm::class, $objectComment );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // data processing
            $treatment = (new CommentDetailArticleTreatment())
                ->treatment($item, $form, $security, $em);

            if ($treatment == true) {
                $session->getFlashBag()->add( 'success' , 'votre commentaire à été enregistré !');
                $router = $generator->generate('app_detail', ['id' => $request->get('id')] );
                return new RedirectResponse($router, 302);
            } else {
                $session->getFlashBag()->add(
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

        $render = $twig->render('article/detailArticle.html.twig', [
            'item' => $item,
            'pictures' => $pictures,
            'movies' => $movies,
            'comments' => $comments,
            'numberItems' => $numberItems,
            'form' => $form->createView(),
        ]);
        return new Response($render);
    }
}
