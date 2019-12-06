<?php

namespace App\Controller;


use App\Entity\Item;
use App\Entity\Movie;
use App\Entity\Picture;
use App\Form\ModifyArticleForm;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ModifyArticleController extends AbstractController
{
    /**
     * @Route("/modifyArticle/{$id}", name="app_modify")
     */
    public function modifyArticle(Request $request, EntityManagerInterface $em)
    {
        //recupérer tout les éléments de l'article
        $item = $em->getRepository(Item::class)
            ->find($request->get('id'));

        $pictures = $item->getPictures();

        $movies = $item->getMovies();


        //creation du formulaire
        $form = $this->createForm(ModifyArticleForm::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            //recovery of different data
            $data = $form->getData();
            $files = $form->get('files')->getData();
            $movies = $form->get('movies')->getData();

            //creation of the new name and its transfer for pictures
            foreach ($files as &$value) {
                $namePictures = new ProcessingFiles();
                $value = $namePictures->processingFiles($value, $value->guessExtension(), 'imgPost');
            }

            //inserting user in the Item entity
            $item->setUser($this->getUser());

            //inserting photos in the Item entity
            foreach ($files as &$value) {
                $picture = new Picture();
                $nameElement = pathinfo($value);
                $picture->setName(strval($nameElement['filename']));
                $picture->setExtension(strval($nameElement['extension']));
                $picture->setDescription('photo_'.$nameElement['filename']);
                $item->addPicture($picture);
            }

            //inserting movie in the Item entity
            foreach ($movies as &$value) {
                $movieEntity = new Movie();
                $movieEntity->setLink($value);
                $item->addMovie($movieEntity);
            }

            $item->setDateCreate( new \DateTime());

            $em->flush();

            $message = 'Félicitation votre article à été modifié vous pouvez dès a présent le voir!';

            return $this ->redirectToRoute( 'app_homepage', ['message' => $message] );
        }

        return $this->render('modifyArticle.html.twig', [
            'form' => $form->createView(),
            'pictures' => $pictures,
            'movies' => $movies,
            'idItem' => $request->get('id')
        ]);
    }
}
