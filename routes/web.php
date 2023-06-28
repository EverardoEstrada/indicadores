<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\importerController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\AdminController;


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

Route::get('/', function () {return redirect('/login');});

Route::get('/importar', [importerController::class, 'muestraImportacion' ])->middleware("auth");
Route::post('/importarArchivo', [importerController::class, 'importaAlumnos' ])->middleware("auth");

Route::get('/alumnos', [AlumnosController::class, 'index' ])->middleware("auth");
Route::post('/alumnos', [AlumnosController::class, 'index' ])->middleware("auth");

Route::get('/egreso', [AlumnosController::class, 'resumen' ])->middleware("auth");
// Route::get('/resumen/{generacion}', [AlumnosController::class, 'resumen' ])->middleware("auth");


Route::get('/usuarios', [AdminController::class, 'index' ])->middleware("auth");







Route::get('/panel',function (){
    return view("dashboard");
});

Route::get('/dashboard', function () {
    return redirect("/alumnos");
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
