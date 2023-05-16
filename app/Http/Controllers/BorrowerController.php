<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrower;
use App\Models\Student;
use App\Models\Book;
use App\Models\ApprovedBorrower;
use App\Models\User;
use App\Models\History;

use DateInterval;
use DateTime;

class BorrowerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin'],['except' => ['store', 'fetch']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $borrowers = Borrower::orderBy('updated_at', 'desc')->paginate(10);
        return view('pages.issuebooks')->with('borrowers', $borrowers);
    }

    //display approved borrowerss
    public function approvedBorrower()
    {
        //
        $approved_borrowers = ApprovedBorrower::orderBy('updated_at', 'desc')->paginate(10);
        return view('pages.returnbooks')->with('approved_borrowers', $approved_borrowers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'name' => 'required',
            'role' => 'required',
            'contact' => 'required',
            'email' => 'required'
        ]);

        if($request->input('role') == 'Student'){
            $this->validate($request,[
                'StudentNumber' => 'required',
                'IDNumber' => 'nullable',
            ]); 
            $numberToStore = $request->input('StudentNumber');
        } else {
            $this->validate($request,[
                'StudentNumber' => 'nullable',
                'IDNumber' => 'required',
            ]); 
            $numberToStore = $request->input('IDNumber');
        };


        //check if user is admin
        if(Auth::user()->role == '1') {
            $useridToStore = $request->input('idsearch');
        }
        else {
            $useridToStore = auth()->user()->id;
        }

          //create new borrower in students table
        $borrower = new Borrower;
        $borrower->book_id = $request->input('bookid');
        $borrower->Name = $request->input('name');
        $borrower->Occupation = $request->input('role');
        $borrower->ID_StudentNum = $numberToStore;
        $borrower->Contact = $request->input('contact');
        $borrower->Email = $request->input('email');
        $borrower->user_id = $useridToStore;


        //add data to histories table
        $history = new History;
        $history->Name = $borrower->Name;
        $history->Occupation = $borrower->Occupation;
        $history->ID_StudentNum = $borrower->ID_StudentNum;
        $history->Contact = $borrower->Contact;
        $history->Email = $borrower->Email;
        $history->book_id = $borrower->book_id;
        $history->user_id = $borrower->user_id;
        $history->type_of_request = 'book request';
        $history->approved_by = auth()->user()->id;

        //to check if user exist
        $findUserByUserID = User::find($useridToStore);

        if($findUserByUserID){
            $history->save();
            $borrower->save();
            return redirect('/books')->with('success', 'Request sent! Go to CVSU Silang Library to get the issued book');
        }
        else {
            return redirect('/books')->with('error', 'Invalid User-ID, Account is not existing');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        //find borrower by ID
        $borrowers = Borrower::find($id);
        $bookid = $borrowers->book_id;
        //find book to update using relationship model
        $book = Book::find($bookid);
        if($book == false || $book->quantity <= 0){
            return redirect('/issuebooks')->with('error', 'No available copy');
        }
        else {
            $findApprovedRequest = ApprovedBorrower::where('book_id', $bookid)->where('user_id', $borrowers->user_id)->first();

            //update book quantity
            $book->quantity = $book->quantity-1;

            $book->updated_at = $book->updated_at;

            //create approved borrower
            $approved_borrowers = new ApprovedBorrower;
            $approved_borrowers->user_id = $borrowers->user_id;
            $approved_borrowers->Name = $borrowers->Name;
            $approved_borrowers->book_id = $borrowers->book_id;
            $approved_borrowers->Occupation = $borrowers->Occupation;
            $approved_borrowers->IDNum_studentNum = $borrowers->ID_StudentNum;
            $approved_borrowers->Contact = $borrowers->Contact;
            $approved_borrowers->Email = $borrowers->Email;
            $approved_borrowers->due_date = $borrowers->created_at->add(new DateInterval('P5D'));
            $approved_borrowers->approvedBy = auth()->user()->id;

             //create new student in students table
            $student = new Student;
            $student->user_id = $borrowers->user_id;
            $student->Name = $borrowers->Name;
            $student->Occupation = $borrowers->Occupation;
            $student->ID_StudentNum = $borrowers->ID_StudentNum;
            $student->Contact = $borrowers->Contact;
            $student->Email = $borrowers->Email;
            
            //add data to histories table
            $history = new History;
            $history->Name = $borrowers->Name;
            $history->Occupation = $borrowers->Occupation;
            $history->ID_StudentNum = $borrowers->ID_StudentNum;
            $history->Contact = $borrowers->Contact;
            $history->Email = $borrowers->Email;
            $history->book_id = $borrowers->book_id;
            $history->user_id = $borrowers->user_id;
            $history->type_of_request = 'approve request';
            $history->approved_by = $approved_borrowers->approvedBy;

        
            if($findApprovedRequest){
                return redirect('/issuebooks')->with('error', 'Borrower already have a copy of book');
            }
            else {
                       // check if the student Exists.
                $findStudent = Student::where('user_id', $student->user_id)->first();
                $history->save();
                $approved_borrowers->save();
                $borrowers->delete();
                $book->save();
                if($findStudent) {
                    //don't save student;
                    return redirect('/issuebooks')->with('success', 'Approved');
                }else {
                    $student->save();
                    return redirect('/issuebooks')->with('success', 'Approved')
                                                    ->with('status', 'Profile updated!');
                }
  


            }

        }
   
    }


    public function returnUpdate($id)
    {
        $approved_borrowers = ApprovedBorrower::find($id);
        $bookid = $approved_borrowers->book_id;
        $book = Book::find($bookid);
 
        $history = new History;
        $history->Name = $approved_borrowers->Name;
        $history->Occupation = $approved_borrowers->Occupation;
        $history->ID_StudentNum = $approved_borrowers->IDNum_studentNum;
        $history->Contact = $approved_borrowers->Contact;
        $history->Email = $approved_borrowers->Email;
        $history->book_id = $bookid;
        $history->user_id = $approved_borrowers->user_id;
        $history->type_of_request = 'return book';
        $history->approved_by = auth()->user()->id;
        $findBorrower = ApprovedBorrower::where('book_id', $approved_borrowers->book_id)->first();
        if($book == false || $book->quantity <= 0 ){
                $history->save();
                $findBorrower->delete();
                return redirect('/returnbooks')->with('error', 'Cannot find the book')
                                               ->with('status', 'Book return is recorded');
        }else{
  

                        //update book quantity
                        $book->quantity = $book->quantity+1;

                        $book->updated_at = $book->updated_at;
    

        //add data to histories table


                $findBorrower->delete();
                $book->save();
                $history->save();
                return redirect('/returnbooks')->with('success', 'Approved');
        }


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                //Delete Book
                $borrowers = Borrower::find($id);
                $borrowers->delete();
                return redirect('/issuebooks')->with('error', 'Request Rejected');
    }

/*
    public function fetch(Request $request)

    {
        if($request->ajax()){
            $query = $request->get('query');
            $students = Student::all();
            $output = '<ul class="dropdown-menu" style="display:block !important; position:relative; background:red;">';
            foreach($students as $row){
                $output .= '<li><a href="">'.$row->Name.'</a></li>';
            }
            $output .= '</ul>';
        }
        echo $output;
    }

    public function getStudents($id)
    {
        if(empty($id)){
            return [];
        }
        $students = Student::all()
                ->limit(25)
                ->get();

        return $students;
    }


    public function borrerss()
    {
        $user_id = auth()->user()->id;
        $user = ApprovedBorrower::find($user_id);
        return view('pages.dashboard')->with('approvedBorrowers', $user->approvedBorrowers);
    }
        */
}
