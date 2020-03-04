<?php
/**
 * User: michaelgtfr
 * Date: 20/12/2019
 * Time: 14:01
 */

namespace App\TreatmentForm;

use App\Entity\Item;
use App\Entity\Movie;
use App\Entity\Picture;
use App\Entity\User;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ModifyArticleTreatment
{
    /**
     * Processing of the article modification section form
     * @param User $user
     * @param Item $item
     * @param EntityManagerInterface $em
     * @return bool
     * @throws \Exception
     */
    public function treatment(User $user, Item $item, EntityManagerInterface $em)
    {
        /**
         * @var UploadedFile $value
         */
        //Creation of the new name and its transfer for pictures and Inserting photos in the Item entity
        foreach ($item->getUploadFile() as &$value) {
            $namePictures = new ProcessingFiles();

            $nameChangedPicture = $namePictures->processingFiles($value, $value->guessExtension(), 'imgPost');

            $picture = new Picture();
            $nameElement = pathinfo($nameChangedPicture);
            $picture->setName(strval($nameElement['filename']));
            $picture->setExtension(strval($nameElement['extension']));
            $picture->setDescription('photo_'.$nameElement['filename']);
            $item->addPicture($picture);
        }
        //Inserting user in the Item entity
        $item->setUser($user);

        //Inserting movie in the Item entity
        if ($item->getLinkUploaded() != null) {
            foreach ($item->getLinkUploaded() as &$value) {
                $movieEntity = new Movie();
                $value = str_replace('watch?v=', 'embed/', $value);
                $movieEntity->setLink($value);
                $item->addMovie($movieEntity);
            }
        }

        $item->setDateCreate( new \DateTime());
        $em->flush();

        return true;
    }
}
