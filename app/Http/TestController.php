<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;

class TestController
{
    public function test(Request $request)
    {
        return $request->attributes->get('test');
    }   
}
