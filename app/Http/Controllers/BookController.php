<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin'],['except' => ['search', 'index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'asc')->paginate(12);
        return view('pages.books')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'book_image' => 'image|nullable|max:1999',
            'author' => 'required',
            'quantity' => 'required|integer'
        ]);



        //handle file
        if($request->hasFile('book_image')){

            //Get filename with ext
            $filenameWithExt = $request->file('book_image')->getClientOriginalName();
            //Get filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get file ext
            $extension = $request->file('book_image')->getClientOriginalExtension();
            //File to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('book_image')->storeAs('public/book_images', $filenameToStore);    
        } else {
            $filenameToStore = 'noimage.jpg';
        };
        
       //Random Color Generator
        $color = substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        $colorSlash = '#';

        //Post Book
        $book = new Book;
        $book->title = $request->input('title');
        $book->color = $colorSlash.$color;
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->quantity = $request->input('quantity');
        $book->user_id = auth()->user()->id;
        $book->book_image = $filenameToStore;
        $book->save();
        return redirect('/books')->with('success', 'Book Posted');

        //optional -> to check book if exist
        /*
        $findbook = Book::where('title', 'LIKE', '%'.$book->title.'%')->get();
        if($findbook){
            return redirect('/books')->with('error', 'Book Exist');
        }else {
            $book->save();
            return redirect('/books')->with('success', 'Book Posted');
        }
        */


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()) {

            $user_id = auth()->user()->id;
            $user = User::find($user_id);

            $book = Book::find($id);

                return view('books.show')->with('book', $book)
                                         ->with('student',$user->accDetails);
        }
        else {
            $book = Book::find($id);
            return view('books.show')->with('book', $book);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit')->with('book', $book);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer'
        ]);
        
        if($request->hasFile('book_image')){

            //Get filename with ext
            $filenameWithExt = $request->file('book_image')->getClientOriginalName();
            //Get filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get file ext
            $extension = $request->file('book_image')->getClientOriginalExtension();
            //File to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('book_image')->storeAs('public/book_images', $filenameToStore);    
        }

        //Update Book

        $book = Book::find($id);
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->user_id = auth()->user()->id;
        if($request->hasFile('book_image')){
            $book->book_image = $filenameToStore;
        }
        $book->save();

        return redirect('/books')->with('success', 'Book Updated');
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
        $book = Book::find($id);

        if($book->book_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/book_images/'.$book->book_image);
        }
        $book->delete();
        return redirect('/books')->with('success', 'Book Removed');
    }



    //book search by title, author, description
    public function search(Request $request)
    {
        //Search Book
        if(isset($_GET['query'])){
            
            $search_text = $_GET['query'];
            $books = Book::where('title', 'LIKE', '%'.$search_text.'%')
                         ->orWhere('author', 'LIKE', '%'.$search_text.'%')
                         ->orWhere('description', 'LIKE', '%'.$search_text.'%')->paginate(12);
                         
            $books->appends($request->all());
            return view('pages.books')->with('books', $books); 
        }
        else
        {
            return view('pages.books')->with('books', $books);  
        }
    }

    public function bookmanagement()
    {
        $books = Book::orderBy('id', 'asc')->paginate(12);
        return view('books.bookmanager')->with('books', $books);
    }

    public function delete($id)
    {
        //Delete Book
        $book = Book::find($id);

        if($book->book_image != 'noimage.jpg'){

            //delete image from file
            Storage::delete('public/book_images/'.$book->book_image);
        }
        $book->delete();
        return redirect('/book-management')->with('success', 'Book Removed');
    }

    //live search function for admin //bookmanager.blade
    public function adminsearch(Request $request)
    { 
        //Search Book
        if($request->ajax()){
            if($request->adminsearch){
                $data = Book::where('title', 'LIKE', '%' .$request->adminsearch. '%')
                ->orWhere('description', 'LIKE', '%' .$request->adminsearch. '%')
                ->orWhere('author', 'LIKE', '%'.$request->adminsearch. '%')->limit(5)->get();

            $output = '';
            if(count($data)>0){

                        foreach($data as $row){
                            $output .='
                            <tr>
                            <td>'.$row->id.'</td>
                            <td scope="row">'.$row->title.'</td>
                            <td>'.$row->author.'</td>
                            <td>'.$row->description.'</td>
                                <td style="width:130px;">             
                                <div class="flex-con" style="display: flex; grid-gap: 1rem;">
                                <a href="/books/'.$row->id.'/edit" class="btn btn-default" style="background: green; width: 70px; color:azure;">Edit</a>
                                <a href="books.delete/'.$row->id.'" class="btn btn-danger" style="background: DE0404; width: 70px; color:azure;">Delete</a>             
                                </div>
                                </td>
                            </td>
                            </tr>
                            ';
                        }

            }
            else{

                $output .='No results';

            }

            return response($output);
            }
      
          }
    }


}