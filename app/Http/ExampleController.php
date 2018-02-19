<?php

namespace App\Http;

use Backbone\Services\View;
use Symfony\Component\HttpFoundation\Request;

class ExampleController extends Controller
{
    public function example(Request $request)
    {
        return View::render('example', ['example' => 'test']);
    }

    public function index(Request $request)
    {
        return View::render('example', ['example' => $request->attributes->get('test')]);
    }
}
