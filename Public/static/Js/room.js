document.addEventListener('DOMContentLoaded',(event)=>{
  var card=document.querySelector('.chat-body');
  card.scrollTop=card.scrollHeight;
    }
);
var activeId="";
var rooms=document.querySelectorAll('.room');
var activeRoom=document.querySelector('.active-room');
rooms.forEach((room)=>{
   room.addEventListener('click',(event)=>{
      rooms.forEach((room)=>{
         room.classList.remove('room-clicked');
      });
      activeId=room.dataset.roomId;
      fetch("/index.php?action=message&room="+activeId)
          .then((result)=>{
             var data=result.json();
             return data;
          }).then((response)=>{
              for(let i=0;i<response.length;i++){
                      createMessage(response[i].nom+" "+response[i].prenom,window.location.protocol+'//'+window.location.host+response[i].photo_profile,response[i].contenu,response[i].date_envoi,response[i].id_user==getUser().get('id')?'send':'recieve');
              }
      }).catch((error)=>console.log(error));
      room.classList.add('room-clicked');
      activeRoom.children[0].src=room.children[0].src;
      activeRoom.children[1].textContent=room.children[1].textContent;
      document.querySelector('.card').classList.remove('visually-hidden');
   });
});

function createMessage(user,img,message,date,type){
var chat=document.querySelector('.chat-body');
var container=document.createElement('div');
container.classList.add('message-container');
container.classList.add(type);
var Message=document.createElement('div');
Message.classList.add('message');
container.appendChild(Message);
var head=document.createElement('div');
head.classList.add('message-head');
head.classList.add('d-flex');
var image=document.createElement('img');
image.src=img;
var name=document.createElement('h6');
name.textContent=user;
head.appendChild(image);
head.appendChild(name);
Message.appendChild(head);
var content=document.createElement('div');
var text=document.createElement('p');
text.textContent=message;
content.appendChild(text);
Message.appendChild(content);
var dates=document.createElement('span');
dates.textContent=date;
container.appendChild(dates);
chat.appendChild(container);

};
var btn=document.querySelector('.btn-send');
btn.addEventListener('click',(event)=>{
    data={};
    input=document.querySelector('input');
    data.message=input.value;
    data.room=activeId;
    data.sender=getUser().get('id');
    data.profile=getUser().get('profile');
    data.name=getUser().get('name');
    input.value="";
    if (socket.readyState===WebSocket.OPEN){
    socket.send(JSON.stringify(data));
    createMessage(data.name,window.location.protocol+'//'+window.location.host+data.profile,data.message,formatDate(new Date()),'send');
    var card=document.querySelector('.chat-body');
    card.scrollTop=card.scrollHeight;
}else{
    let modal=createErrorModalelement();
  declareError("Un erreur S'est produite lors d'envoi de cette message ");
}});
let socket=new WebSocket("wss://curse-spotless-linseed.glitch.me/userAgent=ESERVICES");
socket.onopen=(e)=>{
    console.log("Connection established");
}
function getUser(){
    map=new Map();
    card=document.querySelector('.card');
    map.set('id',card.dataset.user);
    map.set('profile',card.dataset.profile);
    map.set('name',card.dataset.name);
    return map;
}
socket.onmessage=(data)=>{
    var recieve=JSON.parse(data.data);
    if(recieve.sender!==getUser().get('id')){
    if(activeId==recieve.room){
    createMessage(recieve.name,window.location.protocol+'//'+window.location.host+recieve.profile,recieve.message,recieve.date,'recieve');
        var card=document.querySelector('.chat-body');
        card.scrollTop=card.scrollHeight;
    }}}
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
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