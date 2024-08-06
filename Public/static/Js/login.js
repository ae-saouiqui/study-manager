/**
 * @author : Es-saouiqui Amine
 * */
//clear the local storage

// get the login form
    let form = document.forms[0];
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        let email = document.querySelectorAll('.login-input')[0];
        let password = document.querySelectorAll('.login-input')[1];
        let request = new XMLHttpRequest();
        request.open("POST", "/index.php?action=login");
        let data = {
            email: email.value,
            password: password.value
        };
        request.send(JSON.stringify(data));
        request.onreadystatechange = () => {
            console.log(request.responseText);
            let response = JSON.parse(request.responseText);
            if (response.success) {
                window.location.href="/App/views/"+response.type+".php";
            } else {
                let btn =document.createElement("button");
                btn.style.visibility="hidden";
                btn.setAttribute( "data-bs-toggle","modal");
                btn.setAttribute("data-bs-target","#error");
                document.body.appendChild(btn);
                btn.click();
            }
        }
    });

