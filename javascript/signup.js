const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault(); //prevent the form from being submitted
};

continueBtn.onclick = () => {
    // Send login information using Ajax
    let xhr = new XMLHttpRequest(); // create XML object
    xhr.open("POST", "php/signup.php", true);
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
    };
    //create a new formData object and send the form data to php through Ajax
    let formData = new FormData(form);
    xhr.send(formData);
};
