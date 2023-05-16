<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ApprovedBorrower;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $date = date('2023-01-21');
        $approvedBorrowers = ApprovedBorrower::where('approvedBy', 'LIKE', '%'.$user_id.'%')->get();
        
            return view('pages.dashboard')->with('borrowed_books', $user->borrowed_books)
                                          ->with('accDetails', $user->accDetails)
                                          ->with('approvedbooks', $user->approvedbooks)
                                          ->with('approvedBorrowers',$approvedBorrowers)
                                          ->with('date', $date);
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('accountdetails.show')->with('borrowed_books', $user->borrowed_books)
                                          ->with('accDetails', $user->accDetails)
                                          ->with('approvedbooks', $user->approvedbooks);
    }
}
