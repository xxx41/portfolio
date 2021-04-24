<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

class Helper
{
    public function __construct() {}

    static function getDecodedContent(Request $request)
    {
        return json_decode($request->getContent(), true);
    }
}