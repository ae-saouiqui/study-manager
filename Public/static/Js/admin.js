

function checkCNE(cne){
    regex=/^[A-Z][0-9]{9}$/;
    return regex.test(cne);
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
let getForm=(id)=> document.getElementById(id);

let addClassForm=getForm("add-class-form");
addClassForm.addEventListener('submit',(event)=>{
    event.preventDefault();
    let select=addClassForm.children[1];
    let file=addClassForm.children[3];
    let dataForm=new FormData();
    dataForm.append('filiere',select.value);
    dataForm.append('file',file.files[0]);
    Request("AddClass",dataForm);
});
let deleteStudent=getForm('delete-etud-form');
deleteStudent.addEventListener('submit',(event)=>{
    event.preventDefault();
    let cne=deleteStudent.children[0];
    if (checkCNE(cne.value)===true){
        let data=new FormData();
        data.append('cne',cne.value);
        Request("DeleteStudent",data);
    }else{
        let modal=createErrorModalelement();
        declareError("Syntaxe Invalide");
    }
});
let addModule=getForm('create-module');
addModule.addEventListener('submit',(event)=>{
    event.preventDefault();
    var title=addModule.children[1].value;
    var checkedvalues=[];
    var checkedbox=document.querySelectorAll('input[name="filieres[]"]:checked');
    checkedbox.forEach((element)=>{
        checkedvalues.push(element.value);
    });
    var prof=addModule.children[5].value;
    var data=new FormData();
    data.append('titre',title);
    data.append('filieres[]',checkedvalues);
    data.append('prof',prof);
    Request('addModule',data);
});
function Request(action,data){
    let request=new XMLHttpRequest();
    request.open("POST","/index.php?action="+action,true);
    request.send(data);
    request.onreadystatechange=()=>{
        console.log(request.responseText);
        let response=JSON.parse(request.responseText);
        if(response.success){
            createDoneModal(response.message).click();
        }else{
            let modal=createErrorModalelement();
            declareError(response.message);
        }
    }
}
var room=document.getElementById('create-room');
room.addEventListener('submit',(event)=>{
    event.preventDefault();
    var titre=room.children[1].value;
    var filiere=room.children[3].value;
    var prof=room.children[5].value;
    var data=new FormData();
    data.append('titre',titre);
    data.append('filiere',filiere);
    data.append('prof',prof);
    Request('addRoom',data);
})