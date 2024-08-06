

function getForm(id){
    return document.getElementById(id);
}
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


let exportForm=getForm('export-note');
exportForm.addEventListener('submit',(event)=>{
    event.preventDefault();
    var filiere=exportForm.children[0];
    var raccourci=filiere.options[filiere.selectedIndex];
    var prof=exportForm.dataset.prof;
    var data=new Map();
    data.set("filiere",filiere.value);
    data.set("raccourci",raccourci.textContent);
    data.set("prof",prof);
    GETFile("exportNote",data);
});
let addNote=getForm('add-note');
addNote.addEventListener('submit',(event)=>{
    event.preventDefault();
    var filiere=addNote.children[0].value;
    var module=addNote.children[1].value;
    var file=addNote.children[2].files[0];
    var data=new FormData();
    data.append('filiere',filiere);
    data.append('module',module);
    data.append('file',file);
    RequestPOST('addNote',data);
});
let addCours=getForm('add-cours');
addCours.addEventListener('submit',(event)=>{
    event.preventDefault();
    var titre=addCours.children[0].value;
    var module=addCours.children[1].value;
    var prof=addCours.children[1].dataset.profId;
    var file=addCours.children[2].files[0];
    var data=new FormData();
    data.append('titre',titre);
    data.append('module',module);
    data.append('prof',prof);
    data.append('file',file);
    RequestPOST('addCours',data);
})

function RequestPOST(action,data){
    let request=new XMLHttpRequest();
    request.open("POST","/index.php?action="+action,true);
    request.send(data);
    request.onreadystatechange=_=>{
        console.log(request.responseText);
        var response=JSON.parse(request.response);
        if(response.success){
            createDoneModal(response.message).click();
        }else{
            let modal=createErrorModalelement();
            declareError(response.message);
        }
    }
}
function GETFile(action,data){
    req="";
    data.forEach((value,key)=>{
        req+="&"+key+"="+value;
    });
    request=new XMLHttpRequest();
    request.open("GET","/index.php?action="+action+req,true);
    request.responseType="blob";
    request.send();
    request.onreadystatechange=_=>{
        var file=request.response;
        if(!request.getResponseHeader('Content-Type').includes('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')){
                let modal=createErrorModalelement();
                declareError("Pas des etudiants dans dans cette filiere");
        }else{
            createDoneModal("Le fichier a ete exporte");
            var link=document.createElement('a');
            link.href=window.URL.createObjectURL(file);
            link.download=data.get('raccourci')+".xlsx";
            link.click();
            createDoneModal("Le fichier a ete exporte").click();
        }
    }
}
let Absence=getForm('noter-absence');
Absence.addEventListener('submit',(event)=>{
   event.preventDefault();
   var filiere=Absence.children[1];
    var raccourci=filiere.options[filiere.selectedIndex];
   var module=Absence.children[3].value;
   var prof=Absence.dataset.prof;
   var data=new Map();
   data.set('filiere',filiere.value);
   data.set('raccourci',raccourci.textContent);
   data.set('module',module);
   data.set('prof',prof);
   RequestGET('getAbsence',data);
});
function RequestGET(action,data){
    req="";
    data.forEach((value,key)=>{
        req+="&"+key+"="+value;
    });
    request=new XMLHttpRequest();
    request.open("GET","/index.php?action="+action+req,true);
    request.send();
    request.onreadystatechange=_=>{
        console.log(request.responseText);
        var response=JSON.parse(request.responseText);
        if(response.success){
            url='/App/views/absence.php?filiere='+response.titre+'&module='+response.module;
            window.location.href=window.location.protocol+'//'+window.location.host+url;
        }else{
            let modal=createErrorModalelement();
            declareError("Ce Module ne possede pas a cette filiere");
        }
    }
}





