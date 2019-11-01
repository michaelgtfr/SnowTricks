<?php

namespace App\Service;

/**
 * Move the image to the img Avatar folder and change its name
 *
 * Class ProcessingFiles
 * @package App\Service
 */
class ProcessingFiles
{
    public function processingFiles($linkFile, $extensionFile)
    {
        $datePicture = date('Y_m_d_H_i_s');
        $namePhoto = "{$datePicture}.{$extensionFile}";
        $transfertFile ="img\imgAvatar\\$namePhoto";
        move_uploaded_file($linkFile, $transfertFile);

        return $namePhoto;
    }

}