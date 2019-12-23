<?php
/**
 * User: michaelgtfr
 */

namespace App\Service;

use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ProcessingFiles
 * @package App\Service
 */
class ProcessingFiles
{
    /**
     * Move the image to the img Avatar folder and change its name, protection against the fault UPLOAD, part 2/2
     * @param $linkFile
     * @param $extensionFile
     * @param $folder
     * @return string
     */
    public function processingFiles($linkFile, $extensionFile, $folder)
    {
        //creation of the new name
        $datePicture = date('Y_m_d_H_i_s');
        $idUnique = uniqid();
        $namePhoto = "{$datePicture}-{$idUnique}.{$extensionFile}";

        //transfer
        $transferFile ="img\\$folder\\$namePhoto";
        move_uploaded_file($linkFile, $transferFile);

        return $namePhoto;
    }

    /**
     * Delete the file in the img folder and the bdd
     * @param $folder
     * @param $name
     * @param $extension
     * @param $id
     * @param EntityManagerInterface $em
     */
    public function deletePicture($folder , $name, $extension, $id, EntityManagerInterface $em)
    {
        unlink('img/'.$folder.'/'.$name.'.'.$extension);

        $deletePicture = $em->getRepository(Picture::class)
            ->find($id);
        $em->remove($deletePicture);
        $em->flush();
    }
}
