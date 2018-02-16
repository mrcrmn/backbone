<?php

namespace App\Http;

use Backbone\Facades\View;
use Symfony\Component\HttpFoundation\Request;

class ExampleController extends Controller
{
    public function example(Request $request)
    {
        return View::render('example', ['example' => 'test']);
    }
}
