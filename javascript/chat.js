document.addEventListener("DOMContentLoaded", function() {
    // Get the DOM elements by class or tag name
    const form = document.querySelector(".typing-area");
    const incoming_id = form.querySelector(".incoming_id").value;
    const inputField = form.querySelector(".input-field");
    const sendBtn = form.querySelector("button");
    const chatBox = document.querySelector(".chat-box");

    const imageUploadForm = document.querySelector(".image-upload-form");  
    const imageUploadInput = imageUploadForm.querySelector(".image-upload");


    // Prevent the form from being submitted
    form.onsubmit = (e) => {
        e.preventDefault();
    };

    // Set focus on the input field when the page loads
    inputField.focus();

    // Add the 'active' class to the send button if the input field has a value, otherwise remove the class
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    };

    // Send a message to the server when the send button is clicked
    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/insert-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Clear the input field and scroll to the bottom of the chat box
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        };
        let formData = new FormData(form);
        xhr.send(formData);
    };

    // Add the 'active' class to the chat box when the user's mouse enters it
    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    };

    // Remove the 'active' class from the chat box when the user's mouse leaves it
    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    };

    // Retrieve new messages from the server every 500 milliseconds and update the chat box
    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/get-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Set the chat box's HTML to the response from the server and scroll to the bottom if the chat box is not currently active
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + incoming_id);
    }, 500);

    // A helper function to scroll the chat box to the bottom
    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function attachImageUploadFormSubmitHandler() {
        imageUploadForm.addEventListener("submit", (e) => {
            e.preventDefault(); // prevent form submission
    
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/chat-upload-image.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Clear the input field and scroll to the bottom of the chat box
                        imageUploadForm.reset();
                        scrollToBottom();
                        let response = JSON.parse(xhr.responseText);
                        alert(response.message);
                    }
                }
            };
            let formData = new FormData(imageUploadForm);
            xhr.send(formData);
        });
    }

    imageUploadInput.onchange = () => {
        attachImageUploadFormSubmitHandler();
    };

    attachImageUploadFormSubmitHandler();

});

//window.onbeforeunload = function(){
//    let xhr = new XMLHttpRequest();
//    xhr.open("POST", "php/logout.php", true);
//    xhr.onload = () => {
//        if (xhr.readyState === XMLHttpRequest.DONE) {
//        }
//    };
//    xhr.send();

//    return ""; 
//}
