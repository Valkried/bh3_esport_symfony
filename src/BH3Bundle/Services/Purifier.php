<?php

namespace BH3Bundle\Services;

use \HTMLPurifier;
use \HTMLPurifier_Config;

class Purifier
{
    public function purify($dirty_html)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'em,strong,h4,a[href],img[src]');
        
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($dirty_html);
    }
}
