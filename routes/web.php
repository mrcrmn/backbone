<?php

use Backbone\Http\Response;
use Backbone\Services\Route;

/*
 | --------------------------------------------------------------------------------
 | Add Routes here.
 | --------------------------------------------------------------------------------
 |
 | You can register your routes here, simply use the wanted HTTP verb as the
 | method on the route Service. Alternatively you may also use the view
 | method to return a simple view instead of going through some
 | complicated controller logic.
 |
 */

Route::get('/redirect', function () {
    return redirect('/');
});

Route::view('/', 'example');

Route::get('/param/{param}', function ($request) {
    return $request->attributes->get('param');
});
