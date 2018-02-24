<?php

use Backbone\Services\DB;
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

Route::get('/db', function() {
    return var_dump(DB::table('test')->delete());
});

Route::get('/', function() {
    return strval(phpinfo());
});

Route::get('/param/{param}', function ($request) {
    return $request->attr('param');
});
