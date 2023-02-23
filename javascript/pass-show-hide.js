// Get the password input field and toggle button from the form
const pswrdField = document.querySelector(".form input[type='password']");
const toggleBtn = document.querySelector(".form .field i");

// Set up an event listener for the toggle button when clicked
toggleBtn.onclick = () => {
  // If the password field is currently of type "password", change it to "text" and add an "active" class to the toggle button
  if (pswrdField.type === "password") {
    pswrdField.type = "text";
    toggleBtn.classList.add("active");
  }
  // If the password field is not currently of type "password", change it back to "password" and remove the "active" class from the toggle button
  else {
    pswrdField.type = "password";
    toggleBtn.classList.remove("active");
  }
};
