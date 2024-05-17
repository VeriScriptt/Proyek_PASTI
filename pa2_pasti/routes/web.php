<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;

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
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route::get('/produk', [ProdukController::class, 'index'])->name('produk'); 

Route::middleware(['App\Http\Middleware\Authenticate'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Tampilkan daftar produk
Route::get('/produk', [ProdukController::class, 'getProdukApi'])->name('produk');
// Tampilkan form untuk menambah produk
Route::get('/create-produk', [ProdukController::class, 'create'])->name('create.produk');
// Hapus produk
Route::delete('/produk/{id}', [ProdukController::class, 'deleteProduk'])->name('delete.produk');
// Tampilkan form untuk edit produk
Route::get('/produk/{id}', [ProdukController::class, 'showUpdate'])->name('show.produk');

// Perbarui data produk
Route::put('/edit_produk/{id}', [ProdukController::class, 'updateProduk'])->name('update.produk');



// TOKO

// Route::get('toko', [TokoController::class, 'getTokoApi'])->name('toko');

// Route::get('/edit_toko', function () {
//     return view('edit_toko');
// })->name('edit_toko');

// Route::get('/toko', function () {
//     return view('');
// })->name('toko');

// Rute untuk menampilkan daftar toko
Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
// Rute untuk menampilkan formulir membuat toko baru
Route::get('/toko/create', [TokoController::class, 'create'])->name('toko.create');
// Rute untuk menyimpan data toko baru
Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
// Rute untuk menampilkan detail toko
Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show');
// Rute untuk menampilkan formulir edit toko
Route::get('/toko/{toko}/edit', [TokoController::class, 'edit'])->name('toko.edit');
// Rute untuk memperbarui data toko
Route::put('/toko/{id}', [TokoController::class, 'update'])->name('toko.update');





/// Ulasan

Route::get('/ulasan', [UlasanController::class, 'getUlasanApi'])->name('ulasan.index');


Route::post('ulasan/hide/{id}', [UlasanController::class, 'hide'])->name('ulasan.hide');
Route::post('ulasan/unhide/{id}', [UlasanController::class, 'unhide'])->name('ulasan.unhide');



//KATEGORI
// Tampilkan daftar produk
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

// Simpan data produk baru
Route::post('/add-kategori', [KategoriController::class, 'store'])->name('store.kategori');

// Tampilkan form untuk edit produk
Route::get('/kategori/{id}', [KategoriController::class, 'showUpdate'])->name('show.kategori');

// Perbarui data produk
// Route::put('/edit_kategori/{id}', [KategoriController::class, 'update'])->name('update.kategori');

Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('update.Kategori');

Route::post('/add-produk', [ProdukController::class, 'addProduk'])->name('store.produk');


    // Route::post('/produk/tambah', [ProdukController::class, 'showTambahProdukForm'])->name('tambah.produk');
// Rute untuk menampilkan halaman tambah produk
Route::get('/tambah-produk', [ProdukController::class, 'showTambahProdukForm'])->name('tambah.produk');

// Rute untuk menambahkan produk
Route::post('/tambah-produk', [ProdukController::class, 'tambahProduk'])->name('store.produk');
});