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

// practice routing
Route::any('/practice/{n?}', 'PracticeController@index');

// home page
Route::view('/','welcome');

// creation
Route::get('/add/study/render', 'StudyController@addForm');
Route::get('/add/participant/render', 'ParticipantController@addForm');
Route::post('/add/study/create', 'StudyController@addToDB');
Route::post('/add/participant/create', 'ParticipantController@addToDB');

// finding or listing db entities -- for editing or reports
Route::get('/find/study/list/{filter?}', 'StudyController@list');
Route::get('/find/participant/{edit_type}', 'ParticipantController@searchPage');
Route::get('find/searchEngine/{edit_type}', 'ParticipantController@searchEngine');

// render the editing forms
Route::get('/edit/study/{id}', 'StudyController@editForm');
Route::get('/edit/participant/{id}', 'ParticipantController@editForm');
Route::get('/edit/connection/{id}', 'ParticipantController@editForm');

// saving edits to database
Route::post('/update/study/{id}', 'StudyController@updateInDB');
Route::post('/update/participant/{id}', 'ParticipantController@updateInDB');
Route::post('/update/connection/{id}', 'ParticipantController@updateInDB');

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
