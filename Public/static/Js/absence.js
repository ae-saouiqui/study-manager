function createDoneModal(message){
    let modal=document.createElement('div');
    modal.id='done';
    modal.classList.add('modal');
    modal.classList.add('fade');
    modal.setAttribute("tabindex","-1");
    modal.setAttribute("role","dialog");
    modal.innerHTML=" <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">\n" +
        "            <div class=\"modal-content\">\n" +
        "                <div class=\"modal-header\">\n" +
        "                    <h5 class=\"modal-title\">\n" +
        "                        Ajout Avec succes\n" +
        "                    </h5>\n" +
        "                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>\n" +
        "                </div>\n" +
        "                <div class=\"modal-body\">\n" +
        "                    <i class=\"fa-solid fa-circle-check\"></i>\n" +
        "                    <p>"+message+"</p>\n" +
        "                </div>\n" +
        "                <div class=\"modal-footer\">\n" +
        "                    <button type=\"button\" class=\"btn btn-success\" data-bs-dismiss=\"modal\">OK</button>\n" +
        "                </div>\n" +
        "            </div>\n" +
        "        </div>";
    document.body.appendChild(modal);
    let button=document.createElement('button');
    button.setAttribute("data-bs-toggle","modal");
    button.setAttribute("data-bs-target","#done");
    button.style.visibility="hidden";
    document.body.appendChild(button);
    return button;
}
function createErrorModalelement(){
    let modal=document.createElement("div");
    modal.id="error"
    modal.setAttribute("tabindex","-1");
    modal.setAttribute("role","dialog");
    modal.classList.add("modal");
    modal.classList.add("fade");
    modal.innerHTML="        <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">\n" +
        "            <div class=\"modal-content\">\n" +
        "                <div class=\"modal-body\">\n" +
        "                        <button type=\"button\" class=\"btn-close btn-close-error\" data-bs-dismiss=\"modal\"></button>\n" +
        "                   <p class='error-message'><i class=\"fa-solid fa-circle-exclamation\"></i>Mot de passe ou Email incorrecte</p>\n" +
        "                </div>\n" +
        "            </div>\n" +
        "        </div>";
    document.body.appendChild(modal);
    return modal;
}
function createErrorButton(){
    let button=document.createElement('button');
    button.classList.add("btn-erreur");
    button.setAttribute("data-bs-toggle","modal");
    button.setAttribute("data-bs-target","#error");
    button.style.visibility="hidden";
    document.body.appendChild(button);
    return button;
}
function setErrorMessage(message){
    let element=document.querySelector('.error-message');
    element.innerHTML="<i class=\"fa-solid fa-circle-exclamation\"></i> "+message;
}
function declareError(message){
    let button=document.querySelector(".btn-erreur");
    if(button===null)button=createErrorButton();
    setErrorMessage(message);
    button.click();
}





var select=document.querySelector('.select-all');
var checks=document.querySelectorAll("input[type='checkbox']");
select.addEventListener('click',(event)=>{
    checks.forEach((element)=>{
        element.checked=true;
    });
});
var clearBtn=document.querySelector('.clear-btn');
clearBtn.addEventListener('click',(event)=>{
    checks.forEach((element)=>{
        element.checked=false;
    })
})
var noterBtn=document.querySelector('.noter-btn');
noterBtn.addEventListener('click',(event)=>{
    var table=document.querySelector('.table-etud');
    var module=table.dataset.moduleId;
    var etudiants=[];
   var students=document.querySelectorAll("input[type='checkbox']:checked");
   students.forEach((element)=>etudiants.push(element.value));
   if(etudiants.length!=0){
       var data=new FormData();
       data.append('module',module);
       data.append('etudiants',etudiants);
       Request('noterAbsence',data);
   }else{
       var modal=createErrorModalelement();
       declareError("Il n'y a aucun etudiant absent");
   }

});
function Request(action,data){
    let request=new XMLHttpRequest();
    request.open("POST","/index.php?action="+action);
    request.send(data);
    request.onreadystatechange=_=>{
        var response=JSON.parse(request.responseText);
        if(response.success)createDoneModal(response.message).click();
        else{
            var modal=createErrorModalelement();
            declareError(response.message);
        }
    }
}