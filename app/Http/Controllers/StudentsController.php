<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class StudentsController extends Controller
{
   public function index()
   {
       //
       $Users = User::orderBy('updated_at', 'asc')->paginate(10);
       return view('pages.students')->with('Users', $Users);
   }

    public function getStudents(Request $request){


/*
      if($request->ajax()){
         $data = Student::where('user_id', 'LIKE', $request->idsearch. '%')->limit(5)->get();
         $output = '';
         $response = array();
         if(count($data)>0){

            $output ='
               <table class="table">
               <thead>
               <tr>
                   <th scope="col">Name</th>
                   <th scope="col">Account-ID</th>
                   <th scope="col">Role</th>
               </tr>
               </thead>
               <tbody>';
   
                   foreach($data as $row){
                       $output .='
                       <tr>
                       <th scope="row">'.$row->Name.'</th>
                       <td>'.$row->user_id.'</td>
                       <td>'.$row->Occupation.'</td>
                       </tr>
                       ';
                       $response[] = array("value"=>$row->Name,"label"=>$row->user_id);
                   }
   
   
   
            $output .= '
                </tbody>
               </table>';
   
   
   
       }
       else{
   
           $output .='No results';
   
       }
  
       return $output;
   
       }
     */
        $search = $request->search;
        $response = array();
        if($search == ""){
           $students = Student::orderby('Name','asc')->select('user_id','Name','Occupation','ID_StudentNum','Contact','Email')->limit(5)->get();
        }else{
           $students = Student::orderby('Name','asc')->select('user_id','Name','Occupation','ID_StudentNum','Contact','Email')->where('user_id', 'LIKE', '%' .$search . '%')->limit(5)->get();
        }
  
       
        foreach($students as $student){
         
           $response[] = array("name"=>$student->Name,"label"=>$student->user_id,"role"=>$student->Occupation,"iD_studetNum"=>$student->ID_StudentNum,"contact"=>$student->Contact,"email"=>$student->Email);
           
        }
  
        return response()->json($response);
    
     }

}
