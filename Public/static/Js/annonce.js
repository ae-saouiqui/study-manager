
let annonces=document.querySelectorAll('.annonce');
let card=document.querySelector('.card');
annonces.forEach((annonce)=>{
    annonce.onclick=_=> {
        if(card.classList.contains("visually-hidden"))card.classList.remove("visually-hidden");
        card.children[0].children[0].textContent=annonce.children[0].textContent;
        card.children[1].children[0].textContent=annonce.children[1].textContent;
        card.children[1].children[1].textContent=annonce.children[1].dataset.date;
        let link='http://'+window.location.host+annonce.children[1].dataset.path.replace(/\s+/g,'');
        card.children[2].children[0].href=link;
        annonces.forEach((elemet)=>{
            if (elemet.classList.contains('clicked'))elemet.classList.remove('clicked');
        });
        annonce.classList.add('clicked');
    }
})