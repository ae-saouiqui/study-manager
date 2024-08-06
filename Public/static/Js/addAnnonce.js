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

let form=document.getElementById('creer-annonce');

form.addEventListener('submit',(event)=>{
    event.preventDefault();
    var title=form.children[1];
    var contenu=form.children[3];
    var file=form.children[5];
    let data=new FormData();
    data.append('title',title.value);
    data.append('contenu',contenu.value);
    if(file.files.length==1)data.append('file',file.files[0]);
    let request=new XMLHttpRequest();
    request.open("POST","/index.php?action=addAnnonce",true);
    request.send(data);
    request.onreadystatechange=_=>{
        console.log(request.responseText);
        var response=JSON.parse(request.responseText);
        if(response.success){
            createDoneModal(response.message).click();
        }else{
            let modal=createErrorModalelement();
            declareError(response.message);
        }
    }
})