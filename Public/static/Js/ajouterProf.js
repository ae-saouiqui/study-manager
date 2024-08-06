
/**
 *@author :  Es-saouiqui Amine
 * */



function isCinValide(cin){
    /**
     * @function isCinValide : verifie si le pattern de ce code est correcte
     * @param {string} cin : le code CIN  a tester
     * @var {RegExp} regex : le pattern de CIN
     * @return boolean
     * */
    let regex=/[A-Z][A-Z0-9][0-9]{5}/;
    return regex.test(cin);
}
function isAdult(birthday){
    /**
     * @function isAdult : verifie si l'utilisateur est un adulte ( age>=18 )
     * @param {string} birthday : la date de naissance d'utilisateur  [ aaaa-mm-jj ]
     * @var {Date} today : objet represente la date d'ajourd'hui
     * @var {Date} todayPast18 : objet represente la date d'aujourd'hui avant 18 annee
     * @var {Date} naissance : ocjet represente la date de naissance d'utilisateur
     * @return boolean
     * */
    let today=new Date();
    let todayPast18=new Date(today.getFullYear()-18,today.getMonth()+1,today.getDate());
    let naissance=new Date(birthday);
    return naissance<=todayPast18;
}
function isPhone(phone){
    let regex=/\d{10}/;
    return regex.test(phone);
}
function isName(name){
    let regex=/^[A-Za-z]+$/;
    return regex.test(name);
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
function createDoneModal(){
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
        "                    <p>Ce professeur a ete ajoute avec succes</p>\n" +
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
let form=document.forms[0];
form.addEventListener('submit',(event)=>{
    event.preventDefault();
    /**
     * @var {HTMLElement} nom : un element HTML represente l'input qui concerne le nom d'utilisateur
     * @var {HTMLElement} prenom : un element HTML represente l'input qui concerne le prenom d'utilisateur
     * @var {HTMLElement} email : un element HTML represente l'input qui concerne le prenom d'utilisateur
     * @var {HTMLElement} cin : un element HTML represente l'input qui concerne le CIN ( Carte d'identite Notinal ) d'utilisateur
     * @var {HTMLElement} birthday : un element HTML represente l'input qui concerne le CIN la date de naissance d'utilisateur
     * @var {HTMLElement} phone : un element HTML represente l'input qui concerne le numero de telephone d'utilisateur
     * @var {HTMLElement} password : un element HTML represente l'input qui concerne le mot de passe d'utilisateur
     * @var {HTMLElement} sexe : un element HTML represente l'input qui concerne le sexe d'utilisateur  (input de type select)
     * @var {HTMLElement} file : un element HTML represente l'input qui concerne le photo du profile d'utilisateur
     * */
    let nom=document.getElementById('nom');
    let prenom=document.getElementById('prenom');
    let email=document.getElementById('email');
    let cin=document.getElementById('cin');
    let birthday=document.getElementById('birthday');
    let phone=document.getElementById('phone');
    let password=document.getElementById('password');
    let sexe=document.getElementById('sexe');
    let file=document.getElementById('picture');
    let modal=createErrorModalelement();
    if(!isName(nom.value)){
        declareError("Nom Invlide");
    }else if (!isName(prenom.value)){
        declareError("Prenom Invalide");
    }else if (!isAdult(birthday.value)){
        declareError("L'utilisateur est un mineur");
        button.click();
    }else if(!isCinValide(cin.value)){
        declareError("CIN incorrect");
    }else if(!isPhone(phone.value)){
        declareError("Numero de Telephone Invalid");
    }else if(sexe.value!="M" && sexe.value!="F"){
        declareError("Choisissez le sexe");
    }else{
        let formData = new FormData();
        formData.append('nom', nom.value);
        formData.append('prenom', prenom.value);
        formData.append('email', email.value);
        formData.append('password', password.value);
        formData.append('cin',cin.value);
        formData.append('sexe', sexe.value);
        formData.append('birthday', birthday.value);
        formData.append('phone', phone.value);

        if (file.files.length > 0) {
            formData.append('picture', file.files[0]);
        }


        let request = new XMLHttpRequest();
        request.open("POST", "/index.php?action=addProf", true);
        request.send(formData);
        request.onreadystatechange=event=> {
            let response=JSON.parse(request.responseText);
            if(response.success) {
                createDoneModal(response.message).click();
            }
            else{
                declareError(response.message);
            }
        }

    }
});