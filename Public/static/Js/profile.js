/**
 * @author : Es-saouiqui Amine
 * */
function getFile(file) {
    return  new Promise((reolve, reject) => {
        file.addEventListener('change', (event) => {
            var picture = file.files[0];
            if (typeof picture !== 'undefined') {
                reolve(picture);
            } else {
                reject(Error("No file"));
            }
        });
    });
}
const logoEditor=document.querySelector('.logo-editer');
logoEditor.addEventListener('click',async (event)=>{
    try {
        var user = logoEditor.dataset.user;
        var type = logoEditor.dataset.type;
        var file = document.querySelector('.file-input');
        file.click();
        var picture = await getFile(file);
        var data=new FormData();
        data.append('file',picture);
        data.append('id',user);
        data.append('type',type);
        var request=new XMLHttpRequest();
        request.open("POST","/index.php?action=changeProfile",true);
        request.send(data);
        request.onreadystatechange=_=>{
            console.log(request.responseText);
            var response=JSON.parse(request.responseText);
            if(response.success){
                window.location.reload();
            }else{
                let modal=createErrorModalelement();
                declareError(response.message);
            }
        }

    }catch (error){
        console.log(error);
    }

});


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