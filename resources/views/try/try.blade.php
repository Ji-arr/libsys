<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>animated sidebar</title>
</head>

<script>

    var randomColor = Math.floor(Math.random()*16777215).toString(16);

    const setBg = () => {
    const randomColor = Math.floor(Math.random()*16777215).toString(16);
    document.flex-box.style.backgroundColor = "#" + randomColor;
    color.innerHTML = "#" + randomColor;

    }
    setBg();
</script>
<style>
    body {
        margin: 0;
        background: blue;
    }
    .sideMenu{
        height: 100%;
        padding-top: 60px;
        transition: 0.5s;
        overflow-x:hidden;
        background: linear-gradient(to bottom, orange, yellow);
        left:0 ;
        top: 0;
        z-index: 1;
        position: fixed;
        width: 0px;
    }
    .maine-menu h2{
        text-align: center;
        color: black;
        padding: 20px 0;
    }
    .sideMenu a {
        text-emphasis: uppercase;
        margin-bottom: 20px;
        font-size: 18px;
        transition: .3s;
        display: block;
    }
    #content-area {
        padding: 16px;
        transition: margin-left .5s;
    }
    .content-text {
        padding: 0 180px;
    }
</style>
<body>
    <div id="side-menu" class="sideMenu">
        <a href="javaScript:void(0)" class="closebtn"
            onclick="closeNav()">x
        </a>
        <div class="main-menu">
            <h2>sidemenu</h2>
            <a href="#"><i class="fas fa home">home</i></a>
        </div>
    </div>

    <div id="content-area">
        <span style="font-size: 30px;cursor: pointer" onclick="openNav()">&#9776;Menu</span>
        <div class="content text">
            <h2>header</h2>
            <p>this is paragraph area this is paragraph area this is paragraph area this is paragraph area this is paragraph area this is paragraph area this is paragraph areathis is paragraph area this is paragraph areathis is paragraph areathis is paragraph areathis is paragraph areathis is paragraph area</p>
        </div>
    </div>

    <script>
        function openNav(){
            document.getElementById("side-menu").style.width = "300px";
            document.getElementById("content-area").style.marginLeft= "300px";
        }
        function closeNav(){
            document.getElementById("side-menu").style.width = "0px";
            document.getElementById("content-area").style.marginLeft= "0px";
        }
    </script>

</body>
</html>