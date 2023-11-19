<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRequest;
use App\Models\BorrowBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class BookRequestController extends Controller
{
    public function index(Request $request){
    
        $bookRequests = BookRequest::orderBy('status')->paginate(10);

        if(Route::is('pending')){
            $bookRequests = BookRequest::where('status', '=', 'pending')->paginate(10);
        }elseif(Route::is('approved')){
            $bookRequests = BookRequest::where('status', '=', 'approved')->paginate(10);
        }elseif(Route::is('cancelled')){
            $bookRequests = BookRequest::where('status', '=', 'cancelled')
                                    ->orWhere('status', '=', 'denied')->paginate(10);
        }
        
        if($search = $request->search){
            $bookRequests = $this->searchRequest($search);
            if(count($bookRequests) == 0){
              return Redirect::back()->with('statusError','No Request Found');
            }
        }
        return view('book_request.requests', compact('bookRequests'));
        
    }

   

    public function searchRequest($search){
        return BookRequest::where(function ($query) use ($search){
            $query->where('remarks','LIKE',"%$search%");
           
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
        ->orWhereHas('book.author', function ($query) use ($search){
            $query->where('name','LIKE',"%$search%");
        })
        ->orWhereHas('book.publisher', function ($query) use ($search){
            $query->where('name','LIKE',"%$search%");

        })->paginate(10);  

    }

    public function viewRequest(BookRequest $bookRequest){
        return view('book_request.show', compact('bookRequest'));
    }

    public function updateStatus(Request $request, BookRequest $bookRequest, Book $book){

        
        if($request->status == null && $request->has('remarks')){
            $bookRequest->update([
                'librarian_id' => Auth::user()->id,
                'remarks' => $request->remarks
            ]);
            return Redirect::back()->with('status', "Remarks Save Successfully  {$request->status}.");
        }
        if($bookRequest->book->copies - $bookRequest->book->borrowBooks->count() == 0 && $request->status == 'approved'){
            return Redirect::back()->with('statusError', 'The Book Has Already Been Borrowed.');
        }
        if($request->status == $bookRequest->status){
            return Redirect::back()->with('statusError', "The Request Has Already Been {$bookRequest->status}.");
        }
 
        if($request->has('password')){
            $validated = Validator::make($request->all(), [
                'password' => ['required', 'current_password'],
                'remarks'
               ]);
            
            if($validated->fails()){
                return Redirect::back()->with('bookReqStatus', "$bookRequest->id")->withErrors($validated);

            }else{
                
                $bookRequest->update([
                    'status'=> $request->status,
                    'librarian_id' => Auth::user()->id,
                    'remarks' => $request->remarks
                ]);
                return Redirect::back()->with('status', "The request has been successfully {$request->status}");
            }
        }else{
            
            $bookRequest->update([
                'status'=> $request->status,
                'librarian_id' => Auth::user()->id,
                'remarks' => $request->remarks
            ]);
            return Redirect::back()->with('status', "The request has been successfully {$request->status}.");

        }                    
    }
    
    public function destroyRequest(Request $request, BookRequest $bookRequest){

    $validated = Validator::make($request->all(), [
        'password' => ['required', 'current_password']
       ]);

       if($validated->fails()){
       
        return Redirect::back()->with('br', "$bookRequest->id")->withErrors($validated);
        
       }else{
            $bookRequest->delete();
            return Redirect::route('request.index')->with('status', 'Request Deleted Successfully');
       }
    }
    
   
   
}
