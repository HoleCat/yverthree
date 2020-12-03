<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/Tienda/{Store}', [StoreController::class, 'show']);
Route::get('/Store/{Store}', [StoreController::class, 'show']);


Route::group(['middleware' => 'auth'], function () {        

    Route::match(['get', 'post'], '/Gallery/Upload',[GalleryController::class, 'upload_img']);
    Route::match(['get', 'post'], '/Gallery/Update',[GalleryController::class, 'update']);
    
    Route::post('/Test', [GalleryController::class, 'test']);
    Route::get('/Test', [GalleryController::class, 'test']);

    Route::get('/Categories/Index', [CategorieController::class, 'index'])->name('categories');
    Route::get('/Products/Index', [ProductController::class, 'index'])->name('products');
    Route::get('/Clients/Index', [ClientController::class, 'index'])->name('clients');

    Route::get('/Categories/Gallery', [GalleryController::class, 'category'])->name('categories');
    Route::get('/Products/Gallery', [GalleryController::class, 'product'])->name('products');

    Route::get('/Categories/Create', [CategorieController::class, 'create']);
    Route::get('/Products/Create', [ProductController::class, 'create']);
    Route::get('/Clients/Create', [ClientController::class, 'create']);

    Route::post('/Categories/Store', [CategorieController::class, 'store']);
    Route::post('/Products/Store', [ProductController::class, 'store']);
    Route::post('/Clients/Store', [ClientController::class, 'store']);
    Route::get('/Categories/Store', [CategorieController::class, 'index']);
    Route::get('/Products/Store', [ProductController::class, 'index']);
    Route::get('/Clients/Store', [ClientController::class, 'index']);

    Route::post('/Categories/Edit', [CategorieController::class, 'edit']);
    Route::post('/Products/Edit', [ProductController::class, 'edit']);
    Route::post('/Clients/Edit', [ClientController::class, 'edit']);
    Route::get('/Categories/Edit', [CategorieController::class, 'index']);
    Route::get('/Products/Edit', [ProductController::class, 'index']);
    Route::get('/Clients/Edit', [ClientController::class, 'index']);
    Route::get('/Stores/Edit', [StoreController::class, 'edit']);
    
    Route::post('/Categories/Update', [CategorieController::class, 'update']);
    Route::post('/Products/Update', [ProductController::class, 'update']);
    Route::post('/Clients/Update', [ClientController::class, 'update']);
    Route::post('/Stores/Update', [StoreController::class, 'update']);
    Route::get('/Categories/Update', [CategorieController::class, 'index']);
    Route::get('/Products/Update', [ProductController::class, 'index']);
    Route::get('/Clients/Update', [ClientController::class, 'index']);
    Route::get('/Stores/Update', [StoreController::class, 'edit']);
    
    Route::post('/Categories/Show', [CategorieController::class, 'show']);
    Route::post('/Products/Show', [ProductController::class, 'show']);
    Route::post('/Clients/Show', [ClientController::class, 'show']);
    Route::get('/Categories/Show', [CategorieController::class, 'index']);
    Route::get('/Products/Show', [ProductController::class, 'index']);
    Route::get('/Clients/Show', [ClientController::class, 'index']);
    
    Route::post('/Categories/Destroy', [CategorieController::class, 'destroy']);
    Route::post('/Products/Destroy', [ProductController::class, 'destroy']);
    Route::post('/Clients/Destroy', [ClientController::class, 'destroy']);
    Route::get('/Categories/Destroy', [CategorieController::class, 'index']);
    Route::get('/Products/Destroy', [ProductController::class, 'index']);
    Route::get('/Clients/Destroy', [ClientController::class, 'index']);
});