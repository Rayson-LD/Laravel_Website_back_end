<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/','WebController@home');
Route::get('emailview', 'WebController@emailview');
Route::get('sendmail', 'WebController@email_verification');
Route::get('AboutKushal','WebController@About');
Route::get('services','WebController@services');
Route::get('header','WebController@heads');
Route::get('Contact','WebController@Contact');
Route::get('about_us','WebController@about_us');
Route::get('get_careers','WebController@get_careers');
Route::get('join_table', 'WebController@join_table');
Route::get('report', 'WebController@report');
Route::get('dashboardchart', 'WebController@dashboardchart');
Route::get('index', 'WebController@index');
Route::get('yearly', 'WebController@yearly');
Route::get('quarter', 'WebController@quarter');

Route::get('KushalDashboard', 'AdminController@KushalEdits');
Route::get('admin_about', 'AdminController@admin_about');
Route::post('about_insert', 'AdminController@about_insert');
Route::get('admin', 'AdminController@login');
Route::post('admin_login', 'AdminController@admin_login');
Route::get('dashboard', 'AdminController@dashboard');
Route::post('get_comments', 'AdminController@get_comments');
Route::get('contactus', 'AdminController@view_comments');

Route::get('customer_login','AdminController@customer_login');
Route::get('customers', 'AdminController@customers');
Route::post('insertCustomer', 'AdminController@insertCustomer');
Route::get('EditCustomer', 'AdminController@EditCustomer');
Route::get('DeleteCustomer', 'AdminController@DeleteCustomer');


Route::get('orders', 'AdminController@orders');
Route::get('buy_now', 'AdminController@buy_now');
Route::post('insertOrder', 'AdminController@insertOrder');
Route::get('editOrder', 'AdminController@editOrder');
Route::get('deleteOrder', 'AdminController@deleteOrder');

Route::get('vendor_login','AdminController@vendor_login');
Route::get('vendors', 'AdminController@vendors');
Route::post('insertVendor', 'AdminController@insertVendor');
Route::get('EditVendor','AdminController@EditVendor');
Route::get('DeleteVendor', 'AdminController@DeleteVendor');

Route::get('change_Password', 'AdminController@change_password');
Route::post('resetPassword', 'AdminController@resetPassword');

Route::get('careers','AdminController@admin_careers');
Route::post('careers', 'AdminController@careers');
Route::get('EditDesc','AdminController@EditDesc');

Route::get('admin_services','AdminController@admin_services');
Route::post('admin_services', 'AdminController@Services');
Route::get('EditServices','AdminController@EditServices');
Route::get('DeleteServices', 'AdminController@DeleteServices');




/*here / is root page... means url we will be mentioning*/
/*in return function 'welcome' ->indicated page name or blade*/
