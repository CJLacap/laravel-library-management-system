<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\BorrowBook;
use App\Models\User;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    public function index(){
        $users = User::all();
        $books = Book::all();
        $borrowBooks = BorrowBook::all();
        $bookRequests = BookRequest::all();
        return view('librarian.index', compact('books','borrowBooks', 'bookRequests','users'));
       
    }
}
