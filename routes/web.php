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
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');




// Auth::routes();



Route::group(['middleware' => 'parent'], function () {

Route::any('/ratings/{id?idsit?idpar}','Mother@retrieveRatings')->name('parent.rate');
Route::get('/sitters', 'Mother@availablesitters')->name('parent.avsitters');
Route::get('/parent', 'MotherController@index')->name('parent.index');
Route::get('/sitter/profile/{sitterid}', 'Mother@sittersummary')->name('parent.sitsummary');
Route::get('/sitter/book/{sitterid}', 'Mother@booksitter')->name('parent.book');
Route::post('/parent/upload', 'Mother@uploadpic')->name('parent.upload');
Route::get('/pardetail{id?bookid}', 'Mother@displaydetails')->name('parent.details');
Route::get('/parcompletedetail{id?mybookid}', 'Mother@displaycompletedetail')->name('parent.compdetails');
Route::get('/payment/{bookid}/{sitterid}/{parentid}','Mother@reviewsitter')->name('parent.payment');
Route::post('/reviews', 'Mother@submitreview');
Route::post('/availablesitters','Mother@searchsitters');
Route::post('/verify','Mother@verify');
Route::get('/jobdone/{id}','Mother@jobcomplete');

Route::resource('parent', 'MotherController');
});


Route::group(['middleware' => 'sitter'], function () {

Route::get('/sitter/dashboard', 'SitterController@sitterdash')->name('sitter.dashboard');

Route::get('/create', 'SitterController@create')->name('sitter.create');

Route::get('/sitdetails{id?bookid}', 'SitterController@displaydetails1')->name('sitter.details');

Route::get('/sitcompletedetails{id?bookid}', 'SitterController@displaycompletedetails')->name('sitter.compdetails');

Route::get('/booking/accept/{bookid}/{sitterid}/{parentid}', 'SitterController@acceptRequest')->name('sitter.accept');
Route::get('/booking/reject/{bookid}/{sitterid}/{parentid}', 'SitterController@rejectRequest')->name('sitter.reject');


Route::resource('sitter', 'SitterController');

});

Route::group(['middleware'=>'admin'],function(){
	Route::get('/admin', 'AdminController@index')->name('admin.create');
	Route::post('/admin/update','AdminController@update');

	Route::resource('admin', 'AdminController');
});

Route::group(['middleware'=>'guest'],function(){

Route::get('/', 'HomeController@index')->name('home');
	// Registration Routes...
Route::get('register/sitter', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register/sitter', 'Auth\RegisterController@register')->name('signup');

Route::get('/register/parent', 'Auth\MotherRegisterController@signup')->name('pregister');
Route::post('/register/parent', 'Auth\MotherRegisterController@register')->name('psignup');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



});
Route::get('/forbidden', 'User@error');
Route::get('/about', 'User@error')->name('about');
Route::get('/contact', 'User@contact')->name('contact_us');


