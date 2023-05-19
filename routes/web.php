<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ImageController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Login Route
Route::get('/{url_handle}/login', '\App\Http\Controllers\CustomAuthController@index');
Route::get('/admin', '\App\Http\Controllers\AdminAuthController@index');
Route::post('/admin-login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');
// Route::post('/contact', '\App\Http\Controllers\VenuesController@contactEmail');
Route::post('/contact', '\App\Http\Controllers\ContactUsFormController@ContactUsForm');

Route::middleware(['auth'])->group(static function () {

    Route::get('resizeImage', [ImageController::class, 'resizeImage']);
    Route::post('resizeImage', [ImageController::class, 'resizeImage'])->name('resizeImage');

    Route::resource('/wedding', '\App\Http\Controllers\WeddingsController');
    Route::resource('/venue', '\App\Http\Controllers\VenuesController');
    Route::resource('/timeline', '\App\Http\Controllers\TimelinesController');
    Route::resource('/user', '\App\Http\Controllers\UsersController');

    // Venues Routes
    Route::post('/venue/store', '\App\Http\Controllers\VenuesController@store');
    Route::put('/venue/{id}', '\App\Http\Controllers\VenuesController@update');
    Route::put('/admin/password-reset/{url_handle}', '\App\Http\Controllers\VenuesController@pwReset');
    Route::get('/venue/show/{id}', '\App\Http\Controllers\VenuesController@show');
    Route::get('/admin/customer-details/{url_handle}', '\App\Http\Controllers\VenuesController@edit');
    Route::get('/admin/create-customer-details', '\App\Http\Controllers\VenuesController@create');

    Route::get('/admin/index', '\App\Http\Controllers\VenuesController@index');
    Route::put('/venue/{id}/delete', '\App\Http\Controllers\VenuesController@delete');
    Route::get('/support', '\App\Http\Controllers\VenuesController@support');

    // Timeline Routes
    Route::get('/{url_handle}/client-details/create', '\App\Http\Controllers\TimelinesController@create');
    Route::get('/{url_handle}/client-details/{wedding_url_handle}', '\App\Http\Controllers\TimelinesController@edit');
    Route::put('/timeline/{id}/delete', '\App\Http\Controllers\TimelinesController@delete');
    Route::post('/timeline/store', '\App\Http\Controllers\TimelinesController@store');

    // Wedding Routes
    Route::get('/events', '\App\Http\Controllers\WeddingsController@index');
    Route::get('/{url_handle}/index/{archive?}', '\App\Http\Controllers\WeddingsController@venueWeddings');
    Route::get('/admin/customer/clients/{url_handle}', '\App\Http\Controllers\WeddingsController@adminVenueWeddings');
    Route::put('/timeline/{id}/lock', '\App\Http\Controllers\TimelinesController@lock');
    Route::put('/timeline/{id}/archive', '\App\Http\Controllers\TimelinesController@archive');

    // User Routes
    Route::get('/user/{id}/edit', '\App\Http\Controllers\UsersController@edit');
    Route::get('/customer-client/manage', '\App\Http\Controllers\UsersController@userManagement');
    Route::put('/user/{id}/delete', '\App\Http\Controllers\UsersController@delete');
    Route::put('/user/password-reset/{id}', '\App\Http\Controllers\UsersController@pwReset');
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    //Email Routes
    Route::get('send-mail', '\App\Http\Controllers\MailController@index');
});





require __DIR__ . '/auth.php';
