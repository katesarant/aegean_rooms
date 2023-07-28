


document.addEventListener("DOMContentLoaded", function(event) {
   
    const x_icon = document.getElementById('x_icon');
    const profileAvatar = document.getElementById('profileAvatar');
    const btnDanger = document.querySelectorAll('.btn-danger');
    const personalInfoItems = document.querySelectorAll('.personalInfoItem');

    const UploadBtn = document.getElementById("uploadbtn");
    const imgInput = document.getElementById('imgInput');

    const Lastname = document.getElementById('Lastname');
    const Firstname = document.getElementById('Firstname');
    const createdCart = document.getElementById('createdCart');
    const Phone = document.getElementById('Phone');



    /*------------------- avatar picture profile page-------------------*/
        
        profileAvatar.addEventListener('mouseover',function(){
       
        document.querySelector('#imgBtn_wrapper').style.display='flex';
    });

    UploadBtn.addEventListener('click',function(e){
    if(!(imgInput.value== '')){
        UploadBtn.setAttribute('type','submit');
    }else{
        UploadBtn.setAttribute('type','button');
    }
    })

    x_icon.addEventListener('click',function(e){
        
        document.querySelector('#imgBtn_wrapper').style.display='none';
    })
    
    /* ------------------- Validate personal info table -----------------------------*/

let clarify=0;

    Firstname.addEventListener('blur',(e)=>{
        e.target.value = e.target.value.replace(/\s/g, "").toUpperCase().trim();
        const regex = new RegExp("[A-Za-z]{2,}","g");
     
        if(regex.test(e.target.value) == false){
            e.target.value ="";
            
            if(e.target.classList.contains('is-valid')){
                e.target.classList.remove('is-valid');
                clarify--;
               }
        }else{
    
                e.target.classList.add('is-valid');
                clarify++;
            }
    })


    Lastname.addEventListener('blur',(e)=>{
        e.target.value = e.target.value.replace(/\s/g, "").toUpperCase().trim();
        const regex = new RegExp("[A-Za-z]","g");
     
        if(regex.test(e.target.value) == false){
            e.target.value ="";
            if(e.target.classList.contains('is-valid')){
                clarify--;
                e.target.classList.remove('is-valid')
               }
        }else{
    
                e.target.classList.add('is-valid');
                clarify++;
            }
    })
  

    Phone.addEventListener('blur',(e)=>{
        e.target.value = e.target.value.replace(/\s/g, "").trim();
        const regex = new RegExp("[0-9]","g");
     
        if((regex.test(e.target.value) == false)||(e.target.value.length >=11)||(e.target.value.length <=9)){
            e.target.value ="";
            if(e.target.classList.contains('is-valid')){
                clarify--;
                e.target.classList.remove('is-valid')
               }
        }else{
    
                e.target.classList.add('is-valid');
                clarify++;
            }
   

    })

            
    createdCart.addEventListener('blur',(e)=>{
        e.target.value = e.target.value.replace(/\s/g, "").trim();
  
        const regex = new RegExp("[0-9]","g");
           if((regex.test(e.target.value ) == false)||(e.target.value.length >16 )||(e.target.value .length <= 15)){
            e.target.value="";
           if(e.target.classList.contains('is-valid')){
            clarify--;
            e.target.classList.remove('is-valid')
           }
        }else{

            e.target.classList.add('is-valid');
            clarify++;
        }
   
    })
  

    personalInfoItems.forEach(element =>{
       element.addEventListener('blur',()=>{
            if(personalInfoItems.length == clarify){
            document.getElementById('personalInfoBtn').removeAttribute('disabled');
           }else{
            document.getElementById('personalInfoBtn').setAttribute('disabled', '');
           }
        })
        
        
    })
  


});