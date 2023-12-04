<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookCategory;
use App\Models\User;
use App\Models\BookLocation;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator; 

class BookController extends Controller
{

    private $cover;

    /**
     * Display books and display search results
     */
    public function index(Request $request){
        
        $users = User::where('role', '=', 'user')->get();
        $books = Book::orderBy('title', 'asc')->paginate(10);
        if($search = $request->search){
          $books = $this->searchBook($search);
          if(count($books) == 0){
            return Redirect::back()->with('statusError','No Book Found');
          }
        }
        return view('book.admin.index',compact('books', 'users'));
      
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
        $categories = Category::all();
        return view('book.admin.book-create', compact('authors','publishers','categories'));
    }

    /**
     * Store book
     */
    public function storeBook(BookStoreRequest $request, Author $author,  Publisher $publisher, Category $category, BookLocation $bookLocation){

        $author = $this->checkAuthor($request, $author);
        $publisher = $this->checkPublisher($request, $publisher);
        $category = $this->checkCategory($request, $category);

        if($request->hasFile('cover')) {
            $request->file('cover')->store('book_cover', 'public');
            $this->cover = $request->file('cover')->hashName();
        }
            
        $book = Book::create([
            'cover' => $this->cover,
            'title' => $request->title,
            'author_id' => $author->id,
            'isbn' => $request->isbn,
            'publisher_id' => $publisher->id,
            'publication_year' => $request->publication_year,
            'copies' => $request->copies ?? '1',

        ]);

        $bookLocation = BookLocation::create([
            'book_id' => $book->id,
            'call_number' => $request->call_number,
            'floor' => $request->floor,
            'shelf' => $request->shelf,
        ]);

        if($request->filled('category')) {
            BookCategory::create([
                'book_id' => $book->id,
                'category_id'=> $category->id,
            ]);
        }

        return Redirect::back()->with('status', 'Book Info Stored Successfully');

    }

     /**
     * Display selected book details and edit page
     */
    public function showBook(Book $book){
        return view('book.admin.book-show', compact('book'));

    }
    /**
     * Display selected book details and edit page
     */
    public function editBook(Book $book){

        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('book.admin.book-edit', compact('book','authors','publishers','categories'));

    }
    /**
     * Update book details
     */
    public function updateBook(BookUpdateRequest $request, Book $book, Author $author, Publisher $publisher, Category $category, BookLocation $bookLocation){
       
        $author = $this->checkAuthor($request, $author);
        $publisher = $this->checkPublisher($request, $publisher);
        $category = $this->checkCategory($request, $category);
       
        $book->update([
            'title' => $request->title,
            'author_id' => $author->id,
            'isbn' => $request->isbn,
            'publisher_id' => $publisher->id,
            'publication_year' => $request->publication_year,
            'copies' => $request->copies,
            'status' => $request->status
        ]);
        $bookLocation = BookLocation::where('book_id', $book->id);
        $bookLocation->update([
            'call_number' => $request->call_number,
            'floor' => $request->floor,
            'shelf' => $request->shelf,
        ]);

        if($request->filled('category')) {
            if(BookCategory::where('book_id', $book->id)
                ->where('category_id', $category->id)->count() == 0){
                BookCategory::create([
                    'book_id' => $book->id,
                    'category_id'=> $category->id,
                ]);
            }else{
                return redirect()->back()->withErrors(['category' => 'Category Already Added']);
            }
        }
        
        return Redirect::route('book.edit', $book)->with('status', 'Book Info Updated Successfully');
    }
 
    

    /**
     * Update Book Cover Photo
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
        return Redirect::route('book.edit', $book)->with('status', 'Book Cover Updated');
    }

    /**
     * Delete a Book 
     */
    public function destroyBook(Request $request, Book $book, Author $author, Publisher $publisher){
        
        $validated = Validator::make($request->all(), [
            'password' => ['required', 'current_password']
        ]);

        $author = Author::where('id', $book->author_id)->first();
        $publisher = Publisher::where('id', $book->publisher_id)->first();
      
        if($validated->fails()){
           
            return Redirect::back()->with('book', "$book->id")->withErrors($validated);
            
        }else{

            $imagePath = 'storage/book_cover/'. $book->cover;
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
            // Book Destroy
            $book->delete();
            
            //Check Author and Publisher before deleting
            if($author->books->count() === 0 && $publisher->books->count() === 0){
                $author->delete();
                $publisher->delete();
                return Redirect::route('book.index')->with('status', 'Book, Author and Publisher Deleted Successfully');
            }elseif($author->books->count() === 0 && $publisher->books->count() != 0){
                $author->delete();
                return Redirect::route('book.index')->with('status', 'Book and Author Deleted Successfully');
            }elseif($author->books->count() != 0 && $publisher->books->count() === 0){
                $publisher->delete();
                return Redirect::route('book.index')->with('status', 'Book and Publisher Deleted Successfully');
            }else{
                return Redirect::route('book.index')->with('status', 'Book Deleted Successfully');
            }
        }

          
       
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

    /**
     * Check Category if exists and create if not
     */
    protected function checkCategory($request, $category){

        $category = Category::where('name', '=', $request->category)->first();
        
        if($request->filled('category')) {
            if($category == null){
                $category = Category::create(['name' => $request->category]);
            }
        }
        return $category;
    }

    /**
     * Display all authors and searched results
     */
    public function authors(Request $request) {
        $authors = Author::with('books')->withCount('books')->orderBy('name', 'asc')->paginate(10);
        if($search = $request->search){
            $authors = Author::where(function ($query) use ($search){
                $query->where('name','LIKE',"%$search%");  

            })->with('books')->withCount('books')->paginate(10);
            if(count($authors) == 0){

                return Redirect::back()->with('statusError','No Author Found');
            }
        }
    
        return view('book.admin.authors', compact('authors'));
    }   

    /**
     * Edit Author Name
     */
    public function authorEdit(Author $author) {
        return view('book.admin.author-edit', compact('author'));
    }

    /**
     * Update Author Name
     */
    public function authorUpdate(Request $request, Author $author) {
        $validated = $request->validate(['name' => ['string', 'unique:authors,name,'.$author->id]]);
        $author->update($validated);

       return Redirect::route('author.edit', $author)->with('status', 'Author Updated Successfully');
    }

    /**
     * Destroy Author
     */
    public function authorDestroy(Author $author) {
        if($author->books->count() === 0){
            $author->delete();
            return Redirect::route('book.authors')->with('status', 'Author Deleted Successfully');
        }else{
            return Redirect::back()->with('statusError', 'Author Cannot Be Deleted Because It Has Book');
        }
       
    }
    
    /**
     * Display all publishers and searched results
     */
    public function publishers(Request $request) {

        $publishers = Publisher::with('books')->withCount('books')->orderBy('name', 'asc')->paginate(10);
        if($search = $request->search){
            $publishers = Publisher::where(function ($query) use ($search){
                $query->where('name','LIKE',"%$search%");  

            })->with('books')->withCount('books')->paginate(10);
            if(count($publishers) == 0){

                return Redirect::back()->with('statusError','No Publisher Found');
            }
        }

        return view('book.admin.publishers', compact('publishers'));
    }

    /**
     * Edit Publisher Name
     */
    public function publisherEdit(Publisher $publisher) {
        return view('book.admin.publisher-edit', compact('publisher'));
    }

    /**
     * Update Publisher Name
     */
    public function publisherUpdate(Request $request, Publisher $publisher) {
        $validated = $request->validate(['name' => ['string', 'unique:publishers,name,'.$publisher->id]]);
        $publisher->update($validated);

       return Redirect::route('publisher.edit', $publisher)->with('status', 'Publisher Updated Successfully');
    }

    /**
     * Destroy Publisher Name
     */
    public function publisherDestroy(Publisher $publisher) {
        
        if($publisher->books->count() === 0){
            $publisher->delete();
            return Redirect::route('book.publishers')->with('status', 'Publisher Deleted Successfully');

        }else{
            return Redirect::back()->with('statusError', 'Publisher Cannot Be Deleted Because It Has Book');
        }
    }

    /**
     * Display All Categories and Search Result 
     */
    public function categories(Request $request) {
        $categories = Category::orderBy('name', 'asc')->paginate(10);
        if($search = $request->search){
            $categories = Category::where(function ($query) use ($search){
                $query->where('name','LIKE',"%$search%");  

            })->paginate(10);
            if(count($categories) == 0){

                return Redirect::back()->with('statusError','No Category Found');
            }
        }

        return view('book.admin.categories', compact('categories'));
    }

    /**
     * Display Create Category Page 
     */
    public function createCategory() {
    
        return view('book.admin.category-create');
    }

    /**
     * Store Category
     */
    public function storeCategory(Request $request, Category $category){

        $request->validate([
            'name' => ['string','required']
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return Redirect::route('category.create')->with('status', 'New Category Created');
    }
    
    /**
     * Display Selected Category to Edit  
     */
    public function categoryEdit(Category $category) {

        return view('book.admin.category-edit', compact('category'));
    }

    /**
    * Update Selected Category  
    */
    public function categoryUpdate(Request $request, Category $category) {
        $validated = $request->validate(['name' => ['string']]);
        $category->update($validated);

       return Redirect::route('category.edit', $category)->with('status', 'Category Updated Successfully');
    }

    /**
    * Delete/Destroy Selected Category  
    */
    public function categoryDestroy(Category $category) {
        $category->delete();

        return Redirect::route('book.categories')->with('status', 'Category Deleted Successfully');
    }

    /**
    * Delete/Destroy Category added to a book  
    */
    public function bookCategoryDestroy(Book $book,BookCategory $bookCategory) {
        $bookCategory->delete();

        return Redirect::back()->with('status', 'Book Category Deleted Successfully');
    }



    
}
