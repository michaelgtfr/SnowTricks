<?php
/**
 * User: michaelgtfr
 * Date: 06/11/2019
 * Time: 19:04
 */

namespace App\Controller;

use App\Entity\Item;
use App\Form\CreateArticleForm;
use App\TreatmentForm\CreateArticleTreatment;
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

class CreateArticleController
{
    /**
     * @Route("/profile/createArticle", name="app_createArticle")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param Security $security
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function createArticle(Request $request, EntityManagerInterface $em,
                                  Session $session, UrlGeneratorInterface $generator, Environment $twig,
                                  FormFactoryInterface $formFactory, Security $security)
    {
        $item = new Item;
        $form = $formFactory->create(CreateArticleForm::class, $item);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // data processing
            $treatment = (new CreateArticleTreatment())
                ->treatment($security->getUser(), $item, $em);

            if ($treatment == true) {
                $session->getFlashBag()->add(
                    'success',
                    'Félicitation votre article à été créer vous pouvez dès a présent le voir!'
                );
                $router = $generator->generate('app_homepage');
                return new RedirectResponse($router, 302);
            }

            $session->getFlashBag()->add(
                'error',
                'Désoler une erreur est survenue, veuillez réessayer ou envoyer un message à l\'administrateur!'
            );
            $router = $generator->generate('app_homepage');
            return new RedirectResponse($router, 302);
        }
        $render = $twig->render('article/createArticle.html.twig', [
            'form' => $form->createView(),
        ]);
        return new Response($render);
    }
}
