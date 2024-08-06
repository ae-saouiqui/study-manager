var btns=document.querySelectorAll('button');
btns.forEach((btn)=>{
   btn.addEventListener('click',(event)=>{
      var cours=btn.parentElement.parentElement.dataset.cours;
      var data=new FormData();
      data.append('cours',cours);
      let request=new XMLHttpRequest();
      request.open("POST","/index.php?action=delCours",true);
      request.send(data);
      request.onreadystatechange=_=>{
          window.location.reload();
      }
   });
});