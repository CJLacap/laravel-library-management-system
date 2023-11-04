<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRequest;
use App\Models\BorrowBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BorrowBookController extends Controller
{
    public function index(Request $request){
       
        $borrowBooks = BorrowBook::orderBy('status')->orderBy('due_at')->paginate(10);
        if(Route::is('borrowed')){
            $borrowBooks = BorrowBook::where('status','=','borrowed')->orderBy('due_at')->paginate(10);
        }elseif(Route::is('returned')){
            $borrowBooks = BorrowBook::where('status','=','returned')->orderBy('due_at')->paginate(10);
        }

        if($search = $request->search){
            $borrowBooks = $this->searchBorrowed($search);
            if(count($borrowBooks) == 0){
              return Redirect::back()->with('statusError','No Borrowed Book Found');
            }
        }

        return view('borrowed.index', compact('borrowBooks')); 
      
    }


    public function searchBorrowed($search){
        return BorrowBook::where(function ($query) use ($search){
            $query->where('due_at','LIKE',"%$search%");
           
        })
        ->orWhereHas('book', function ($query) use ($search){
            $query->where('title','LIKE',"%$search%")
            ->orWhere('isbn','LIKE',"%$search%")
            ->orWhere('publication_year','LIKE',"%$search%");
        })
        ->orWhereHas('user', function ($query) use ($search){
            $query->where('first_name','LIKE',"%$search%")
            ->orWhere('last_name','LIKE',"%$search%")
            ->orWhere(DB::raw("concat(first_name,' ',last_name)"), 'LIKE', '%'. $search.'%')
            ->orWhere('email','LIKE',"%$search%")
            ->orWhere('phone','LIKE',"%$search%");
        })
        ->orWhereHas('librarian', function ($query) use ($search){
            $query->where('first_name','LIKE',"%$search%")
            ->orWhere('last_name','LIKE',"%$search%")
            ->orWhere(DB::raw("concat(first_name,' ',last_name)"), 'LIKE', '%'. $search.'%');
        })
        ->orWhereHas('book.author', function ($query) use ($search){
            $query->where('name','LIKE',"%$search%");
        })
        ->orWhereHas('book.publisher', function ($query) use ($search){
            $query->where('name','LIKE',"%$search%");

        })->paginate(10);  
    }

    public function store(Request $request, BookRequest $bookRequest, Book $book){
     
       
        $validated = Validator::make($request->all(),[
            'user' => ['sometimes','required', Rule::exists('users','email')],
            'return_date' => ['required', 'date', 'after:today']
        ]);
    
        if($validated->fails() && $request->bookRequest != null ){
            return Redirect::back()->with('bookBorrowReq', "$bookRequest->id")->withErrors($validated);
            
        }elseif($validated->fails() && $request->book != null ){
            return Redirect::back()->with('bookBorrow', "$book->id")->withErrors($validated);
            
        }

        if($request->bookRequest != null){
            if($bookRequest->book->copies - $bookRequest->book->borrowBooks->count() != 0){
              
                BorrowBook::create([
                    'user_id' => $bookRequest->user->id,
                    'book_id' => $bookRequest->book->id,
                    'librarian_id' => Auth::user()->id,
                    'status' => 'borrowed',
                    'due_at' => $request->return_date,
                    'remarks' => $request->remarks,
                ]);

                $bookRequest->delete();
                return Redirect::back()->with('status', 'Book Borrowed Successfully');
                    
            }else{
                return Redirect::back()->with('statusError', 'The Book Has Already Been Borrowed.');
            }

        }elseif($request->book != null){
            if($book->copies - $book->borrowBooks->count() != 0){
               
                $user = User::where('email', '=', $request->user)->first();
                BorrowBook::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'librarian_id' => Auth::user()->id,
                    'status' => 'borrowed',
                    'due_at' => $request->return_date,
                    'remarks' => $request->remarks,
                ]);

                return Redirect::back()->with('status', 'Book Borrowed Successfully');

            }else{
                return Redirect::back()->with('statusError', 'The Book Has Already Been Borrowed.');
            }

        }else{

            return Redirect::back();
        }
    }

    public function returnedBook(BorrowBook $borrowBook){
        if($borrowBook->status == 'borrowed'){
            $borrowBook->update([
                'status' => 'returned',
                'librarian_id' => Auth::user()->id,
                'returned_at' => now(),
            ]);

            return Redirect::back()->with('status', 'Book Returned Successfully');
        }else{
            
            return Redirect::back()->with('statusError', 'Book Already Been Returned');
        }
        
    }
}
