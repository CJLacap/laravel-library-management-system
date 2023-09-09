<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 

class BookController extends Controller
{

    private $cover;

    /**
     * Display books and display search results
     */
    public function index(Request $request){

        $books = Book::orderBy('title', 'asc')->paginate(10);
        if($search = $request->search){
          $books = $this->searchBook($search);
          if(count($books) == 0){
            return Redirect::back()->with('message','No Book Found');
          }
        }
        return view('book.admin.index',compact('books'));
              
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
    
            })->paginate(10);  
    }

    /**
     * Display Book Create Page
     */
    public function createBook(){

        $authors = Author::all();
        $publishers = Publisher::all();
        return view('book.admin.book-create', compact('authors','publishers'));
    }

    /**
     * Store book
     */
    public function storeBook(BookStoreRequest $request, Author $author,  Publisher $publisher){

        $author = $this->checkAuthor($request, $author);
        $publisher = $this->checkPublisher($request, $publisher);

        if($request->hasFile('cover')) {
            $request->file('cover')->store('book_cover', 'public');
            $this->cover = $request->file('cover')->hashName();
        }
            
        Book::create([
            'cover' => $this->cover,
            'title' => $request->title,
            'author_id' => $author->id,
            'isbn' => $request->isbn,
            'publisher_id' => $publisher->id,
            'publication_year' => $request->publication_year,
            'copies' => $request->copies,

        ]);

        return Redirect::back()->with('status', 'book-created');

    }
    /**
     * Display selected book details and edit page
     */
    public function editBook(Book $book){

        $authors = Author::all();
        $publishers = Publisher::all();

        return view('book.admin.book-edit', compact('book','authors','publishers'));

    }
    /**
     * Update book details
     */
    public function updateBook(BookUpdateRequest $request, Book $book, Author $author, Publisher $publisher){

        $author = $this->checkAuthor($request, $author);
        $publisher = $this->checkPublisher($request, $publisher);


        $book->update([
            'title' => $request->title,
            'author_id' => $author->id,
            'isbn' => $request->isbn,
            'publisher_id' => $publisher->id,
            'publication_year' => $request->publication_year,
            'copies' => $request->copies,
        ]);
        

        return Redirect::route('book.edit', $book)->with('status', 'book-updated');
    }

    /**
     * Check Author if exists and create if not
     */
    public function updateCover(BookUpdateRequest $request, Book $book){

        if($request->hasFile('cover')) {
            $imagePath = 'storage/book_cover/'. $book->cover;
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
            
            $request->file('cover')->store('book_cover', 'public');
            $book->cover = $request->file('cover')->hashName();
        }
        $book->update();
        return Redirect::route('book.edit', $book)->with('status', 'book-cover-updated');
    }


    /**
     * Check Author if exists and create if not
     */
    protected function checkAuthor($request, $author){

        $author = Author::where('name', '=', $request->author)->first();
      
        if($author == null){
            $author = Author::create(['name' => $request->author]);
            
        }

        return $author;
    }
    /**
     * Check Publisher if exists and create if not
     */
    protected function checkPublisher($request, $publisher){

        $publisher = Publisher::where('name', '=', $request->publisher)->first();
      
        if($publisher == null){
            $publisher = Publisher::create(['name' => $request->publisher]);
         }

        return $publisher;
    }


    public function authors() {
        $authors = Author::with('books')->withCount('books')->orderBy('name', 'asc')->paginate(10);

        return view('book.admin.authors', compact('authors'));
    }

    public function authorEdit(Author $author) {
        return view('book.admin.author-edit', compact('author'));
    }

    public function authorUpdate(Request $request, Author $author) {
        $validated = $request->validate(['name' => ['string']]);
        $author->update($validated);

       return Redirect::route('author.edit', $author)->with('status', 'author-updated');
    }
    
    public function publishers() {

        $publishers = Publisher::with('books')->withCount('books')->orderBy('name', 'asc')->paginate(10);

        return view('book.admin.publishers', compact('publishers'));
    }

    public function publisherEdit(Publisher $publisher) {
        return view('book.admin.publisher-edit', compact('publisher'));
    }

    public function publisherUpdate(Request $request, Publisher $publisher) {
        $validated = $request->validate(['name' => ['string']]);
        $publisher->update($validated);

       return Redirect::route('publisher.edit', $publisher)->with('status', 'publisher-updated');
    }





    
}
