btns=document.querySelectorAll('button');


btns.forEach((btn)=>{
   btn.addEventListener('click',(event)=>{
      var rapport=btn.parentElement.parentElement.dataset.rapport;
      let request=new XMLHttpRequest();
      request.open("POST","/index.php?action=recuRapport",true);
      var data=new FormData();
      data.append('rapport',rapport);
      request.send(data);
      request.onreadystatechange=_=>{
          window.location.reload();
      }
   });
});