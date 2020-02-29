<?php
/**
 * User: michaelgtfr
 */

namespace App\Controller;

use App\Entity\Item;
use App\Form\ModifyArticleForm;
use App\TreatmentForm\ModifyArticleTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ModifyArticleController extends AbstractController
{
    /**
     * modification of an article via a pre-filled form
     * @Route("/profile/modifyArticle", name="app_modify")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function modifyArticle(Request $request, EntityManagerInterface $em)
    {
        //Get all the elements of the article
        $item = $em->getRepository(Item::class)
            ->find(htmlspecialchars($request->get('id')));

        //Form creation
        $form = $this->createForm(ModifyArticleForm::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $treatment = (new ModifyArticleTreatment())->treatment($this->getUser(), $item, $em);

            if ($treatment == true) {
                $this->addFlash(
                    'success',
                    'Félicitation votre article à été modifié vous pouvez dès a présent le voir!'
                );
                return $this ->redirectToRoute( 'app_homepage');
            }
            $this->addFlash(
                'error',
                'Désoler, un problème à eu lieu veuillez réessayer votre modification !'
            );
        }

        return $this->render('article/modifyArticle.html.twig', [
            'form' => $form->createView(),
            'pictures' => $item->getPictures(),
            'movies' => $item->getMovies(),
            'idItem' => $item->getId()
        ]);
    }
}
