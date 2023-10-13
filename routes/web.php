<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookRequestController;
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
    Route::patch('/admin/librarian/status/{librarian}', [AdminController::class, 'updateLibrarianStatus'])->name('librarian.status');
    Route::delete('/admin/librarian/{librarian}', [AdminController::class, 'destroyLibrarian'])->name('librarian.destroy');

  
    Route::patch('/user/{user}', [AdminController::class, 'updateUser'])->name('user.update');
    Route::patch('/user/status/{user}', [AdminController::class, 'updateUserStatus'])->name('user.status');
    Route::delete('/user/{user}', [AdminController::class, 'destroyUser'])->name('user.destroy');

}); // End Group Admin Middleware



Route::middleware(['auth','role:librarian','status', 'verified'])->group(function(){

    Route::get('/librarian', [LibrarianController::class, 'index'])->name('librarian.dashboard');


}); // End Group Librarian Middleware



Route::middleware(['auth','role:admin,librarian'])->group(function(){

    Route::get('/user', [AdminController::class, 'userAccounts'])->name('user.accounts');
    Route::get('/user/create', [AdminController::class, 'createUser'])->name('user.create');
    Route::post('/user/create', [AdminController::class, 'storeUser'])->name('user.store');
    Route::get('/user/{user}', [AdminController::class, 'editUser'])->name('user.edit');

    Route::get('/book/categories', [BookController::class, 'categories'])->name('book.categories');
    Route::get('/book/categories/create', [BookController::class, 'createCategory'])->name('category.create');
    Route::get('/book/categories/{category}', [BookController::class, 'categoryEdit'])->name('category.edit');
    Route::post('/book/categories/create', [BookController::class, 'storeCategory'])->name('category.store');
    Route::patch('/book/categories/{category}', [BookController::class, 'categoryUpdate'])->name('category.update');
    Route::delete('/book/categories/delete/{category}', [BookController::class, 'categoryDestroy'])->name('category.destroy');

    Route::get('/book/publishers/{publisher}', [BookController::class, 'publisherEdit'])->name('publisher.edit');
    Route::get('/book/publishers', [BookController::class, 'publishers'])->name('book.publishers');
    Route::patch('/book/publishers/{publisher}', [BookController::class, 'publisherUpdate'])->name('publisher.update');
    Route::delete('/book/publishers/delete/{publisher}', [BookController::class, 'publisherDestroy'])->name('publisher.destroy');

    Route::get('/book/authors', [BookController::class, 'authors'])->name('book.authors');
    Route::get('/book/authors/{author}', [BookController::class, 'authorEdit'])->name('author.edit');
    Route::patch('/book/authors/{author}', [BookController::class, 'authorUpdate'])->name('author.update');
    Route::delete('/book/authors/delete/{author}', [BookController::class, 'authorDestroy'])->name('author.destroy');

    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'createBook'])->name('book.create');
    Route::get('/book/{book}', [BookController::class, 'editBook'])->name('book.edit');
    Route::post('/book/create', [BookController::class, 'storeBook'])->name('book.store');
    Route::patch('/book/{book}', [BookController::class, 'updateBook'])->name('book.update');
    Route::patch('/book/cover/{book}', [BookController::class, 'updateCover'])->name('book.cover');
    Route::delete('/book/{book}', [BookController::class, 'destroybook'])->name('book.destroy');
    Route::get('/book/bookCategory/{bookCategory}', [BookController::class, 'bookCategoryDestroy'])->name('bookCategory.destroy');

    Route::get('/requests', [BookRequestController::class, 'index'])->name('request.index');

    
    Route::get('/borrowed', [BookRequestController::class, 'borrowedIndex'])->name('borrowed.index');

    
}); // End Group Admin & Librarian Middleware


Route::middleware(['auth','role:user','status','verified' ])->group(function(){

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/books', [UserController::class, 'books'])->name('user.books');
    Route::get('/dashboard/books/{book}', [UserController::class, 'show'])->name('user.showBook');
    Route::post('/dashboard/books/{book}', [UserController::class, 'storeBookRequest'])->name('user.storeRequest');
    
    Route::get('/dashboard/requests', [UserController::class, 'showRequests'])->name('user.requests');
    Route::get('/dashboard/requests/pending', [UserController::class, 'requestPending'])->name('request.pending');
    Route::get('/dashboard/requests/approved', [UserController::class, 'requestApproved'])->name('request.approved');
    Route::get('/dashboard/requests/cancelled', [UserController::class, 'requestCancelled'])->name('request.cancelled');
    Route::post('/dashboard/requests/{bookRequest}', [UserController::class, 'updateRequest'])->name('request.update');
    Route::delete('/dashboard/requests/{bookRequest}', [UserController::class, 'destroyRequest'])->name('request.destroy');
    
    Route::get('/dashboard/borrowed', [UserController::class, 'showBorrowBooks'])->name('user.borrowed');

}); // End Group User Middleware