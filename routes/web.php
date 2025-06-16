<?php

use App\Http\Controllers\Backoffice\AuthController;
use App\Http\Controllers\Backoffice\CategoryItemController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\FileController;
use App\Http\Controllers\Backoffice\ItemController;
use App\Http\Controllers\Backoffice\NotUsedItemController;
use App\Http\Controllers\Backoffice\RepositoryController;
use App\Http\Controllers\Frontoffice\FileController as FrontofficeFileController;
use App\Http\Controllers\Frontoffice\ItemController as FrontofficeItemController;
use App\Http\Controllers\Frontoffice\LandingPageController;
use App\Http\Controllers\Frontoffice\RepositoryController as FrontofficeRepositoryController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/item/{id}', [FrontofficeItemController::class, 'show']);
Route::get('/repository/{id}', [FrontofficeRepositoryController::class, 'show']);
Route::get('/show-file/{file_type}/{table_name}/{id}/{name}', [FrontofficeFileController::class, 'show_file']);

Route::get('/backoffice/login', [AuthController::class, 'index']);
Route::post('/backoffice/login', [AuthController::class, "authenticate"]);
Route::post('/backoffice/logout', [AuthController::class, "logout"]);

Route::group(['middleware' => 'can:canAccessBackoffice'], function () {
    Route::get('/backoffice/show-file/{file_type}/{table_name}/{id}/{name}', [FileController::class, 'show_file']);

    Route::get('/backoffice/dashboard', [DashboardController::class, 'index']);

    Route::get('/backoffice/repository', [RepositoryController::class, 'index']);
    Route::get('/backoffice/add-repository', [RepositoryController::class, 'create']);
    Route::post('/backoffice/repository', [RepositoryController::class, 'store']);
    Route::get('/backoffice/edit-repository/{id}', [RepositoryController::class, 'edit']);
    Route::put('/backoffice/repository', [RepositoryController::class, 'update']);
    Route::delete('/backoffice/repository/{id}', [RepositoryController::class, 'delete']);
    
    Route::get('/backoffice/category-item', [CategoryItemController::class, 'index']);
    Route::get('/backoffice/add-category-item', [CategoryItemController::class, 'create']);
    Route::post('/backoffice/category-item', [CategoryItemController::class, 'store']);
    Route::get('/backoffice/edit-category-item/{id}', [CategoryItemController::class, 'edit']);
    Route::put('/backoffice/category-item', [CategoryItemController::class, 'update']);
    Route::delete('/backoffice/category-item/{id}', [CategoryItemController::class, 'delete']);

    Route::get('/backoffice/item', [ItemController::class, 'index']);
    Route::get('/backoffice/add-item', [ItemController::class, 'create']);
    Route::post('/backoffice/item', [ItemController::class, 'store']);
    Route::get('/backoffice/edit-item/{id}', [ItemController::class, 'edit']);
    Route::put('/backoffice/item', [ItemController::class, 'update']);
    Route::delete('/backoffice/item/{id}', [ItemController::class, 'delete']);

    Route::get('/backoffice/not-used-item', [NotUsedItemController::class, 'index']);
    Route::get('/backoffice/edit-not-used-item/{id}', [NotUsedItemController::class, 'edit']);
    Route::put('/backoffice/not-used-item', [NotUsedItemController::class, 'update']);
    Route::delete('/backoffice/not-used-item/{id}', [NotUsedItemController::class, 'delete']);


    Route::get('/backoffice/item/generate-qr/{id}', [ItemController::class, 'generateQRCode']);
});
