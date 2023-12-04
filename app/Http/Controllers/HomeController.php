<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\BorrowBook;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
   /**
     * Landing Page and Not Authenticated User
     */
    public function homeIndex(){
        return view('home.index');
    }

    public function aboutUs(){
        return view('home.about-us');
    }

    public function contactUs(){
        return view('home.contact');
    }

    public function contactSubmit(Request $request){
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Save the form data to the database using the ContactUs model
        ContactUs::create($validatedData);

        return redirect()->back()->with('status', 'Thank you for contacting us!');

    }

    public function homeBooks(Request $request){
        $books = $books = Book::orderBy('title', 'asc')->paginate(9);
        if($search = $request->search){
            $books = (new UserController)->searchBook($search);
            if(count($books) == 0){
              return Redirect::back()->with('statusError','No Book Found');
            }
          }
        return view('home.books.index', compact('books'));
    }

    public function homeBookShow(Book $book){
        return view('home.books.show', compact('book'));
    }
}
