<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewuserController;
use App\Http\Middleware\validateuser;
use App\Http\Controllers\PdfController;

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
});

Route::get('/feature1', function () {
    return view('feature1');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/add','adduser')->name('displayform');
Route::post('/addusers', [NewuserController::class, 'addUser'])->name('add.user');
Route::get('/newuser',[NewuserController::class, 'index'])->name('view.user');
Route::get('/newuser/{id}',[NewuserController::class, 'getUser'])->name('user');
Route::post('/update/{id}',[NewuserController::class, 'updateUser'])->name('update.user');
Route::get('/updatepage/{id}',[NewuserController::class, 'fetchData'])->name('fetchdata.user');
Route::get('/delete/{id}',[NewuserController::class, 'deleteUser'])->name('delete.user');
Route::controller(NewuserController::class)->group(function(){
    Route::get('image-upload', 'imageUpload');
    Route::post('image-upload', 'store')->name('image.store');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// PDF Routes
Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);
Route::get('/download-pdf', [PdfController::class, 'downloadPdf'])->name('download.pdf');
