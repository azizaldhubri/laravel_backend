<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\socialAuthController;
use App\Http\Controllers\UsersContoller;
// use App\Http\Controllers\PostsContoller;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\taskcontroller;
use App\Http\Controllers\chiledTaskesController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Public Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/passowrd', 'sendResetLink');
    Route::post('/reset-password', 'reset');
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/latest-sale', [ProductController::class, 'getLastSaleProducts']);
Route::get('/latest', [ProductController::class, 'getLatest']);
Route::get('/top-rated', [ProductController::class, 'getTopRated']);


Route::get('/login-google', [socialAuthController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [socialAuthController::class, 'handleCallback']);
// Route::get('/task', 'GetTasks');
// Protected Routes
Route::middleware('auth:api')->group(function () {
    // Users
    Route::get('/user', [UsersContoller::class, 'authUser']);
    Route::middleware('checkAdmin')->controller(UsersContoller::class)->group(function () {
        Route::get('/users', 'GetUsers');        
        Route::get('/user/{id}', 'getUser');
        Route::post('/user/search', 'search');
        Route::post('/user/edit/{id}', 'editUser');
        Route::post('/user/add', 'addUser');
        Route::delete('/user/{id}', 'destroy');
    });
    // Product Manger
    Route::middleware('checkProductManager')->controller(CategoryController::class)->group(function () {

        Route::get('/category/{id}', 'show');
        Route::post('/category/search', 'search');
        Route::post('/category/edit/{id}', 'edit');
        Route::post('/category/add', 'store');
        Route::delete('/category/{id}', 'destroy');
    });

    Route::middleware('checkProductManager')->controller(ProductController::class)->group(function () {

        Route::get('/product/{id}', 'show');
        Route::post('/product/search', 'search');
        Route::post('/product/edit/{id}', 'update');
        Route::post('/product/add', 'store');
        Route::delete('/product/{id}', 'destroy');
    });
    Route::middleware('checkProductManager')->controller(ProductImageController::class)->group(function () {
        Route::post('/product-img/add', 'store');
        Route::delete('/product-img/{id}', 'destroy');
    });

    // Auth
    Route::get('/logout', [AuthController::class, 'logout']);
});


Route::get('/post1/show',[PostsController::class, 'index']);
Route::post('/post1/Add',[PostsController::class, 'upload']);
Route::delete('/post1/{id}',[PostsController::class, 'destroy']);
Route::get('/post/{id}',[PostsController::class, 'getPost']);
   
Route::post('/post1/edit/{id}',[PostsController::class, 'editpost']);

//--------------------
Route::get('tasks', [taskcontroller::class, 'index']);
Route::get('tasks/show/{id}', [taskcontroller::class, 'getTask']);
Route::post('tasks/add', [taskcontroller::class, 'store']);
Route::delete('/tasks/{id}',[taskcontroller::class, 'destroy']);
Route::post('/tasks/edit/{id}',[taskcontroller::class, 'editpost']);

//--------------------

Route::get('chiled_task', [chiledTaskesController::class,'index']);
Route::get('chiled_task/show/{id}', [chiledTaskesController::class, 'getTask']);
Route::post('chiled_task/add', [chiledTaskesController::class, 'store']);
Route::delete('/chiled_task/{id}',[chiledTaskesController::class, 'destroy']);
Route::post('/chiled_task/edit/{id}',[chiledTaskesController::class, 'editpost']);


