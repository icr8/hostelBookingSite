var tabBtn1 = document.getElementById("tab1Btn");
var tabBtn2 = document.getElementById("tab2Btn");
var tabBtn3 = document.getElementById("tab3Btn");


var tab1 = document.getElementById("tab1");
var tab2 = document.getElementById("tab2");
var tab3 = document.getElementById("tab3");


tabBtn1.addEventListener('click', function(){
    tab1.style.display = "block";
    tab2.style.display = "none";
    tab3.style.display = "none";
    

} );

tabBtn2.addEventListener('click', function(){
    tab1.style.display = "none";
    tab2.style.display = "block";
    tab3.style.display = "none";
    

} );

tabBtn3.addEventListener('click', function(){
    tab1.style.display = "none";
    tab2.style.display = "none";
    tab3.style.display = "block";
    

} );

// tabBtn4.addEventListener('click', function(){
//     tab1.style.display = "none";
//     tab2.style.display = "none";
//     tab3.style.display = "none";
    

// } );