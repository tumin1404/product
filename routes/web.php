<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/layout', function () {
    return view('admin.layout');
});

//admin
Route::get('/admin/signup', [AdminController::class, 'showSignupForm'])->name('admin.signup.form');
Route::post('/admin/signup', [AdminController::class, 'signup'])->name('admin.signup');
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
        //Route category
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
        route::get('/category/{id}', [CategoryController::class, 'show'])->name('admin.category.show');
        route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
        // Các route khác thuộc phần admin
    });
});
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
