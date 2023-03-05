const form = document.querySelector(".login form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault(); // prevent form submission
};

continueBtn.onclick = () => {
  // Send login information using Ajax
  let xhr = new XMLHttpRequest(); // create XML object
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
  };
  let formData = new FormData(form); // create new formData object
  xhr.send(formData); // send form data to php file
};
