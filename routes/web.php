<?php

use Backbone\Facades\Route;
use Symfony\Component\HttpFoundation\RedirectResponse as Redirect;

/*
 | --------------------------------------------------------------------------------
 | Add Routes here.
 | --------------------------------------------------------------------------------
 |
 | You can register your routes here, simply use the wanted HTTP verb as the
 | method on the route facade. Alternatively you may also use the view
 | method to return a simple view instead of going through some
 | complicated controller logic.
 |
 */

Route::get('/redirect', function() {
    return new Redirect('/');
});

Route::get('/', function($request) {
    return view('example');
});
