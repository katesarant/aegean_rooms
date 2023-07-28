//images
var images= document.querySelectorAll('.m-image');



images.forEach(item =>{
    item.addEventListener('click',(e)=> {
       var $src =  item.getAttribute('src');
        console.log(window.innerWidth);
      
    var img =  document.createElement("img");
        img.setAttribute('src',$src);
        img.setAttribute('alt','room');
        img.setAttribute('id',"pw");
        img.style.height ='50%';
        img.style.width ='30%';
        img.style.position='fixed';
        img.style.top='50%';
        img.style.left='50%';
        img.style.transform=' translate(-50%, -50%)';
        img.style.maxWidth = "950px";
        img.style.zIndex='200';
        img.style.borderRadius = "25px";
        img.classList.add('animate__animated','animate__zoomIn');
        img.style.cursor='pointer';
  

       

        img.setAttribute('onclick',"this.remove()");
        document.body.appendChild(img);
        
      
        
    })

    });




spans =document.querySelectorAll(".counter");
spans.forEach(s =>{
    s.textContent = '0/200';
})

var form  = document.querySelectorAll("form")
form.forEach(el =>{
    var textcounter =el.querySelector(".counter");
    var textInput =el.querySelector(".commentText");
  

 
 
    textInput.addEventListener('input',(e)=>{
        var max = textInput.getAttribute('maxlength');
        max = eval(max);
        textInput.value = textInput.value.substring(0,max);
        textcounter.textContent = e.target.value.length+"/"+max;
            console.log(e.target.value.length)
       
    
    })



})


