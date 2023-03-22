// Get necessary elements from DOM
const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const usersList = document.querySelector(".users .users-list");

// Add click event listener to search button
searchBtn.onclick = () => {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
}

// Add keyup event listener to search bar
searchBar.onkeyup = () => {
  let searchTerm = searchBar.value;
  if (searchTerm !== "") {
    searchBar.classList.add("active");
  } else {
    searchBar.classList.remove("active");
  }
  // Send search term to server using AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

// Refresh user list every 500ms
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!searchBar.classList.contains("active")) {
          usersList.innerHTML = data;
        }
      }
    }
  }
  xhr.send();
}, 500);

//window.onbeforeunload = function(){
//  let xhr = new XMLHttpRequest();
//  xhr.open("POST", "php/logout.php", true);
//  xhr.onload = () => {
//      if (xhr.readyState === XMLHttpRequest.DONE) {
//      }
//  };
//  xhr.send();

//  return ""; 
//}
