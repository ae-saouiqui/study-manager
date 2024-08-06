let Deletebtns=document.querySelectorAll('.supprimer-btn');
Deletebtns.forEach((element)=>{
   element.addEventListener('click',(event)=>{
       var prof=element.parentElement.parentElement.dataset.profId;
       var data =new FormData();
       data.append('prof',prof);
       SendData('deleteProf',data);
   });
});
let Activebtns=document.querySelectorAll('.activer-btn');
Activebtns.forEach((element)=>{
    element.addEventListener('click',(event)=>{
        var prof=element.parentElement.parentElement.dataset.profId;
        var data =new FormData();
        data.append('prof',prof);
        SendData('activerProf',data);});
});
let Desactivebtns=document.querySelectorAll('.desactiver-btn');
Desactivebtns.forEach((element)=>{
    element.addEventListener('click',(event)=>{
        var prof=element.parentElement.parentElement.dataset.profId;
        var data =new FormData();
        data.append('prof',prof);
        SendData('desactiverProf',data);
    });
});
function SendData(action,data){
    var request=new XMLHttpRequest();
    request.open("POST","/index.php?action="+action,true);
    request.send(data);
    request.onreadystatechange=_=>{
        if(request.status==200){
            window.location.reload();
        }
    }
}


