@extends('layouts.layout')
<title>{{ 'Dash Board' }}</title>
<style>
    .content-container {
        margin: 10px;
        padding: 0 0px 50px 0px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        
    }
    .flex-container{
            display: flex;
            flex-flow: wrap;
            justify-content: center;
            position: relative;
            align-items: center;
            grid-gap: 1rem;  
    }
    .flex-box {
        sposition: relative;
        padding: 1rem;
        box-shadow: 2px 2px 6px rgba(0,0,0,2);
        height: 150px;
        width: 300px;
    }

    /*user VIew*/
    .flex-box-row {
      width: auto;
      margin: 10px;
      height: 100px;
    }
    .flex-box-col{
      margin: 5px;
    }
    .account-details {

        outline: solid 1px rgb(20, 6, 6);
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
      width: 15%;
    }
    .details-container{
      flex-grow: 1;
      width: 300px;
      margin: 10px;
      padding: 0px;
      height: 800px;
      outline: solid 1px blueviolet;
      background: #181D31;
      border-radius:20px;
    }
    .table-container{
      flex-grow: 1;
      width: 135vh;
      margin: 10px;
      padding: 0px;
      height: 800px;
      outline: solid 1px blueviolet;
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
      color: white;
    }
    .gray {
      border: 5px solid rgb(0, 0, 0);
      background: #808080;
    }
    .table::-webkit-scrollbar {
      display: none;
    } 
    .flex-container a{
      text-decoration: none;
    }
    .flex-box .object-count {
      width: 80px;
      height: 80px;
      float:right;
      text-align: center;
      border-radius: 0 0 0 50px;
      margin: -15px;
      cursor: pointer;
      background: rgb(250, 240, 240);
      text-decoration: none;
    }

    a:hover:nth-child(1) .flex-box .object-count{
      transition: 1s all ease;
      width: 50%;
      height: 80%;
      background: #1911bd;
    }

    a:hover:nth-child(2) .flex-box .object-count{
      transition: 1s all ease;
      width: 50%;
      height: 80%;
      background: #7354c0;
      
    }
    a:hover:nth-child(3) .flex-box .object-count{
      transition: 1s all ease;
      width: 50%;
      height: 80%;
      background:  #1b755f;
    }
    a:hover:nth-child(4) .flex-box .object-count{
      transition: 1s all ease;
      width: 50%;
      height: 80%;
      background: #3dc0a6;
    }
    
    
    .objectq{
      color: black;
      font-size:50px;
    }
    .objectlabel{
      font-size: 20px;
      color: white;
    }
</style>
    @section('contents')
            <div class="content-container">
                @if(Auth::user()->role == '1')
         
                {{--Admin View--}}
                <div class="flex-container">
                  <a href="/returnbooks"><div class="flex-box" style="background: #5d57d4;" >
                        <div class="card-single">
                            <div class="card-flex">
                                <div class="card-head">
                                    <span class="objectlabel">TO RETURN</span>
                                     <div class="object-count">
                                         <small class="objectq">{{App\Models\ApprovedBorrower::count()}}</small> 
                                      </div>
                                </div>
                            </div>
                        </div>
                     </div></a>
    
        
                     <a href="/issuebooks"><div class="flex-box" style="background: #AE8FFF">
                            <div class="card-flex">
                                <div class="card-head">
                                  <span class="objectlabel">ISSUED BOOKS</span>
                                    <div class="object-count">
                                      <small class="objectq">{{App\Models\Borrower::count()}}</small>  
                                    </div>
                                </div>
                            </div>
                          </div></a>

    
     
                          <a href="/students"><div class="flex-box" style="background: #68BAA6">
                            <div class="card-flex">
                                <div class="card-head">
                                      <span class="objectlabel">STUDENTS</span>
                                      <div class="object-count">
                                        <small class="objectq">{{App\Models\Student::count()}}</small> 
                                      </div>
                                    
                                </div>
                              </div>
                        </div></a>


                        <a href="/book-management"><div class="flex-box" style="background: #005242">
                            <div class="card-flex">
                                <div class="card-head">
                                        <span class="objectlabel">BOOKS</span>
                                        <div class="object-count">
                                            <small class="objectq">{{App\Models\Book::count()}}</small> 
                                         </div>
                                </div>
                            </div>
                        </div></a>
                </div>

                  <div class="approved-request-container" style="margin:40px; height: 500px;"> 
                  
    
                    {{--fetch data from approved borrowers table
                        which represent approved request from this account
                        --}}
                        <h3 class="title">Approved Borrower Request</h3>
                        <table class="table table-dark">                    
                          <thead>
                          <tr>
                            <th scope="col">Book_ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Role</th>
                            <th scope="col">Expected_return</th>
                            <th scope="col">approved_By</th>
                          </tr>
                          </thead>
                        </table>
                        <div class="table data" style="overflow-y:scroll;">
                            @if(count($approvedBorrowers) > 0)
                            <table class="table">
              
                                @foreach($approvedBorrowers as $approvedBorrower)             
                                <tbody>
                                  <tr style="font-size:12px">
                                    <th scope="row">{{$approvedBorrower->book_id}}</th>
                                    <td>{{$approvedBorrower->Name}}</td>

                                    <td>{{$approvedBorrower->Contact}}<br>{{$approvedBorrower->Email}}</td>
                                    <td>{{$approvedBorrower->Occupation}}</td>
                                    @if($approvedBorrower->due_date <= $date)
                                      <td style="color:red; font-weight:700;">{{$approvedBorrower->due_date}}</td>
                                    @else
                                      <td>{{$approvedBorrower->due_date}}</td>
                                    @endif

                                    <td>{{$approvedBorrower->approvedBy}}</td>
                                  </tr>
          
                                </tbody>
                                @endforeach
      
                              </table>
                              @else
                                <h4 class="msgNoData">No Approved Request Found</h4>
                              @endif
                        </div>
                @else 


                {{--User View--}}
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
                              <table class="table">                  
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
                            </tr>
                            </thead>
                          </table>
                          <div class="table data" style="overflow-y:scroll;">
                              @if(count($approvedbooks) > 0)
                              <table class="table">
                
                    
                                  @foreach($approvedbooks as $approvedbook)             
                                  <tbody>
                                    <tr style="font-size:12px">
                                      <th scope="row">{{$approvedbook->book_id}}</th>
                                      <td>{{$approvedbook->Name}}</td>
                                      <td>{{$approvedbook->Contact}}<br>{{$approvedbook->Email}}</td>
                                      <td>{{$approvedbook->Occupation}}</td>
                                      <td>{{$approvedbook->created_at->format('Y-m-d')}}</td>
                                      <td>{{$approvedbook->due_date}}</td>
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
          

                @endif


            </div>


    @endsection