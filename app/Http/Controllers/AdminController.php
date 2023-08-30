<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function librarianAccounts(){

        $librarians = DB::table('users')->where('role', 'librarian')->orderBy('first_name', 'desc')->paginate(10);
        return view('admin.librarian-accounts',compact('librarians'));


    }
}
