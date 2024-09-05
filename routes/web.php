<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewuserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Middleware\ValidateUser;
use App\Http\Controllers\PdfController;


// Grouping NewuserController Routes with middleware
Route::middleware(['userAuth'])->controller(NewuserController::class)->group(function () {
    Route::post('/add', 'addUser')->name('add.user');
    Route::view('/addUser', 'addUser');
    Route::get('/display', 'index')->name('displayform');
    Route::get('image-upload', 'imageupload');
    Route::post('image-upload', 'store')->name('image.store');
    Route::post('/update/{id}', 'updateUser')->name('update.user');
    Route::get('/updatepage/{id}', 'updatePage')->name('update.page');
    Route::get('/deleteuser/{id}', 'deleteUser')->name('delete.page');
  

});
Route::get('send-mail', [MailController::class, 'index']);
// Grouping HomeController Routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'show')->name('homepage');
    Route::get('/home/{id}', 'showUser');
    Route::get('/feature-2', 'showFeature');
    Route::get('/home', 'index')->name('home');
});

// Other Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/feature1', function () {
    return view('feature1');
});



Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);


Route::get('/download-pdf', [PdfController::class, 'downloadPdf']);




// Route to display the home page with the download button
Route::get('/home', function () {
    return view('home');
});

// Route to handle the PDF download
Route::get('/download-pdf', [PdfController::class, 'downloadPdf'])->name('download.pdf');



Auth::routes();



// Route::post('/add', [NewuserController::class, 'addUser'])->name('add.user');

// // adduser portion
// Route::get('/display', [NewuserController::class, 'index'])->name('displayform');

// update
// Route::post('/update/{id}',[NewuserController::class, 'updateUser'])->name('update.user');
// Route::get('/updatepage/{id}',[NewuserController::class, 'updatePage'])->name('update.page');
// update.user

// delete
// Route::get('/deleteuser/{id}',[NewuserController::class, 'deleteUser'])->name('delete.page');

// Route::controller(NewuserController::class)->group(function(){
//     Route::post('/add','addUser')->name('add.user');
// // adduser portion
//     Route::get('/display','index')->name('displayform');
//     Route::get('image-upload', 'imageupload');
//     Route::post('image-upload', 'store')->name('image.store');
//     // update
//     Route::post('/update/{id}','updateUser')->name('update.user');
//     Route::get('/updatepage/{id}','updatePage')->name('update.page');
//     // delete
//     Route::get('/deleteuser/{id}','deleteUser')->name('delete.page');
// });