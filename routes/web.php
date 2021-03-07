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

#   메인
Route::get('/', function () {
    return view('home');
});

#   로그인 

Route::resources([
    '/register' => 'UsersController',
    '/login' => 'LoginController',
]);
Route::delete('/login',[
    'as' => 'logout',
    'uses' =>'LoginController@logout',
]);

# 비밀번호 변경
Route::get('remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind'
]);
Route::post('remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind'
]);
Route::get('reset/{token}', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset'
]);
Route::post('reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset'
]);

# Q n A

Route::resource('/questions',"QuestionsController");
Route::resource('/answers',"AnswersController");


# 현지학기제
Route::get('/intros/list', function() {
    $intros = [];
    for($i = 1; $i <= 7; $i++){
        $intros[$i-1] = \App\Intro::where('weekset', 'like', '%'.$i.'%')->orderBy('starttime', 'asc')->get();
    }
    return $intros;
});
Route::resource('intros','IntrosController');


# 조원소개

Route::get('/introduce/list', function(){
    $introduces = \App\Member::all();
    return $introduces;
    // return 'aaa';
  
});
 
Route::resource('introduce', 'IntroduceContoller');


# 내 정보  profile  (로그인 된 상태에서만 접근 가능)
#get   
Route::get('/profile',"ProfilesController@index");  # redirect 용 라우터 /profile/{user_id} 여기로 리다이렉트
Route::get('/profile/{user_id}','ProfilesController@show');
Route::get('/profile/{user_id}/edit_info','ProfilesController@edit_info');
Route::get('/profile/{user_id}/edit_pwd','ProfilesController@edit_pwd');

#put
Route::put('/profile/{user_id}/update_info','ProfilesController@update_info');
Route::put('/profile/{user_id}/update_pwd','ProfilesController@update_pwd');
Route::put('/profile/{id}/admin','ProfilesController@put_admin');

#delete
Route::delete('/profile/{id}','ProfilesController@destroy');



