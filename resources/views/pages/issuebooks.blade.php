@extends('layouts.layout')
<title>{{ 'Issued Books' }}</title>
<style>
    .content-container {
        padding: 0 50px 50px 50px;
    }
    .btn-container {
        display: flex;
        margin: 5px;
    }

    .btn-container .btn-default{
        background: green !important;
        text-decoration: none;
        color: white;
        position: relative;
        margin-right: 5px;
    }

</style>
    @section('contents')



    <div class="content-container">    
        <h1 style="margin-bottom: 50px; ">Issued Books</h1>
                        <tr>
                        @if (count($borrowers) > 0)

                                <table class="table table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>User-ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Student Number/ID Number</th>
                                            <th>Book-ID</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Operation</th>
            
                                        </tr>
                                    </thead>
                                    @foreach ($borrowers as $borrower)
                                        <tr>
                                            <input type="hidden" id="user_id" value ="{{$borrower->user_id}}">
                                            <input type="hidden" id="Name" value ="{{$borrower->Name}}">
                                            <input type="hidden" id="Occupation" value ="{{$borrower->Occupation}}">
                                            <input type="hidden" id="ID_StudentNum" value ="{{$borrower->ID_StudentNum}}">
                                            <input type="hidden" id="book_id" value ="{{$borrower->book_id}}">
                                            <input type="hidden" id="created_at" value ="{{$borrower->created_at}}">
                                            <td>{{$borrower->user_id}}</td>
                                            <td>{{$borrower->Name}}</td>
                                            <td>{{$borrower->Occupation}}</td>
                                            <td>{{$borrower->ID_StudentNum}}</td>
                                            <td>{{$borrower->book_id}}</td>
                                            <td>{{$borrower->Contact}}</td>
                                            <td>{{$borrower->Email}}</td>
                                            <td>{{ $borrower->created_at}}</td>        
                                            <td>  
                                                <div class="btn-container">

                            
                                                    {!! Form::open(['action' => ['App\Http\Controllers\BorrowerController@update', $borrower->id], 'method' => 'POST']) !!}
                                                    {{Form::hidden('_method', 'PUT')}}
                                                    {{Form::submit('approve', ['class' => 'btn btn-default'])}}
                                                    {!! Form::close() !!}

                                                    {!!Form::open(['action' => ['App\Http\Controllers\BorrowerController@destroy', $borrower->id],'method' => 'POST' ])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('reject',['onclick' => 'return confirm_delete()', 'class' => 'btn btn-danger deleteButton'] )}}
                                                    {!!Form::close()!!}
                                     


                                                    {{-- --}}
                                                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Reject Request</h1>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>{{$borrower->Name}}</h5>
                                                              <h5>Are you sure you want to reject request?</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                     
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                </div>          
                                            </td>
                                        </tr>
                                </tr>
                                @endforeach
                            </table>
                  
                @else
                    <h3 style="margin-top: 50px; margin-left:50px; color:#81858c">No request found</h3>
                @endif 
                <div class="paginator">
                    {{$borrowers->links()}}
                </div>
            </div>
  
    </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function(){
                $('.asdf').click(function(e){
                    e.preventDefault();
                    var Borrower_id = $(this).val();
                    $('#borrowerID').val();
                    $('#deleteModal').modal('show');
                });

            });
        </script>
        
        <script type="text/javascript">
            function confirm_delete() {
                $('.asdf').click(function(e){
                    e.preventDefault();

                });
                var userid = $( "#user_id" ).val();
                var name = $( "#Name" ).val();
                var role = $( "#Occupation" ).val();
                var Num = $( "#ID_StudentNum" ).val();
                var book_id = $( "#book_id" ).val();
                var date = $( "#created_at" ).val();
              return confirm("Are you sure you want to reject this request? \n" +
                              "user_id: "  +userid+ "\n" +
                              "\n"+ "Name:  "  +name+ "\n" +
                              "Occupation:  "  +role+ "\n" +
                              "ID:  "  +Num+ "\n" +
                              "book_id: "  +book_id+ "\n" +
                              "created_at:  "  +date+ "\n");
            }
            </script>

    @endsection