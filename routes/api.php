<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('upload', 'FileUploadController@uploadImages');

//company
Route::get('company', 'CompanyController@index');
Route::get('techs', 'TechController@index');
Route::post('contact', 'ContactController@store');
Route::get('posts', 'PostController@index');
Route::get('posts/{id}', 'PostController@show');
Route::get('latest-posts', 'PostController@latest');

Route::get('projects', 'ProjectController@index');
Route::get('projects/{id}', 'ProjectController@show');
Route::get('comments', 'CommentController@index');
Route::post('add-comment', 'CommentController@store');

/* Route::group(['middleware'=>['auth']],function(){ */
    //post routes
    Route::get('admin/post', 'admin\AdminPostController@index');
    Route::post('admin/post', 'admin\AdminPostController@store');
    Route::post('admin/post/update', 'admin\AdminPostController@update');
    Route::delete('admin/post/{id}', 'admin\AdminPostController@destroy');
    //project routes
    Route::get('admin/project', 'admin\AdminProjectController@index');
    Route::post('admin/project', 'admin\AdminProjectController@store');
    Route::post('admin/project/update', 'admin\AdminProjectController@update');
    Route::delete('admin/project/{id}', 'admin\AdminProjectController@destroy');
    //app routes
    Route::get('admin/app', 'admin\AdminAppController@index');
    Route::post('admin/app', 'admin\AdminAppController@store');
    Route::put('admin/app/{id}', 'admin\AdminAppController@update');
    Route::delete('admin/app/{id}', 'admin\AdminAppController@destroy');
    //techs routes
    Route::get('admin/techs', 'admin\AdminTechController@index');
    Route::post('admin/techs', 'admin\AdminTechController@store');
    Route::post('admin/techs/update', 'admin\AdminTechController@update');
    Route::delete('admin/techs/{id}', 'admin\AdminTechController@destroy');

    Route::get('admin/techs-info', 'admin\AdminTechinfoController@index');
    Route::post('admin/techs-info', 'admin\AdminTechinfoController@store');
    Route::post('admin/techs-info/update', 'admin\AdminTechinfoController@update');
    Route::delete('admin/techs-info/{id}', 'admin\AdminTechinfoController@destroy');
    //company routes
    Route::get('admin/company', 'admin\AdminCompanyController@index');
    Route::post('admin/company', 'admin\AdminCompanyController@store');
    Route::post('admin/company/update', 'admin\AdminCompanyController@update');
    Route::delete('admin/company/{id}', 'admin\AdminCompanyController@destroy');
    //team routes
    Route::get('admin/team', 'admin\AdminTeamController@index');
    Route::post('admin/team', 'admin\AdminTeamController@store');
    Route::post('admin/team/update', 'admin\AdminTeamController@update');
    Route::delete('admin/team/{id}', 'admin\AdminTeamController@destroy');
    //contact routes
    Route::get('admin/contact', 'admin\AdminContactController@index');
    Route::post('admin/contact', 'admin\AdminContactController@store');
    Route::put('admin/contact/{id}', 'admin\AdminContactController@update');
    Route::delete('admin/contact/{id}', 'admin\AdminContactController@destroy');
    
/* }); */
