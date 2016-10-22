<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/







Route::resource('applications', 'ApplicationAPIController');

Route::resource('tables', 'TableAPIController');

Route::resource('columns', 'ColumnAPIController');