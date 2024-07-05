

function printAccommodationDetails(){

    var printableDiv = document.getElementById('hostelDetails').innerHTML;
    var originalContent = document.body.innerHTML;

    /* Replacecurrent content page with div content to print */
    document.body.innerHTML = printableDiv;
    
    /* Print the div */
    window.print();

    /* Restore original page coontent */
    document.body.innerHTML= originalContent;
}

function printBookingHistory(){

    var printableDiv = document.getElementById('bookingHistory').innerHTML;
    var originalContent = document.body.innerHTML;

    /* Replacecurrent content page with div content to print */
    document.body.innerHTML = printableDiv;
    
    /* Print the div */
    window.print();

    /* Restore original page coontent */
    document.body.innerHTML= originalContent;
}


function printapproved(){

    var printableDiv = document.getElementById('bookingHistory').innerHTML;
    var originalContent = document.body.innerHTML;

    /* Replacecurrent content page with div content to print */
    document.body.innerHTML = printableDiv;
    
    /* Print the div */
    window.print();

    /* Restore original page content */
    document.body.innerHTML= originalContent;
}

function printarchive(){
    

    var printableDiv = document.getElementById('bookingHistory').innerHTML;
    var originalContent = document.body.innerHTML;

    /* Replacecurrent content page with div content to print */
    document.body.innerHTML = printableDiv;
    
    /* Print the div */
    window.print();

    /* Restore original page coontent */
    document.body.innerHTML= originalContent;
}

/*
document.addEventListener("DOMContentLoaded", function(){
        

            //remove skeleton
        document.getElementById('skeleton').classList.add('hidden');

        //add main content
        document.getElementById('content').classList.remove('hidden');

        
}
)
*/

/* Function for enabling settings form */
function enableInputs(){
var textFields = document.getElementsByClassName('inputFields');

for(var i = 0; i < textFields.length;i++){
    if(textFields[i].disabled){
        textFields[i].disabled = false;

        document.getElementById('edit').disabled = true;
        document.getElementById('cancel').disabled = false;
        document.getElementById('submit').disabled = false;
    }
    else{
        textFields.disabled =true;
    }
}



}

/* Function for disabling settings form */
function disableInput(){
    var textFields = document.getElementsByClassName('inputFields');
    
    for(var i = 0; i < textFields.length;i++){
        textFields[i].disabled = true;

        document.getElementById('edit').disabled = false;
        document.getElementById('cancel').disabled = true;
        document.getElementById('submit').disabled = true;
    }
    
    }

    /* putting page names on nav bar  

    function addPageTitleVerification (){


        var pageTitle = document.getElementById('pageTitle');
        pageTitle.textContent = "Verification " + pageTitle.textContent;

    }


    var verificationBtn = document.getElementById('verification');
    verificationBtn.addEventListener('click', addPageTitleVerification);

    */



    /* home page actions */
      // JavaScript for carousel functionality
  let testimonials = document.querySelectorAll('.testimonial');
  let index = 0;

  function showTestimonial() {
    testimonials.forEach(testimonial =>{
      testimonial.classList.remove('carousel');
      testimonial.style.display = 'none';
    })
    index = (index + 1) % testimonials.length;
    testimonials[index].classList.add('carousel');
    testimonials[index].style.display = 'flex';
  }

  setInterval(showTestimonial, 15000); // Change testimonial every 15 seconds



//menu actions
  const navItems = document.querySelector('.menulist');
const openNavBtn = document.querySelector('#menuBtn');
const closeNavBtn = document.querySelector('#closeBtn');



/* show nav dropdown */
const openNav = () => {
    navItems.style.display = 'flex';
    openNavBtn.style.display = 'none';
    closeNavBtn.style.display = ' block';
    

} 


/* hide nav dropdown */
const closeNav = () => {
    navItems.style.display = 'none';
    openNavBtn.style.display = 'block';
    closeNavBtn.style.display = 'none';
    
                      
}

openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);