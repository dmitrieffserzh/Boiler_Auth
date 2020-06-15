<?php

/*
|--------------------------------------------------------------------------
| MODULES
|--------------------------------------------------------------------------
*/

/* TNParse */
Route::get('/modules/TNParse',     'Modules\TNParseController@index')->name('modules.TNParse.index');
Route::post('/modules/TNParse',    'Modules\TNParseController@upload')->name('modules.TNParse.upload');