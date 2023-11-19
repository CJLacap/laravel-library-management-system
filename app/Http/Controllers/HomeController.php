<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\BorrowBook;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeIndex(){
        return view('home.index');
    }

    public function homeBooks(){
        $books = Book::paginate(9);
        return view('home.books.index', compact('books'));
    }
}
