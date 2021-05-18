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

Route::get('/', 'BlogController@index', function () {

})->name('blog');

Route::get('/add-post-page', function () {
    return view('addPostPage');
})->name('post.addPostPage');

Route::post('/addpost', 'BlogController@addPost', function () {

})->name('post.addPost');

Route::get('/edit-post/{id}', 'BlogController@editPost', function ($id) {

})->name('post.editPost');


Route::get('/post/{id}', 'BlogController@getPost', function ($id) {

})->name('post.getPost');

Route::get('/remove-post/{id}', 'BlogController@removePost', function ($id) {

})->name('post.removePost');

Route::post('/save-edit-post/', 'BlogController@saveEditedPost', function ($id) {

})->name('post.saveEditedPost');


