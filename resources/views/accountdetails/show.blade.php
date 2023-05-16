@extends('layouts.layout')
<style>
    .content-container {

        margin: 10px;
        padding: 0 0px 50px 0px;
        display: flex;
        flex-wrap: wrap;
    }
    .flex-box-row {
      width: auto;
      margin: 10px;
      height: 100px;
    }
    .flex-box-col{
      margin: 5px;
    }
    .account-details {

        width: 100%;
        height: 100%;
        padding: 50px;
    }
    .request-container{

        outline: solid 1px rgb(20, 6, 6);
        width: 100%;
        height: 48%;
        margin-bottom: 20px;
    }
    .approved-request-container{

        outline: solid 1px rgb(20, 6, 6);
        width: 100%;
        height: 48%;
        
    }
    .data{
      width: 100%;
      height: 80%;
    }
    .data, th, td{
      font-size: 12px;
      width: 15%;
    }
    .table, th{
      right: 5px;
    }
    .details-container{
      flex-grow: 1;
      width: 300px;
      margin: 10px;
      padding: 0px;
      height: 800px;
      background: #181D31;
      border-radius:20px;
    }
    .table-container{
      flex-grow: 1;
      width: 135vh;
      margin: 10px;
      padding: 0px;
      height: 800px;
      float: left;  
    }
    .msgNoData {
      margin-top: 50px; 
      margin-left:50px; 
      color:#81858c;
    }
    .title{
      text-align: center;
      background: red;
      color: white;
      margin:0px;
    }
    .form-group{
      margin-top: 20px;
    }
    .gray {
      border: 5px solid rgb(0, 0, 0);
      background: #808080;
    }
    .table::-webkit-scrollbar {
      display: none;
    } 
    </style>
    @section('contents')
        <div class="content-container">
          <div class="flex-box-row table-container">
              <div class="flex-box-col">
                <div class="request-container">
                  {{--fetch data from borrowers table
                      which represent request from this account
                      --}}
                      <h3 class="title">Request</h3>
                      <table class="table table-dark">                    
                        <thead>
                        <tr>
                          <th scope="col">Book_ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Contact</th>
                          <th scope="col">Role</th>
                          <th scope="col">Created_at</th>
                        </tr>
                        </thead>
                      </table>
    
                      <div class="table data" style="overflow-y:scroll;">
                        @if(count($borrowed_books) > 0)
                        <table class="table table-borderless data">                  
                            @foreach($borrowed_books as $borrowed_book)             
                            <tbody>
                              <tr>
                                <th >{{$borrowed_book->book_id}}</th>
                                <td>{{$borrowed_book->Name}}</td>
                                <td>{{$borrowed_book->Contact}}<br>{{$borrowed_book->Email}}</td>
                                <td>{{$borrowed_book->Occupation}}</td>
                                <td>{{$borrowed_book->created_at->format('Y-m-d')}}</td>
                              </tr>
  
                            </tbody>
                            @endforeach
                        </table>
                          @else
                          <h4 class="msgNoData">No request found</h4>
                          @endif
                        </div>
   

                  </div>
              </div>
            <div class="flex-box-col">
              <div class="approved-request-container"> 
              

                {{--fetch data from approved borrowers table
                    which represent approved request from this account
                    --}}
                    <h3 class="title">Approved Request</h3>
                    <table class="table table-dark">                    
                      <thead>
                      <tr>
                        <th scope="col">Book_ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Expected_return</th>
                        <th scope="col">Approved By</th>
                      </tr>
                      </thead>
                    </table>
                    <div class="table data" style="overflow-y:scroll;">
                        @if(count($approvedbooks) > 0)
                        <table class="table">
          
              
                            @foreach($approvedbooks as $approvedbook)             
                            <tbody>
                              <tr>
                                <td>{{$approvedbook->book_id}}</td>
                                <td>{{$approvedbook->Name}}</td>
                                <td>{{$approvedbook->Contact}}<br>{{$approvedbook->Email}}</td>
                                <td>{{$approvedbook->Occupation}}</td>
                                <td>{{$approvedbook->created_at->format('Y-m-d')}}</td>
                                <td>{{$approvedbook->due_date}}</td>
                                <td>{{$approvedbook->approvedBy}}</td>
                              </tr>
      
                            </tbody>
                            @endforeach
                          </table>
                          @else
                            <h4 class="msgNoData">No Approved Request Found</h4>
                          @endif
                    </div>
             </div>
            </div>
        
          </div>
                <div class="flex-box-row details-container">
                  <div class="account-details">
                                
                    {{--fetch data from students table
                        whichi represent the details of this account
                        --}}
        
                        {{--check if the account exist--}}
                        <h3 class="title gray">Account Data</h3>
                        @if($accDetails)
                        <div class="form-group">
                          <label for="name">User-ID</label>
                          <input type="text" class="form-control" value="{!!$accDetails->user_id!!}" readonly>
                        </div>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" value="{!!$accDetails->Name!!}" readonly>
                        </div>
                        <div class="form-group">
                          <label for="name">Role</label>
                          <input type="text" class="form-control" value="{!!$accDetails->Occupation!!}" readonly>
                        </div>
                        @if($accDetails->Occupation == 'Teacher')
                          <div class="form-group">
                            <label for="name">ID Number</label>
                            <input type="text" class="form-control" value="{!!$accDetails->ID_StudentNum!!}" readonly>
                          </div>
                        
                        @else 
                            <div class="form-group">
                            <label for="name">Student Number</label>
                            <input type="text" class="form-control" value="{!!$accDetails->ID_StudentNum!!}" readonly>
                          </div>

                        @endif
                        <div class="form-group">
                          <label for="name">Contact</label>
                          <input type="text" class="form-control" value="{!!$accDetails->Contact!!}" readonly>
                        </div>
                        <div class="form-group">
                          <label for="name">Email</label>
                          <input type="text" class="form-control" value="{!!$accDetails->Email!!}" readonly>
                        </div>
        
                        @else
                        <h4 class="msgNoData">No data</h4>
                        @endif
        
                    
                    </div>
    
                </div>
    
              
            </div>
   
 
    @endsection