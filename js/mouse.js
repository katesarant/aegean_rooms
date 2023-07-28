var p =document.querySelector(".wrap_cycle p");
var div = document.querySelector('.wrap_cycle');
var a =document.querySelectorAll("a");
var btn =document.querySelectorAll("button");



window.addEventListener("mousemove",(e)=>{

    var y= e.clientX+30+'px';
    var x = e.clientY+30+'px';
    div.style.top =x;
    div.style.left =y;

});

a.forEach(item=>{
item.addEventListener('mouseenter',(e)=>{

div.style.backgroundColor ='red';
p.innerText = item.innerText;
p.style.opacity ='1';


})

item.addEventListener('mouseleave',(e)=>{
div.style.backgroundColor ='#dfd8d847';
p.innerText = '';
p.style.opacity ='-1';
})

})
btn.forEach(i=>{
  i.addEventListener('mouseenter',(e)=>{

  div.style.backgroundColor ='red';
  p.innerText = i.innerText;
  p.style.opacity ='1';


    
  })
  
  i.addEventListener('mouseleave',(e)=>{
  div.style.backgroundColor ='#dfd8d847';
  p.innerText = '';
  p.style.opacity ='1-';

  })
  
  })