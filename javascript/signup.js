const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault(); //prevent the form from being submitted
};

continueBtn.onclick = () => {
    //create XML object and use Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data.includes("Success")) {
                    location.href = "users.php";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    };
    //create a new formData object and send the form data to php through Ajax
    let formData = new FormData(form);
    xhr.send(formData);
};
