document.querySelector(".nav .toggle-btn").addEventListener("click",function(){
    document.querySelector(".sidebar").classList.toggle("active");
    document.querySelector(".nav").classList.toggle("close");
    document.querySelector(".content-area").classList.toggle("active");
});
