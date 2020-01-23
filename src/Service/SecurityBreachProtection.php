<?php
/**
 * User: michaelgtfr
 * Date: 16/12/2019
 * Time: 19:55
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class SecurityBreachProtection
{
    /**
     * Protection against the faults XSS and CRLF
     * @param $emailCheck
     * @return mixed
     */
    public function emailProtect($emailCheck)
    {
        $emailCheck = str_replace(array("\n","\r",PHP_EOL),'',$emailCheck);
        return $email = filter_var($emailCheck,FILTER_VALIDATE_EMAIL);
    }

    /**
     * Protection against the faults XSS
     * @param $textCheck
     * @return mixed
     */
    public function textProtect($textCheck)
    {
        return $text = filter_var($textCheck, FILTER_SANITIZE_STRING);
    }

    /**
     * Protection against the faults XSS
     * @param $urlCheck
     * @return mixed
     */
    public function urlProtect($urlCheck)
    {
        foreach ($urlCheck as &$value) {
            $value = filter_var($value, FILTER_VALIDATE_URL);
            if($value == false) {
                return false;
            }
        }
            return $urlCheck;
    }

    /**
     * Protection against the fault UPLOAD, part 1/2 (ProcessingFile)
     * @param $fileCheck
     * @return bool
     */
    public function fileProtect($fileCheck)
    {
        foreach ($fileCheck as &$value) {
            $extensionAllowed = array('jpg', 'jpeg', 'png');

            /** @var UploadedFile $value */
            $extensionUpload = $value->guessExtension();

            if (!in_array($extensionUpload, $extensionAllowed)) {
                return false;
            }
        }
        return $fileCheck;
    }
}
