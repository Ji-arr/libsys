@extends('layouts.layout')
<script src="{{asset('js/jquery-3.6.1.min.js')}}" defer type="text/javascript"></script>
<script src="{{asset('js/jqueryui/jquery-ui.min.js')}}" defer type="text/javascript"></script>

<style>
    .page {
        margin: 0px;
        padding: 15px;
        width: 100%;
        position: relative;
        display: flex;
        background: rgb(167, 113, 113);
        justify-content: center;
    }
    .book-details {
        margin-left: 30px;
        position: relative;
        height: 500px;
        width: 75%;
        border: solid black;
        display: flex;
        flex-direction: column;
        background-color: aqua;
        word-wrap:break-word;
        padding: 10px; 
    }
    .book-details h1{
        word-wrap:break-word;
        
    }
    .title-area {
        border: solid red;
        position: relative;
        width: 100%;
        height: 50px;
        word-wrap:break-word;
        text-align: center;
    }
    .page a {
        position: relative;
        margin: 20px auto;
    }
    .page .description-area {
        margin-top: 10px;
        position: relative;
        border: solid red;
        width: 100%;
        height: 100%;
        align-items: center;
        padding: 20px;

    }
    .book-details .btn-default0 {
        background: rgb(243, 243, 243) !important;
    }
    .photo img {
        margin-right: 15px;
        height: 300px;
        width: 200px;
    }
    .description-area h6{
        text-align: center;
        margin: 30px;
    }
    .book-details .btn-default {
        margin-top: 1%;
        align-self: center;
        background: green !important;
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
</style>
    @section('contents')
    <div class="page">
            
          <!-- Modal -->
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
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
                              <label for="name">Name</label>
                              <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                              <div class="studetList"></div>
                            </div>
      
    
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"></label>
                                <select class="form-control" name="occupation" id="occupation" onchange="enableSNfield(this)">
                                    <option value="">Select</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Student">Student</option>
                                </select>
                              </div>
                            <div class="form-group d-none" id="studentNum">
                                <label for="STnumber">Student Number</label>
                                <input type="text" name="StudentNumber" class="form-control" placeholder="Student Number">
                            </div>
                            <div class="form-group d-none" id="idNumb">
                                <label for="IDnum">ID Number</label>
                                <input type="text" name="IDNumber" class="form-control" placeholder="ID Number">
                            </div>
                            <div class="form-group">
                                <label for="contanct">Contact</label>
                                <input type="text" name="contact" class="form-control" placeholder="Contact">
                            </div>
                            <div class="form-group">
                                <label for="contact">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>

                </form>

                <form>
                    <div class="modal-body">
                        <br>
                        <br>
                        <h3 style="text-align: center;">Must have an account to borrow book</h3>
                        <br>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <a href="/login"><button type="button" class="btn btn-outline-info btn-lg  me-sm-3 fw-bold" style="left: 100px; ">Login</button></a>
                        <a href="/register"><button type="button" class="btn btn-outline-info btn-lg  me-sm-3 fw-bold" style="right: 0px;">Register</button></a>
                    </div>
                </form>
                

              </div>
            </div>
          </div>


    </div>


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
   <!--



    <script>
        $(document).ready(function(){
            
            $('#name').autocomplete({
                source: function(request, cb){
                    $.ajax({
                        url: '/books'+ '/get-students',
                        method: 'GET',
                        dataType: 'json',
                        success: function(res){
                            var result;
                            result = [
                            {
                                label: 'There is matching record found for' +request.term,
                                value: ''
                            }
                        ];

                        console.log(res);

                        if(res.length){
                            result = $.map(res, function(obj){
                                return {
                                    label: obj.id,
                                    value: obj.id,
                                    data: obj
                                };
                            });
                        }
                        cb(result);
                        }
                    });

                },
                select:function(e, selectedData){
                    console.log(selectedData);

                }
            });
        });
    </script>
    -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">

        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
    
          $( "#name" ).autocomplete({
            source: function( request, response ) {
              // Fetch data
              $.ajax({
                url:"{{route ('students.getStudents')}}",
                type: 'post',
                dataType: "json",
                data: {
                   _token: CSRF_TOKEN,
                   search: request.term
                },
                success: function( data ) {
                   response( data );
                }
              });
            },
            select: function (event, ui) {
               // Set selection
               $('#name').val(ui.item.label); // display the selected text
               $('#').val(ui.item.value); // save selected id to input
               return false;
            }
          });
    
        });
        </script>
    @endsection
