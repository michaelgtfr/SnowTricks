<?php
/**
 * User: michaelgtfr
 */

namespace App\Service;

class CaptchaProtection
{
    private $cleSecurityBackEnd;
    private $responseCaptcha;
    private $IpUser;

    /**
     * @param $responseCaptcha
     * @param $IpUser
     * @param $cleSecurityBackEnd
     */
    public function __construct($responseCaptcha, $IpUser, $cleSecurityBackEnd)
    {
        $this->responseCaptcha = $responseCaptcha;
        $this->IpUser = $IpUser;
        $this->cleSecurityBackEnd = $cleSecurityBackEnd;
    }

    /**
     * protection against brute force attacks
     * @return bool
     */
    public function serviceCaptcha()
    {
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $this->cleSecurityBackEnd
            . "&response=" . $this->responseCaptcha
            . "&remoteip=" . $this->IpUser ;

        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == true) {
            return true;
        }
        return false;
    }
}
