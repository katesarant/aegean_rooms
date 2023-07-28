
// booking form 
var formsInput = document.querySelectorAll('.formValidation');
var hotelName = document.getElementById('hotelName');
var adultNo = document.getElementById('adultNo');
var childNo = document.getElementById('childNo');
var subBtn =document.getElementById("btnform");
var checkInday = document.getElementById('checkInday');
var checkOutday = document.querySelector('#checkOutday');
var form = document.getElementById('bookform');
var spanPrice =document.getElementById('totalPriceSpan' );

// contactUs
var formBtn = document.querySelector("#btnEmail");
var formEmail = document.querySelector("#emailform");
var textComment = document.querySelector("#commentL");
var validFb = document.querySelector(".valid-feedback");
var invalidFb = document.querySelector(".invalid-feedback");
var BtnTextComment=document.querySelector("#sentBtn");







/*  
Validation - booking table - (/home.php)
*/

var $checkInday =new Date(checkInday.value);
var $checkOutdate =new Date(checkOutday.value);
var today = new Date();
var checkIntoTime ;
var checkOuttoTime ;
var totaldays=0;
var totalPrice = 0;


function validateIn(object) {

        $checkInday = new Date(object.value);

        let $day = $checkInday.getDate();
        let $month = $checkInday.getMonth();
        let $Year = $checkInday.getFullYear();
      
        $checkInday.setDate($day) 
        $checkInday.setMonth($month) 
        $checkInday.setFullYear($Year) 

}

function validateOut(object) {
   
    $checkOutdate = new Date(object.value);

        let $day = $checkOutdate.getDate();
        let $month = $checkOutdate.getMonth();
        let $Year = $checkOutdate.getFullYear();

        $checkOutdate.setDate($day) 
        $checkOutdate.setMonth($month) 
        $checkOutdate.setFullYear($Year) 

}



   // add validation bootstrap class
hotelName.addEventListener('click',function(){
    if(hotelName.value == '0'){
                hotelName.classList.add('is-invalid');    
                if(hotelName.classList.contains('is-valid')){
                    hotelName.classList.remove('is-valid')
                }     
            }else{
                 hotelName.classList.remove('is-invalid')
                 hotelName.classList.add('is-valid');
                 
            }
})
adultNo.addEventListener('click',function(){
    if(adultNo.value == '0'){
        adultNo.classList.add('is-invalid');  
        if(adultNo.classList.contains('is-valid')){
            adultNo.classList.remove('is-valid')
        }      
            }else{
                adultNo.classList.remove('is-invalid')
                adultNo.classList.add('is-valid');
          
            }
})
childNo.addEventListener('click',function(){
    if(childNo.value == 'title'){
       
        childNo.classList.add('is-invalid'); 
        childNo.value =0;
        if(childNo.classList.contains('is-valid')){
            childNo.classList.remove('is-valid')
        }      
            }else{
                childNo.classList.remove('is-invalid')
                childNo.classList.add('is-valid');
            }
})

checkInday.addEventListener('change',function(){

   if($checkInday < today ){

 if(($checkInday > $checkOutdate) || ($checkInday <= today) ){
    checkInday.classList.add('is-invalid');   
        if(checkInday.classList.contains('is-valid')){
            checkInday.classList.remove('is-valid')
        } 
   }else{
    checkInday.classList.remove('is-invalid')
    checkInday.classList.add('is-valid');
   }
    
}

})

checkOutday.addEventListener('change',function(){


   if($checkInday > $checkOutdate ||  $checkOutdate <= today ){
 
    checkOutday.classList.add('is-invalid');   
    if(checkOutday.classList.contains('is-valid')){
        checkOutday.classList.remove('is-valid')
    } 
   }else{
    
    checkOutday.classList.remove('is-invalid')
    checkOutday.classList.add('is-valid');
   }

    
})

// change type-validation .User should fill up there profile first.

if(form.hasAttribute('valide')){
    subBtn.setAttribute('type','submit');
   
}

/* set on/off  disabled button  and calculate price */
    let counter = 0 ;
  
    form.addEventListener('click',(e)=>{
        if(counter < 0){
            counter =0;
        }
       
        if(counter == 3 && 
            checkInday.classList.contains('is-valid') &&
            checkOutday.classList.contains('is-valid')  ){



            /*-------diffrence between days-----*/

                checkIntoTime = $checkInday.getTime()
                checkOuttoTime = $checkOutdate.getTime()
                var totaldays=0;


                totaldays = checkOuttoTime <= checkIntoTime?1:(checkOuttoTime - checkIntoTime)/86400/1000;
                
            /*-------calulate the price -----*/
                room_perDay = 70;
                child_perDay=50;

                children_total =  childNo.value*room_perDay*totaldays;
                adult_total = (adultNo.value*room_perDay*totaldays)
                totalPrice = parseInt(children_total + adult_total);
                

                spanPrice.value = totalPrice.toString() ;

            /*-------remove disabled from btn Submit-----*/

            subBtn.removeAttribute("disabled");
       }else{
        subBtn.setAttribute("disabled",'')
       }

    if(e.target.classList.contains('is-valid') && hotelName.id == e.target.id)
    {
  
        counter++;
    }
    if(e.target.classList.contains('is-invalid') && hotelName.id == e.target.id)
    {

        counter--;
    }

    if(e.target.classList.contains('is-valid') && adultNo.id ==e.target.id){
 
        counter++;
    }
    if(e.target.classList.contains('is-invalid') && adultNo.id == e.target.id)
    {
  
        counter--;
    }

    if(e.target.classList.contains('is-valid') && childNo.id ==e.target.id){
  
        counter++;
    }
    if(e.target.classList.contains('is-invalid') && childNo.id ==e.target.id){
   
        counter--;
    }
    // ----dates
    
    if(($checkInday > $checkOutdate) || ($checkInday < today) ){
        checkInday.classList.add('is-invalid');   
            if(checkInday.classList.contains('is-valid')){
                checkInday.classList.remove('is-valid')
            } 
       }else{
        checkInday.classList.remove('is-invalid')
        checkInday.classList.add('is-valid');
       }
 
       if($checkInday > $checkOutdate){
 
        checkOutday.classList.add('is-invalid');   
        if(checkOutday.classList.contains('is-valid')){
            checkOutday.classList.remove('is-valid')
        } 
       }else{
        
        checkOutday.classList.remove('is-invalid')
        checkOutday.classList.add('is-valid');
       }



     
  })

//-------------- contact us section fuctionality 
function displayform(){
    formEmail.style.display='flex';
    formBtn.style.display = 'none';
}
function hideform(){
    formEmail.style.display='none';
    formBtn.style.display = 'flex';
}



// ------------leave your message - Validation (/home.php)

function containsSpecialChars(str) {
    const specialChars = /[`@#$%^&*()_+\-=\[\]{};':"\\|,<>\/~]/;
    return specialChars.test(str);
  }

textComment.addEventListener('input',function(e){

if(containsSpecialChars(e.target.value)){
    validFb.style.display='none';
    invalidFb.style.display='block';
    BtnTextComment.setAttribute("type",'button');
}else{
    invalidFb.style.display='none';
    validFb.style.display='block';
    BtnTextComment.setAttribute("type",'submit');
   
}

})
textComment.addEventListener('keyup',function(e){
 
   
    if(textComment.value == ""){
        validFb.style.display='none';
        BtnTextComment.setAttribute("type",'button');
    }

 
})











