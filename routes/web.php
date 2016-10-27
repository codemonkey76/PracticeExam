<?php

Route::get('', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
// Route::get('/create', 'PagesController@create');
// Route::post('/create', 'PagesController@store');
// Route::get('/createQuestions', 'QuestionsController@createQuestions');
// Route::post('/createQuestions', 'QuestionsController@store');
Auth::routes();

//Route::get('home', 'HomeController@index');


/*
GET         /exam               @index
GET         /exam/create        @create
POST        /exam               @store
GET         /exam/{id}          @show
GET         /exam/{id}/edit     @edit
PUT/PATCH   /exam/{id}          @update
DELETE      /exam/{id}          @destroy
 */
Route::resource('exam', 'ExamsController');
Route::post('getQuestions', 'ExamsController@getQuestions');


/*
GET         /exam/{id}/question               @index
GET         /exam/{id}/question/create        @create
POST        /exam/{id}/question               @store
GET         /exam/{id}/question/{id}          @show
GET         /exam/{id}/question/{id}/edit     @edit
PUT/PATCH   /exam/{id}/question/{id}          @update
DELETE      /exam/{id}/question/{id}          @destroy
 */
Route::resource('/exam/{exam_id}/question', 'QuestionsController');
Route::post('exam/{exam_id}/getOptions', 'QuestionsController@getOptions');


/*
GET         /exam/{id}/question/{id}/option               @index
GET         /exam/{id}/question/{id}/option/create        @create
POST        /exam/{id}/question/{id}/option               @store
GET         /exam/{id}/question/{id}/option/{id}          @show
GET         /exam/{id}/question/{id}/option/{id}/edit     @edit
PUT/PATCH   /exam/{id}/question/{id}/option/{id}          @update
DELETE      /exam/{id}/question/{id}/option/{id}          @destroy
 */
Route::resource('exam/{exam_id}/question/{question_id}/option', 'OptionsController');

Route::get('/exam/{exam_id}/practice', 'ExamsController@practice');
Route::get('/exam/{exam_id}/model', 'ExamsController@model');
Route::post('/exam/{exam_id}/results', 'ExamsController@results');
Route::post('/exam/{exam_id}/answers', 'ExamsController@answers');

