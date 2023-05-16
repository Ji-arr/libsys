@extends('layouts.layout')
<title>{{ 'Approved Request' }}</title>
<style>
    .content-container {
        padding: 0 50px 50px 50px;
    }
    .btn-default{
        background: green !important;
        text-decoration: none;
        color: white !important;
        position: relative;
        margin-right: 5px;
    }
    .form-group {
        margin: 10px;
    }
</style>

    @section('contents')
        <div class="content-container">
                    <h1>Approved Book Request</h1>
            @if (count($approved_borrowers) > 0)

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Student Number/ID Number</th>
                            <th>Book-ID</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Expected Book Return</th>
                            <th>Operation</th>

                        </tr>
                    </thead>
                    @foreach ($approved_borrowers as $approved_borrower)
                            <input type="hidden" id="user_id" value ="{{$approved_borrower->user_id}}">
                            <input type="hidden" id="Name" value ="{{$approved_borrower->Name}}">
                            <input type="hidden" id="Occupation" value ="{{$approved_borrower->Occupation}}">
                            <input type="hidden" id="ID_StudentNum" value ="{{$approved_borrower->IDNum_studentNum}}">
                            <input type="hidden" id="book_id" value ="{{$approved_borrower->book_id}}">
                            <input type="hidden" id="created_at" value ="{{$approved_borrower->created_at}}">
                            <input type="hidden" id="due_date" value ="{{$approved_borrower->due_date}}">
                        <tr>
                            <td>{{$approved_borrower->Name}}</td>
                            <td>{{$approved_borrower->Occupation}}</td>
                            <td>{{$approved_borrower->IDNum_studentNum}}</td>
                            <td>{{$approved_borrower->book_id}}</td>
                            <td>{{$approved_borrower->Contact}}</td>
                            <td>{{$approved_borrower->Email}}</td>
                            <td>{{$approved_borrower->created_at->format('Y-m-d')}}</td>
                            <td>{{$approved_borrower->due_date}}</td>      
                            <td>  
                                <div class="btn-container">
                                    {!! Form::open(['action' => ['App\Http\Controllers\BorrowerController@returnUpdate', $approved_borrower->id], 'method' => 'PUT']) !!}
                                    {{Form::submit('RETURN', ['onclick' => 'return confirm_delete()','class' => 'btn btn-danger bookreturn'])}}
                                    {!! Form::close() !!}

                                    {{--<button type="button" class="btn btn-danger returnBtn">RETURN</button>--}}

                                </div>          
                                </div>          
                            </td>
                        </tr>
                                            {{-- --}}
                                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">CONFIRMATION FOR BOOK RETURN</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="padding-left:50px;">
                                                        <div class="form-group">
                                                            <label><h5>Name: {{$approved_borrower->Name}}</h5></label>
                                                          </div>
                                                          <div class="form-group">
                                                            <label><h5>Book-ID: {{$approved_borrower->book_id}}</h5></label>
                                                          </div>
                                                          <div class="form-group">
                                                            <label><h5>Email: {{$approved_borrower->Email}}</h5></label>
                                                          </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                       
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                    @endforeach
                </tr>
                </table>
            @else
            <h3 style="margin-top: 50px; margin-left:50px; color:#81858c">No books to return</h3>
            @endif 
        </div>
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function(){
            $('.returnBtn').click(function(e){
                e.preventDefault();
                var Borrower_id = $(this).val();
                $('#borrowerID').val();
                $('#deleteModal').modal('show');
            });

        });
    </script>
            <script type="text/javascript">
                function confirm_delete() {
                    $('.bookreturn').click(function(e){
                        e.preventDefault();
    
                    });
                    var userid = $( "#user_id" ).val();
                    var name = $( "#Name" ).val();
                    var role = $( "#Occupation" ).val();
                    var Num = $( "#ID_StudentNum" ).val();
                    var book_id = $( "#book_id" ).val();
                    var date = $( "#created_at" ).val();
                    var due = $( "#created_at" ).val();
                  return confirm("Confirm Book return? \n" +
                                  "user_id: "  +userid+ "\n" +
                                  "\n"+ "Name:  "  +name+ "\n" +
                                  "Occupation:  "  +role+ "\n" +
                                  "ID:  "  +Num+ "\n" +
                                  "book_id: "  +book_id+ "\n" +
                                  "created_at:  "  +date+ "\n" +
                                  "due:  "  +due+ "\n");
                }
                </script>

@endsection