<?php

// URL::forceRootUrl('https://mainbasket.bpsdmjabarapps.com');

use App\Http\Controllers\Backoffice\API\ItemController as APIItemController;
use App\Http\Controllers\Backoffice\API\RepositoryController as APIRepositoryController;
use App\Http\Controllers\Backoffice\AuthController;
use App\Http\Controllers\Backoffice\BuildingController;
use App\Http\Controllers\Backoffice\CategoryItemController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\DocumentController;
use App\Http\Controllers\Backoffice\FileController;
use App\Http\Controllers\Backoffice\FloorController;
use App\Http\Controllers\Backoffice\Import\ItemImportController;
use App\Http\Controllers\Backoffice\Import\RepositoryImportController;
use App\Http\Controllers\Backoffice\ItemController;
use App\Http\Controllers\Backoffice\NotUsedItemController;
use App\Http\Controllers\Backoffice\RepositoryController;
use App\Http\Controllers\Frontoffice\BuildingController as FrontofficeBuildingController;
use App\Http\Controllers\Frontoffice\FileController as FrontofficeFileController;
use App\Http\Controllers\Frontoffice\FloorController as FrontofficeFloorController;
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
Route::get('/building/{id}', [FrontofficeBuildingController::class, 'show']);
Route::get('/floor/{id}', [FrontofficeFloorController::class, 'show']);
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

    Route::get('/backoffice/building', [BuildingController::class, 'index']);
    Route::get('/backoffice/edit-building/{id}', [BuildingController::class, 'edit']);
    Route::put('/backoffice/building', [BuildingController::class, 'update']);

    Route::get('/backoffice/floor', [FloorController::class, 'index']);
    Route::get('/backoffice/edit-floor/{id}', [FloorController::class, 'edit']);
    Route::put('/backoffice/floor', [FloorController::class, 'update']);

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
    Route::get('/backoffice/items/generate-qr/bulk', [ItemController::class, 'getBulkQRCodes']);

    Route::get('/backoffice/import/item', [ItemImportController::class, 'index']);
    Route::post('/backoffice/import/item', [ItemImportController::class, 'import']);

    Route::get('/backoffice/import/category-item', [ItemImportController::class, 'index_category']);
    Route::post('/backoffice/import/category-item', [ItemImportController::class, 'import_category']);

    Route::get('/backoffice/import/repository', [RepositoryImportController::class, 'index']);
    Route::post('/backoffice/import/repository', [RepositoryImportController::class, 'import']);

    Route::get('/backoffice/document', [DocumentController::class, 'index']);
    Route::get('/backoffice/add-document', [DocumentController::class, 'create']);
    Route::post('/backoffice/document', [DocumentController::class, 'store']);
    Route::get('/backoffice/edit-document/{id}', [DocumentController::class, 'edit']);
    Route::put('/backoffice/document', [DocumentController::class, 'update']);
    Route::delete('/backoffice/document/{id}', [DocumentController::class, 'delete']);

    Route::get('/backoffice/json/qr-code/item/{id}', [APIItemController::class, 'get_qr_code']);
    Route::get('/backoffice/json/qr-code/repository/{id}', [APIRepositoryController::class, 'get_qr_code']);
    Route::get('/backoffice/json/qr-code/building/{id}', [APIRepositoryController::class, 'get_qr_code_building']);
    Route::get('/backoffice/json/qr-code/floor/{id}', [APIRepositoryController::class, 'get_qr_code_floor']);

    Route::get('/backoffice/json/categories/{field_id}', [APIItemController::class, 'get_categories']);
    Route::get('/backoffice/json/sub_categories/{category_id}', [APIItemController::class, 'get_sub_categories']);
    Route::get('/backoffice/json/sub_sub_categories/{sub_category_id}', [APIItemController::class, 'get_sub_sub_categories']);
    Route::get('/backoffice/json/sub_sub_category_items/{sub_sub_category_id}', [APIItemController::class, 'get_sub_sub_category_items']);
    Route::get('/backoffice/json/sub_sub_category_items/detail/{id}', [APIItemController::class, 'get_sub_sub_category_item_detail']);

    Route::get('/backoffice/json/floors/{building_id}', [APIRepositoryController::class, 'get_floors']);
    Route::get('/backoffice/json/repositories/{floor_id}', [APIRepositoryController::class, 'get_repositories']);
    Route::get('/backoffice/json/repositories/detail/{id}', [APIRepositoryController::class, 'get_repository_detail']);
});
