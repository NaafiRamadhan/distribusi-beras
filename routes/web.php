<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerasController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\pembayaranController;


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



// Route::get('/cetak', function () {
//     return view('admin.distribusi.distribusi_pdf');
// });
// Route::get('/stockberas', [AdminController::class, 'stock'])->name('stock');

// Login
Route::get('/', [AuthController::class, "login"])->name('login');
Route::post('/dologin', [AuthController::class, "doLogin"])->name('do.login');
// Register
Route::get('/register', [AuthController::class, "register"])->name('register');
Route::post('/register', [AuthController::class, "doRegister"])->name('do.register');
// Logout
Route::get('/logout', [AuthController::class, "logout"])->name('logout');

Route::group(['middleware' => ['auth', 'Role:superadmin,admin']], function () {
    //input admin
    Route::get('/admin', [AdminController::class, 'index'])->name('superadmin.dashboard');
    //beras
    Route::get('/admin/stockberas', [BerasController::class, 'index'])->name('admin.stockberas');
    Route::post('/admin/stockberas/create', [BerasController::class, 'store'])->name('admin.stockberas.create');
    Route::get('/admin/stockberas/add', [BerasController::class, 'create'])->name('admin.stockberas.add');
    Route::get('/admin/stockberas/edit/{id_beras}', [BerasController::class, 'edit'])->name('admin.stockberas.edit');
    Route::put('/admin/stockberas/update/{id_beras}', [BerasController::class, 'update'])->name('admin.stockberas.update');
    Route::get('/admin/stockberas/destroy/{id_beras}', [BerasController::class, 'destroy'])->name('admin.stockberas.destroy');

    //toko
    Route::get('/admin/toko', [TokoController::class, 'index'])->name('admin.toko');
    Route::post('/admin/toko/create', [TokoController::class, 'store'])->name('admin.toko.create');
    Route::get('/admin/toko/add', [TokoController::class, 'create'])->name('admin.toko.add');
    Route::get('/admin/toko/edit/{id_toko}', [TokoController::class, 'edit'])->name('admin.toko.edit');
    Route::put('/admin/toko/update/{id_toko}', [TokoController::class, 'update'])->name('admin.toko.update');
    Route::get('/admin/toko/destroy/{id_toko}', [TokoController::class, 'destroy'])->name('admin.toko.destroy');

    //grade
    Route::get('/admin/grade', [GradeController::class, 'index'])->name('admin.grade');
    Route::post('/admin/grade/create', [GradeController::class, 'store'])->name('admin.grade.create');
    Route::get('/admin/grade/add', [GradeController::class, 'create'])->name('admin.grade.add');
    Route::get('/admin/grade/edit/{id_grade}', [GradeController::class, 'edit'])->name('admin.grade.edit');
    Route::put('/admin/grade/update/{id_grade}', [GradeController::class, 'update'])->name('admin.grade.update');
    Route::get('/admin/grade/destroy/{id_grade}', [GradeController::class, 'destroy'])->name('admin.grade.destroy');

    //Jenis
    Route::get('/admin/jenis', [JenisController::class, 'index'])->name('admin.jenis');
    Route::post('/admin/jenis/create', [JenisController::class, 'store'])->name('admin.jenis.create');
    Route::get('/admin/jenis/add', [JenisController::class, 'create'])->name('admin.jenis.add');
    Route::get('/admin/jenis/edit/{id_jenis}', [JenisController::class, 'edit'])->name('admin.jenis.edit');
    Route::put('/admin/jenis/update/{id_jenis}', [JenisController::class, 'update'])->name('admin.jenis.update');
    Route::get('/admin/jenis/destroy/{id_jenis}', [JenisController::class, 'destroy'])->name('admin.jenis.destroy');

    //user
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::post('/admin/user/create', [UserController::class, 'store'])->name('admin.user.create');
    Route::get('/admin/user/add', [UserController::class, 'create'])->name('admin.user.add');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/user/destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    //distribution
    Route::get('/admin/distribution', [DistributionController::class, 'index'])->name('distribution');
    Route::post('/admin/distribution/store', [DistributionController::class, 'store'])->name('distribution.store');
    Route::get('/admin/distribution/create', [DistributionController::class, 'create'])->name('distribution.add');
    Route::get('/admin/distribution/show/{id}', [DistributionController::class, 'show'])->name('distribution.show');
    Route::get('/admin/distribution/destroy/{id}', [DistributionController::class, 'destroy'])->name('distribution.destroy');
    Route::get('/admin/distribution/cetak/{id}', [DistributionController::class, 'cetak'])->name('distribution.cetak');

    //Pembayaran
    Route::post('/admin/pembayaran/store', [pembayaranController::class, 'store'])->name('pembayaran.store');
});
