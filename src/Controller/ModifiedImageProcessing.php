<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 25/11/2019
 * Time: 20:49
 */

namespace App\Controller;

use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModifiedImageProcessing extends AbstractController
{
    /**
     * @param Request $request
     * @Route( "/modifiedImageProcessing", name="app_modified_image_processing")
     */
    public function modifiedImageProcessing(Request $request, EntityManagerInterface $em)
    {
        if ( $request->isXmlHttpRequest()) {

            //recuperation des variables utiles et le code binaire de l'image.
            $name = $request->get('name');
            $src = $request->get('src');
            $path = "img/imgPost/";
            $voirSrc = str_replace(' ', '+', $src);

            //traitement des données en base 64
            $image_parts = explode(";base64,", $voirSrc);
            $imgCreate = base64_decode($image_parts[1]);

            $nameFile = uniqid();
            $file = $path . $nameFile . '.jpeg';

            //enregistrement dans le dossier imgPost
            file_put_contents($file, $imgCreate);

            //enregistrement dans la base de données
            var_dump($name);
            if (file_exists($file)) {

                $picture = $em->getRepository(Picture::class)
                    ->find($name);

                //suppression de la photo dans le dossier imgPost
                unlink($path. $picture->getName().'.'.$picture->getExtension());

                $picture->setName($nameFile);
                $picture->setExtension('jpeg');
                $picture->setDescription('photo_'.$nameFile);
                $em->flush();

                return new Response('picture traité!!', 200);
            }

            return new Response('sa a fonctionné mais pas traite', 200);
        }
        return new Response("sa ne focntionne pas", 400);

    }

}