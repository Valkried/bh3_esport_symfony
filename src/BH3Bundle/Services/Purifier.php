<?php

namespace BH3Bundle\Services;

use \HTMLPurifier;

class Purifier
{
    public function purify($dirty_html)
    {
        $purifier = new HTMLPurifier();
        return $purifier->purify($dirty_html);
    }
}
