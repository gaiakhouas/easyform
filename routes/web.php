<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/home', 'MainController@home')->name('main.home');

Auth::routes();
Route::get('/logout', function(){
    Auth::logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');


Route::get('/', 'HomeController@index')->name('home');

/**
 * courses view
 */
Route::get('/courses', 'CoursesController@courses')->name('courses.index');
Route::get('{category?}/courses/{slug}', 'CoursesController@show')->name('courses.show');
Route::get('/category/{slug}', 'CoursesController@category')->name('courses.category');


/**
 * instructor view
 * * Basis
 */
Route::get('/instructor/overview', 'InstructorController@index')->name('instructor.index');
Route::get('/instructor/new', 'InstructorController@create')->name('instructor.create');
Route::post('/instructor/store', 'InstructorController@store')->name('instructor.store');
Route::get('/instructor/courses/{id}/edit', 'InstructorController@edit')->name('instructor.edit');
Route::put('/instructor/courses/{id}/update', 'InstructorController@update')->name('instructor.update');
Route::get('/instructor/courses/{id}/destroy', 'InstructorController@destroy')->name('instructor.destroy');
Route::get('/instructor/courses/{id}/publish', 'InstructorController@publish')->name('instructor.publish');

/**
 * Instructor view
 * * Participants
 */
Route::get('/instructor/participants/{id}', 'InstructorController@participants')->name('instructor.participants');

/**
 * instructor view
 * * pricing 
 */
Route::get('/instructor/courses/{id}/pricing', 'PricingController@pricing')->name('pricing.index');
Route::post('/instructor/courses/{id}/pricing/store', 'PricingController@store')->name('pricing.store');

/** 
 * instructor view
 * * content
*/ 
Route::get('/instructor/courses/{id}/curriculum', 'CurriculumController@index')->name('instructor.curriculum.index');
Route::get('/instructor/courses/{id}/curriculum/add', 'CurriculumController@create')->name('instructor.curriculum.create');
Route::post('/instructor/courses/{id}/curriculum/add', 'CurriculumController@store')->name('instructor.curriculum.store');
Route::get('/instructor/courses/{id}/curriculum/{section}/edit', 'CurriculumController@edit')->name('instructor.curriculum.edit');
Route::put('/instructor/courses/{id}/curriculum/{section}/update', 'CurriculumController@update')->name('instructor.curriculum.update');
Route::get('/instructor/courses/{id}/curriculum/{section}/destroy', 'CurriculumController@destroy')->name('instructor.curriculum.destroy');

/**
 * Cart view
 */
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/{id}/store', 'CartController@store')->name('cart.store');
Route::get('/cart/{id}/destroy', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');

/**
 * Wishlist view
 */
Route::get('/wishlist/{id}/store', 'WishListController@store')->name('wishlist.store');
Route::get('/wishlist/{id}/destroy', 'WishListController@destroy')->name('wishlist.destroy');
Route::get('/wishlist/{id}/toCart', 'WishListController@toCart')->name('wishlist.toCart');
Route::get('/cart/{id}/switch', 'WishListController@toWishlist')->name('wishlist.toWishlist');

/**
 * Checkout view
 */
Route::get('/checkout', 'CheckoutController@checkout')->name('checkout.payment');
Route::post('/checkout/charge', 'CheckoutController@charge')->name('checkout.charge');
Route::get('/checkout/success', 'CheckoutController@success')->name('checkout.success');

/**
 * Participant view
 */
Route::get('/participant/courses', 'ParticipantController@index')->name('participant.index');
Route::get('/participant/{category?}/course/{slug}', 'ParticipantController@show')->name('participant.course.show');
Route::get('/participant/{category?}/course/{slug}/{section}', 'ParticipantController@section')->name('participant.course.section');

