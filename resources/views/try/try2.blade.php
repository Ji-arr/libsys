<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        .nav {
            background: #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 5%;
        }
        .sidebar {
            position: relative;
            top: 0px;
            left: 0px;
            width: 200px;
            height: 91.6vh;
            background: #111;
            transition: all 200ms linear;
        }
        .content-area {
        position: fixed;
        left: 0px;
        width: 100%;
        background: red;
        padding: 16px;
        transition: all 300ms linear;

        }
        .content-text {
            padding: 0 180px;
        }
        .nav .toggle-btn {
            position: relative;
            width: 25px;
            height: 25px;
            cursor: pointer;
            top: 0px;
        }
        .nav .toggle-btn span{
            position: absolute;
            width: 100%;
            height: 2px;
            background: white;
            transform: translateY(-50%);
            transition: all 300ms ease-in-out;
        }
        .nav .toggle-btn span:nth-child(1){
            top:10%;
        }
        .nav .toggle-btn span:nth-child(2){
            top:50%;
        }
        .nav .toggle-btn span:nth-child(3){
            top:90%;
        }
        .sidebar .links a{
            display: block;
            padding: 15px 10px;
            text-decoration: none;
            color: white;
            list-style: none;
            text-align: center;
            padding-bottom: 20px;
            padding-top: 20px;
        }
        .sidebar .links a.active,
        .sidebar .links a:hover {
            background: red;
            color:green;
        }
        .content-area.active{
            left: 200px;
            transition: all 200ms linear;
        }
        .sidebar.active {    /*important */
            left:-200px;
            transition: all 300ms linear;
        }
        .nav.close .toggle-btn span:nth-child(1){
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }
        .nav.close .toggle-btn span:nth-child(2){
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }
        .nav.close .toggle-btn span:nth-child(3){
            top: 50%;
            transform: translateY(-50%) rotate(-45deg);
        }


    </style>
    <header>
        <div class="nav">
            <div class="toggle-btn">                
                <span></span>
                <span></span>
                <span></span>
            </div>
    
            <img class="logo" src="#" alt="logo">
        </div>
    </header>
    <body>
        <div class="content-area">
            <div class="content text">
                <h2>header</h2>
                <p>this is paragraph area this is paragraa this is paragraph areathis is paragraph area</p>
            </div>
        </div>
        <div class="sidebar active">
                <div class="links">      
                    <a href="/dashboard">
                        <li class="fas-fa dashboard"> Dashboard</li>
                    </a>
                    <a href="/books">
                        <li class="fas-fa books"> Books</li>
                    </a>
                    <a href="/issuebooks">
                        <li class="fas-fa issuebooks"> Issue Books</li>
                    </a>
                    <a href="/returnbooks">
                        <li class="fas-fa returnbooks"> Return Books</li>
                    </a>
                    <a href="/students">
                        <li class="fas-fa students"> Students</li>
                    </a> 
                </div>
        </div> 

        <script>
            document.querySelector(".nav .toggle-btn").addEventListener("click",function(){
                document.querySelector(".sidebar").classList.toggle("active");
                document.querySelector(".nav").classList.toggle("close");
                document.querySelector(".content-area").classList.toggle("active");
            });
        </script>
    </body>
</html>