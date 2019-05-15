<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::any('/practice/{n?}', 'PracticeController@index');

// home page
Route::view('/','welcome');

// generating study reports
Route::get('/report/{type}', 'StudyController@list');
Route::get('/studies/show/{id}', 'StudyController@show');

// creating studies
Route::get('/create/study', 'StudyController@create');
Route::post('/study/addToDB', 'StudyController@addToDB');

// creating participants
Route::get('/create/participant', 'ParticipantController@create');
Route::post('/participant/addToDB', 'ParticipantController@addToDB');

// editing studies
Route::get('/edit/study', 'StudyController@findToEdit');
Route::get('/edit/study/{id}', 'StudyController@edit');
Route::post('/study/updateInDB/{id}', 'StudyController@updateInDB');

// editing participants
Route::get('/find/participant/{req_type?}', 'ParticipantController@findToEdit');
Route::get('/edit/participant/{id?}', 'ParticipantController@getInfo');
Route::get('/participant/search/{req_type}', 'ParticipantController@search');
// Route::get('/find/participant/{id?}', 'ParticipantController@findToEdit');
Route::post('/participant/updateInDB/{id}', 'ParticipantController@updateInDB');

// editing connections between participants and studies
Route::get('/connect/participant/{id?}', 'ParticipantController@connectSingle');
Route::post('/connection/saveConnection/{id?}', 'ParticipantController@saveConnection');

Route::get('/db-debug', function () {

    $debug = [
        'Environment' => App::environment(),
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});
