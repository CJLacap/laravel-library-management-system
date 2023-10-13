<?php

namespace App\Http\Controllers;

use App\Models\BookRequest;
use App\Models\BorrowBook;
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    public function index(){
        $bookRequests = BookRequest::latest()->paginate();
        return view('admin.requests', compact('bookRequests'));
    }

    public function pending(){
        $bookRequests = BookRequest::latest()->paginate();
        return view('admin.requests', compact('bookRequests'));
    }

    public function borrowedIndex(BorrowBook $borrowBook){
        $borrowBooks = BorrowBook::latest()->paginate();

        return view('admin.borrowed', compact('borrowBooks')); 
    }
   
}
