const form = document.querySelector(".login form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault(); //this to prevent form from the submittion
}

continueBtn.onclick = () => {
    //begin coding using Ajax 
    let xhr = new XMLHttpRequest(); //this to create the XML object.
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                if (data == "success") {
                    location.href = "users.php";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    //now here we need to send the form via ajax to php
    let formData = new FormData(form); //this is to create a new formData object
    xhr.send(formData); //this is to send the form data into the php file
}