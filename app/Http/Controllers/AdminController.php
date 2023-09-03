<?php

namespace App\Http\Controllers;


use App\Http\Requests\LibrarianUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    
    /**
     * Display Admin Dashboard
     */
    public function index(){
        return view('admin.index');
    }


    /**
     * Display All Librarian Accounts 
     */
    public function librarianAccounts(Request $request){

        // $librarians = DB::table('users')->where('role', 'librarian')->orderBy('first_name', 'asc')->paginate(10);
        // return view('admin.librarian-accounts',compact('librarians'));

        $librarians = User::where([
            ['role', '=', 'librarian'],
            [function ($query) use ($request){
                if(($librarian = $request->librarian)){
                    $query->where('first_name','LIKE','%'. $librarian.'%')
                        ->orWhere('last_name','LIKE','%'. $librarian.'%')
                        ->orWhere('email','LIKE','%'. $librarian.'%')
                        ->orWhere('phone','LIKE','%'. $librarian.'%')
                        ->orWhere('address','LIKE','%'. $librarian.'%')->get();                                     
                }
            }]
        ])->orderBy('first_name', 'asc')->paginate(10);      

        if(count($librarians)){
            return view('admin.librarian-accounts', compact('librarians'));
          
        }else{
            return Redirect::route('librarian.accounts')->with('message','No Librarian Found');
        } 
    }

    /**
     * Display Librarian Create Page
     */
    public function createLibrarian(){
        return view('admin.librarian-create');
    }

    /**
     * Storing New Librarian Account
     */
    public function storeLibrarian(UserStoreRequest $request){
        
        $librarian = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'librarian',

        ]);

        return  Redirect::route('librarian.create')->with('status', 'librarian-created');
    }

    /**
     * Display the selected librarian Account Information to Edit
     */
    public function editLibrarian(User $librarian){

        return view('admin.librarian-edit', compact('librarian'));
    }

    /**
     * Updating Librarian Account Information
     */
    public function updateLibrarian(LibrarianUpdateRequest $request, User $librarian){
        
        $librarian->update($request->validated());

        return Redirect::route('librarian.edit', $librarian)->with('status', 'librarian-updated');

    }

    /**
     * Deleting Librarian Account
     */
    public function destroyLibrarian(Request $request, User $librarian){
        
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        
        $librarian->delete();

        return Redirect::route('librarian.accounts');

    }

    /**
     * Display All User Accounts 
     */
    public function userAccounts(Request $request){

        // $users = DB::table('users')->where('role', 'user')->orderBy('first_name', 'asc')->paginate(10);
        // return view('admin.user-accounts',compact('users'));

        $users = User::where([
            ['role', '=', 'user'],
            [function ($query) use ($request){
                if(($user = $request->user)){
                    $query->where('first_name','LIKE','%'. $user.'%')
                        ->orWhere('last_name','LIKE','%'. $user.'%')
                        ->orWhere('email','LIKE','%'. $user.'%')
                        ->orWhere('phone','LIKE','%'. $user.'%')
                        ->orWhere('address','LIKE','%'. $user.'%')->get();                                     
                }
            }]
        ])->orderBy('first_name', 'asc')->paginate(10);      

        if(count($users)){
            return view('admin.user-accounts', compact('users'));
          
        }else{
            return  Redirect::route('user.accounts')->with('message','No User Found');
        } 


    }

    /**
     * Display User Create Page
     */
    public function createUser(){
        return view('admin.user-create');
    }

    /**
     * Storing New User Account
     */
    public function storeUser(UserStoreRequest $request){
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'user',

        ]);

        return  Redirect::route('user.create')->with('status', 'user-created');
    }

    /**
     * Display the selected librarian Account Information to Edit
     */
    public function editUser(User $user){

        return view('admin.user-edit', compact('user'));
    }

    /**
     * Updating Librarian Account Information
     */
    public function updateUser(UserUpdateRequest $request, User $user){
        
        $user->update($request->validated());

        return Redirect::route('user.edit', $user)->with('status', 'user-updated');

    }

    /**
     * Deleting Librarian Account
     */
    public function destroyUser(Request $request, User $user){
        
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        
        $user->delete();

        return Redirect::route('user.accounts');

    }

}
