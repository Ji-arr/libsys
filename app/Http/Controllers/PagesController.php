<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\User;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function books(){
        return view('pages.books');
    }

    public function dashboard(){
        return view('pages.dashboard');
    }
    
    public function issuebooks(){
        return view('pages.issuebooks');
    }

    public function returnbooks(){
        return view('pages.returnbooks');
    }

    public function students(){
        return view('pages.students');
    }
}
