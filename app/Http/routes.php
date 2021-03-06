<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//public pages
Route::get('/', function () {
    return view('welcome');
});

// help page
Route::get('/help', 'User\UserController@help');

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    //login user pages
    Route::group(['namespace' => 'User'], function () {
        Route::group(['middleware' => 'auth'], function () {
            //personal home page
            Route::any('/home', 'UserController@homePage');
            Route::post('/upload_avatar', 'UserController@saveAvatar');

            //problems related
            Route::get('/problems', 'ProblemsController@index');
            Route::get('/problemDetail', 'ProblemsController@problemDetail');
            Route::post('/receiveCode', 'ProblemsController@receiveCode');
            Route::post('/submissionResult', 'ProblemsController@submissionResult');

            //submissions related
            Route::get('/submissions', 'ProblemsController@userSubmissions');
            Route::get('/submissionDetail', 'ProblemsController@submissionDetail');

            //group related
            Route::get('/groups', 'UserController@groups');
            Route::get('/groupDetail', 'UserController@groupDetail');
            Route::post('/groupApplication', 'UserController@groupApplication');
            
            //contest related
            Route::get('/contests', 'UserController@contests');
            Route::get('/contestDetail', 'UserController@contestDetail');
            Route::get('/contestRank', 'UserController@contestRank');
            Route::get('/contestProblemDetail', 'UserController@contestProblemDetail');
        });
    });

    // admin pages
    Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index');

        // problems
        Route::get('/list_problems', 'AdminController@listProblems');
        Route::get('/add_problems', 'AdminController@addProblems');
        Route::get('/edit_problems', 'AdminController@editProblems');
        Route::get('/delete_problems', 'AdminController@deleteProblems');
        Route::post('/save_problem', 'AdminController@saveProblems');//接收从add和edit传过来的表单

        // classifications
        Route::get('/list_classification', 'AdminController@listClassifications');
        Route::get('/delete_classification', 'AdminController@deleteClassifications');
        Route::post('/save_classification', 'AdminController@saveClassifications');

        // users
        Route::get('/user_list', 'AdminController@listUsers');
        Route::post('/save_user_info', 'AdminController@saveUserInfo');

        // groups
        Route::get('/group_list', 'AdminController@listGroups');
        Route::post('/save_group', 'AdminController@saveGroup');
        Route::get('/group_detail', 'AdminController@groupDetail');
        Route::get('/group_applications', 'AdminController@groupApplicationList');
        Route::get('/join_contests', 'AdminController@joinContests');
        Route::post('/join_in_contest', 'AdminController@joinInContests');
        Route::post('/reply_group_application', 'AdminController@replyApplication');
        Route::post('/remove_member', 'AdminController@removeMember');

        // announcements
        Route::get('/list_announcements', 'AdminController@listAnnouncements');
        Route::post('/save_announcement', 'AdminController@saveAnnouncements');
        Route::post('/delete_announcement', 'AdminController@deleteAnnouncements');

        // contests
        Route::get('/list_contests', 'AdminController@listContests');
        Route::get('/add_contest', 'AdminController@addContest');
        Route::get('/edit_contest', 'AdminController@editContest');
        Route::get('/list_contest_problems', 'AdminController@listContestProblems');
        Route::post('/delete_contest_problem','AdminController@deleteContestProblems');
        Route::post('/save_contest','AdminController@saveContest');
    });
});