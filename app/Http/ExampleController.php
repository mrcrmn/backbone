<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;

class ExampleController extends Controller
{
    public function example(Request $request)
    {
        return view('example', [
            'example' => 'hello world!'
        ]);
    }   
}