<?php

Route::group(['prefix' => 'blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
	Route::get('/', ['as'=>'blog.index','uses'=>'BlogController@index']);
	Route::get('contato',['as'=>'blog.contact','uses'=>'BlogController@contact']);
	Route::post('contato',['as'=>'blog.post_contact','uses'=>'BlogController@post_contact']);
	Route::get('sobre', ['as'=>'blog.about','uses'=>'BlogController@about']);
	Route::get('post', ['as'=>'blog.post','uses'=>'BlogController@post']);
});