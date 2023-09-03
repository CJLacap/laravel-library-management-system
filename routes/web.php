<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth','role:admin'])->group(function(){

    
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/librarian', [AdminController::class, 'librarianAccounts'])->name('librarian.accounts');
    Route::get('/admin/librarian/create', [AdminController::class, 'createLibrarian'])->name('librarian.create');
    Route::post('/admin/librarian/create', [AdminController::class, 'storeLibrarian'])->name('librarian.store');
    Route::get('/admin/librarian/{librarian}', [AdminController::class, 'editLibrarian'])->name('librarian.edit');
    Route::patch('/admin/librarian/{librarian}', [AdminController::class, 'updateLibrarian'])->name('librarian.update');
    Route::delete('/admin/librarian/{librarian}', [AdminController::class, 'destroyLibrarian'])->name('librarian.destroy');

  
    Route::patch('/user/{user}', [AdminController::class, 'updateUser'])->name('user.update');
    Route::delete('/user{user}', [AdminController::class, 'destroyUser'])->name('user.destroy');


    


}); // End Group Admin Middleware



Route::middleware(['auth','role:librarian','status', 'verified'])->group(function(){

    Route::get('/librarian', [LibrarianController::class, 'index'])->name('librarian.dashboard');


}); // End Group Librarian Middleware



Route::middleware(['auth','role:admin,librarian'])->group(function(){

    Route::get('/user', [AdminController::class, 'userAccounts'])->name('user.accounts');
    Route::get('/user/create', [AdminController::class, 'createUser'])->name('user.create');
    Route::post('/user/create', [AdminController::class, 'storeUser'])->name('user.store');
    Route::get('/user/{user}', [AdminController::class, 'editUser'])->name('user.edit');


    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/create', [BookController::class, 'store'])->name('book.store');
    
    
  
   
}); // End Group Admin & Librarian Middleware




Route::middleware(['auth','role:user','status','verified' ])->group(function(){


    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    

}); // End Group User Middleware