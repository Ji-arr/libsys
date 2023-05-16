@extends('layouts.layout')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('js/jqueryui/jquery-ui.min.css')}}" defer>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{asset('js/jquery-3.6.1.min.js')}}" defer type="text/javascript"></script>
    <script src="{{asset('js/jqueryui/jquery-ui.min.js')}}" defer type="text/javascript"></script>

<style>
    .page {
        margin: 0px;
        padding-right: 100px;
        padding-left: 100px;
        width: 100%;
        position: relative;
        display: flex;
        justify-content: center;
    }
    .book-details {
        margin-left: 30px;
        position: relative;
        height: 500px;
        width: 400px;
        box-shadow: 2px 2px 6px rgba(0,0,0,2);
        display: flex;
        flex-direction: column;
        background-color: #00C0A3;
        word-wrap:break-word;
        padding-left: 30px; 
        border-radius: 5px;
    }
    .title-area {
        position: relative;
        width: fit-content;
        height: 50px;
        word-wrap:break-word;
        margin-top: 10px;
    }
    .author-area {
        position: relative;
        background: white;
        width: 100%;
        border-radius: 10px 4px 10px 4px;
        word-wrap:break-word;
        padding-left:10px;
  
    }
    .page a {
        position: relative;
        margin: 20px auto;
    }
    .page .description-area {
        margin-right: 30px;
        background: white;
        border-radius: 10px;
        position: relative;
        margin-top: 10px;
        width: auto;
        height: 100%;

    }
    .book-details .btn-default0 {
        background: rgb(243, 243, 243) !important;
    }
    .photo {
        box-shadow: 2px 2px 6px rgba(0,0,0,2);
        margin-right: 30px;
        height: 500px;
        width: 400px;
        border-radius: 5px;
    }
    .photo img {
        box-shadow: 2px 2px 6px rgba(0,0,0,2);
        margin-right: 30px;
        height: 100%;
        width: 400px;
        border-radius: 5px;
    }
    .description-area h6{
        margin: 30px;
    }
    .book-details .btn-default {
        margin-top: 1%;
        align-self: center;
        background: #4B4453 !important;
        width: 50%;
        margin-bottom: 10px; 
        color:azure;
    }
    .btn-default:hover {
        background: rgb(9, 68, 9) !important;
        color:rgb(236, 245, 245)!important;
    }
    .btn-default0:hover {
        background: rgb(186, 192, 186) !important;
    }
    .d-none {
        display: none;
    }
    .flex {
        display: flex;
        flex-direction: row;
    }
    .flex label{
        width: 200px;
        height: 50px;
        background: #008F98;
        text-align: center;
        padding-top: 12px;
        border-radius: 30px 0 0 30px;
        margin-top: 5px;
    }
    h3 {
        -webkit-text-stroke: 0.1px black;
   color: white;
   text-shadow:
       1px 1px 0 #000,
     -1px -1px 0 #000,  
      1px -1px 0 #000,
      -1px 1px 0 #000,
       1px 1px 0 #000;
}
    }
</style>
    @section('contents')
    <div class="content-container">
    

        <div class="page">
            <div class="photo">
                <img src="/storage/book_images/{{$book->book_image}}" alt="Image" >
            </div>
            <div class="book-details" style="background:{{$book->color}};">
                <div class="flex">
                    <a href="/books" class="btn btn-default0" id="btn" style="margin-left: 0px;">Back</a>
                    <label> available copy/ies {{$book->quantity}}</label>
                </div>
                <div class="title-area">
                    <h3><strong>{{$book->title}}</strong></h3>
                </div>
                <div class="author-area">
                    <small>{{$book->author}}</small>
                </div>
                    <div class="description-area">
                        <h6>{!!$book->description!!}</h6>
                    </div>
                <small> Last modified {{$book->updated_at}} by {{$book->user->name}}</small>
                    @if($book->quantity <= 0) 
                        <button type="button" class="btn btn-default" data-toggle="modal" style="background: red !important">
                            Not Available
                        </button>
                    @else
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalLong">
                            Borrow
                        </button>
                    @endif
            </div>
              <!-- Modal -->
              <div class="modal fade ui.front" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    @if (!Auth::guest())
                        @if($student and Auth::user()->role == '0')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          
                          <form action="{{action('App\Http\Controllers\BorrowerController@store')}}" method="POST">
                              {{ csrf_field() }}
                              <div class="modal-body">
                                      <div class="form-group">
                                          <label for="contact">Book-ID</label>
                                          <input type="text" name="bookid" class="form-control" value="{!!$book->id!!}" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{!!$student->Name!!}" readonly>
                                      </div>
                                      
                              
                                      <div class="form-group">
                                            <label for="name">Role</label>
                                          <input type="text" name="role" class="form-control" value="{!!$student->Occupation!!}" readonly>
                                    </div>
                                    @if($student->Occupation == 'Student')
                                      <div class="form-group">
                                          <label for="STnumber">Student Number</label>
                                          <input type="text" name="StudentNumber" class="form-control" value="{!!$student->ID_StudentNum!!}" readonly>
                                      </div>
                                    @else
                                      <div class="form-group">
                                          <label for="IDnum">ID Number</label>
                                          <input type="text" name="IDNumber" class="form-control" value="{!!$student->ID_StudentNum!!}" readonly>
                                      </div>
                                    @endif
                                      <div class="form-group">
                                          <label for="contact">Contact</label>
                                          <input type="text" name="contact" class="form-control" value="{!!$student->Contact!!}" readonly>
                                      </div>
                                      <div class="form-group">
                                          <label for="contact">Email</label>
                                          <input type="text" name="email" id="" class="form-control" value="{!!$student->Email!!}" readonly>
                                      </div>
                              </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
          
                          </form>
                          @else
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="false">&times;</span>
                                </button>
                            </div>
                          
                          <form action="{{action('App\Http\Controllers\BorrowerController@store')}}" method="POST">
                              {{ csrf_field() }}
                              <div class="modal-body" id="modalWithAutC">
                                      <div class="form-group">
                                          <label for="contact">Book-ID</label>
                                          <input type="text" name="bookid" class="form-control" value="{!!$book->id!!}" readonly>
                                      </div>
                                      @if(Auth::user()->role == '1')
                                      <div class="form-group">
                                        <label for="contact">User-ID</label>
                                        <input type="text" name="idsearch" id="idsearch" placeholder="User-ID" class="form-control"> 
                                    </div>   
                                    @endif                         
                                     
                                     
                                      <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                      </div>
                
            
                                      <div class="form-group">
                                          <label for="exampleFormControlSelect1"></label>
                                          <select class="form-control" name="role" id="role" onchange="enableSNfield(this)">
                                              <option value="">Select Role</option>
                                              <option value="Teacher">Teacher</option>
                                              <option value="Student">Student</option>
                                          </select>
                                        </div>
                                      <div class="form-group d-none" id="studentNum">
                                          <label for="STnumber">Student Number</label>
                                          <input type="text" name="StudentNumber" id="sNum" class="form-control" placeholder="Student Number">
                                      </div>
                                      <div class="form-group d-none" id="idNumb">
                                          <label for="IDnum">ID Number</label>
                                          <input type="text" name="IDNumber" id="idNum" class="form-control" placeholder="ID Number">
                                      </div>
                                      <div class="form-group">
                                          <label for="contact">Contact</label>
                                          <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact">
                                      </div>
                                      <div class="form-group">
                                          <label for="contact">Email</label>
                                          <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                      </div>
                              </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
          
                          </form>
                          @endif
                        @else 
                    <form>
                        <div class="modal-body">
                            <br>
                            <br>
                            <h3 style="text-align: center;">Login first to request book</h3>
                            <br>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <a href="/login"><button type="button" class="btn btn-outline-info btn-lg  me-sm-3 fw-bold" style="left: 100px; ">Login</button></a>
                            <a href="/register"><button type="button" class="btn btn-outline-info btn-lg  me-sm-3 fw-bold" style="right: 0px;">Register</button></a>
                        </div>
                    </form>
                    
                    @endif
                  </div>
                </div>
              </div>
    
    
        </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
{{--
    <script>
        $(document).ready(function(){
            $('#idsearch').on('keyup', function(){
                const searchInput = document.getElementById('#idsearch');
                var query = $(this).val();
                $.ajax({
                    url:"{{route('students.getStudents')}}",
                    type:"GET",
                    data:{'idsearch':query},
                    success:function(data){
                        $(#search_list').html(data)';
                        console.log(searchInput.value);
                    }
                });
            });
        });

    </script>
 --}}
 <script>
    function enableSNfield(answer){
       console.log(answer.value);
       if(answer.value == 'Student') {
           document.getElementById('studentNum').classList.remove('d-none');
           document.getElementById('idNumb').classList.add('d-none');
       } 
       else if(answer.value == 'Teacher') {
           document.getElementById('idNumb').classList.remove('d-none');
           document.getElementById('studentNum').classList.add('d-none');
       }
       else{
           document.getElementById('idNumb').classList.add('d-none');
           document.getElementById('studentNum').classList.add('d-none');
       }
   }
   
</script>

    <script>

        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
    
          $( "#idsearch" ).autocomplete({
            source: function( request, response ) {
              // Fetch data usig ajax request
              $.ajax({
                url:"{{route('students.getStudents')}}",
                type: 'get',
                dataType: "json",
                data: {
                   _token: CSRF_TOKEN,
                   search: request.term
                },
                success: function( data ) {
                    
                    response(data);
                    console.log(data);
                    
                }
              });
            },
            select: function (event, ui) {
                var role = ui.item.role;
                        if(role == 'Teacher'){
                            document.getElementById('idNumb').classList.remove('d-none');
                            document.getElementById('studentNum').classList.add('d-none');
                            $('#idNum').val(ui.item.iD_studetNum);
                        }
                        else {
                            document.getElementById('studentNum').classList.remove('d-none');
                            document.getElementById('idNumb').classList.add('d-none');
                            $('#sNum').val(ui.item.iD_studetNum);
                        }

               // Set selection
               $('#idsearch').val(ui.item.label), // display the selected text

                // save selected id to input
               $('#name').val(ui.item.name),
               $('#role').val(ui.item.role),
               $('#contact').val(ui.item.contact),  
               $('#email').val(ui.item.email); 
               return false;
            },
            // append to div container to display the suggestions from database
            appendTo: $("#modalWithAutC").parent()  
          });
    
        });
        </script>

        
        

{{--
<script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $("#idsearch").on('keyup', function(){
            var value = $(this).val();
            $.ajax({
                url: "{{route('students.getStudents')}}",
                type: "GET"
                data:{'name':value}{
                    success:function(data){
                        $("#id_list").html(data);
                    }
                }
            });
        });
    });
    </script>
    --}}

    @endsection
