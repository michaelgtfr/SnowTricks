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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateArticleController extends AbstractController
{
    /**
     * @Route("/profile/createArticle", name="app_createArticle")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createArticle(Request $request, EntityManagerInterface $em)
    {
        $item = new Item;
        $form = $this->createForm(CreateArticleForm::class, $item);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // data processing
            $treatment = (new CreateArticleTreatment())
                ->treatment($this->getUser(), $item, $em);

            if ($treatment == true) {
                $this->addFlash(
                    'success',
                    'Félicitation votre article à été créer vous pouvez dès a présent le voir!'
                );
                return $this ->redirectToRoute( 'app_homepage');
            }

            $this->addFlash(
                'error',
                'Désoler une erreur est survenue, veuillez réessayer ou envoyer un message à l\'administrateur!'
            );
            return $this ->redirectToRoute( 'app_homepage');
        }
        return $this->render('article/createArticle.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
