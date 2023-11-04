<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRequest;
use App\Models\BorrowBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function books(Request $request){
        $books = Book::orderBy('title', 'asc')->paginate(6);
        if($search = $request->search){
          $books = $this->searchBook($search);
          if(count($books) == 0){
            return Redirect::back()->with('message','No Book Found');
          }
        }
        return view('book.user.index', compact('books'));
    }

     /**
     * Search book
     */
    public function searchBook($search){

        return Book::where(function ($query) use ($search){
                    $query->where('title','LIKE',"%$search%")
                    ->orWhere('isbn','LIKE',"%$search%");
                })
                ->orWhereHas('author', function ($query) use ($search){
                    $query->where('name','LIKE',"%$search%");
                })
                ->orWhereHas('publisher', function ($query) use ($search){
                    $query->where('name','LIKE',"%$search%");
    
            })->paginate(12);  
    }

    public function show(Book $book){
        return view('book.user.show', compact('book'));
    }

    public function storeBookRequest(Book $book){
       
        if($book->status == 'available'){
            if(BorrowBook::where('book_id', '=' , $book->id)
                        ->where('status', '=', 'borrowed')->count() < $book->copies){
                if(BookRequest::where('book_id', '=', $book->id)
                            ->where('status', '=', 'approved')->count()  < $book->copies){
                    if(BookRequest::where('user_id', Auth::user()->id)
                                    ->where('book_id', $book->id)
                                    ->where('status', '=', 'pending')->count() == 0 && 
                                    BookRequest::where('user_id', Auth::user()->id)
                                        ->where('book_id', $book->id)
                                        ->where('status', '=', 'approved')->count() == 0 ){

                                        BookRequest::create([
                                            'user_id' => Auth::user()->id,
                                            'book_id' => $book->id,
                                        ]);  
                                        return Redirect::back()->with('status', 'request-sent');
                                        
                                    }else{
                                        return Redirect::back()->with('statusError', 'You Already Sent A Request To This Book!');
                                    }
                    }else{
                        return Redirect::back()->with('statusError', 'There Is Already Been Approved Request For This Book.');
                    }

            }else{
                return Redirect::back()->with('statusError', 'The Book Has Already Been Borrowed.');
            }
        }else{
            return Redirect::back()->with('statusError', 'The Book Is Unavailable/Out Of Order.');
        }

    }

    public function showRequests(){
        $bookRequests = BookRequest::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(10);

        return view('user.user-requests', compact('bookRequests'));
    }

    public function requestPending(Request $request){
        $bookRequests = BookRequest::where('user_id', Auth::user()->id)
                                    ->where('status', '=', 'pending')
                                    ->orderBy('updated_at', 'desc')->paginate();

        return view('user.user-requests', compact('bookRequests'));
    }

    public function requestApproved(){
        $bookRequests = BookRequest::where('user_id', Auth::user()->id)
                                    ->where('status', '=', 'approved')
                                    ->orderBy('updated_at', 'desc')->paginate();

        return view('user.user-requests', compact('bookRequests'));
    }

    public function requestCancelled(){
        $bookRequests = BookRequest::where('user_id', Auth::user()->id)
                                    ->where('status', '=', 'cancelled')
                                    ->orWhere('status', '=', 'denied')
                                    ->orderBy('updated_at', 'desc')->paginate();

        return view('user.user-requests', compact('bookRequests'));
    }

    public function updateRequest(Request $request, BookRequest $bookRequest){
        if($request->status == 'cancel'){
            $bookRequest->update(['status'=> 'cancelled']);
        }
        return Redirect::route('user.requests')->with('status', 'You Successfully Cancelled Your Request');
    }

    public function destroyRequest(BookRequest $bookRequest){
        if(Auth::user()->id == $bookRequest->user_id){
            $bookRequest->delete();
        }

        return Redirect::route('user.requests')->with('status', 'You Successfully Deleted Your Request');
    }

    public function showBorrowBooks(BorrowBook $borrowBook){
        $borrowBooks = BorrowBook::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate();

        return view('user.user-borrowed', compact('borrowBooks'));
        
    }

}
