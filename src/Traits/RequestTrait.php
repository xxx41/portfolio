<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Request;

trait RequestTrait
{
    protected function getContent(Request $request)
    {
        return json_decode($request->getContent(), true);
    }

    protected function getAllParams(Request $request)
    {
        return $request->query->all();
    }

    protected function getParam(Request $request, $param)
    {
        return $request->query->get($param);
    }
}