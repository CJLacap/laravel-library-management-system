<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\BorrowBook;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    public function index(){
        $users = User::all();
        $books = Book::all();
        $borrowBooks = BorrowBook::all();
        $bookRequests = BookRequest::all();
        $weekBookRequests = BookRequest::where('created_at', '>', Carbon::now()->startOfWeek())
        ->where('created_at', '<', Carbon::now()->endOfWeek())->get();
        $weekDueBooks = BorrowBook::where('due_at', '>', Carbon::now()->startOfWeek())
        ->where('due_at', '<', Carbon::now()->endOfWeek())->get();
        return view('librarian.index', compact('books','borrowBooks', 'bookRequests','users','weekBookRequests','weekDueBooks'));
       
    }
}
