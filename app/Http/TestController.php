<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;

class TestController
{
    public function test(Request $request)
    {
        dd($request);
    }   
}
