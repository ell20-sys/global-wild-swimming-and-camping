
function hamburgerMenu(){
  document.getElementById("navigation").style.display = "inline";
  document.getElementById("search").style.display = "inline";
}

function menuClose(){
  document.getElementById("navigation").style.display = "none";
  document.getElementByClassName("search").style.display = "none";
}

//showing user menu when the user clicks on the profile 
function userMenu() {
  var menu = document.getElementById("user-menu");
  var computedStyle = window.getComputedStyle(menu);

  if (computedStyle.display === 'none') {
    menu.style.display = 'block';
  } else {
    menu.style.display = 'none';
  }
}
// Function for closing the user menu on scroll and tap events
function closeUserMenu(event) {
  var menu = document.getElementById('user-menu');
  var userProfileLink = document.querySelector('.user-profile');
  var targetElement = event.target;

  // Checking if the target element is within the user menu or its child elements
  var isMenuClicked = menu.contains(targetElement);
  var isUserProfileLinkClicked = userProfileLink.contains(targetElement);

  if (!isMenuClicked && !isUserProfileLinkClicked) {
    menu.style.display = 'none';
  }
}

// Add event listeners for scroll, touchstart, and click events
document.addEventListener('scroll', closeUserMenu);
document.addEventListener('touchstart', closeUserMenu);
document.addEventListener('click', closeUserMenu);


// Weather API code
(function(d, s, id) {
  if (d.getElementById(id)) {
      if (window._TOMORROW_) {
          window._TOMORROW_.renderWidget();
      }
      return;
  }
  const fjs = d.getElementsByTagName(s)[0];
  const js = d.createElement(s);
  js.id = id;
  js.src = "https://www.tomorrow.io/v1/widget/sdk/sdk.bundle.min.js";

  fjs.parentNode.insertBefore(js, fjs);
})(document, 'script', 'tomorrow-sdk');


function copyTemporaryPassword() {
  var temporaryPassword = document.getElementById("temporary_password").innerText;

  navigator.clipboard.writeText(temporaryPassword)
    .then(function() {
      alert("Temporary Password copied to clipboard. Remember to change it in your profile.");
      window.location.href = "login.php";
    })
    .catch(function(error) {
      console.error("Failed to copy temporary password: ", error);
    });
}

$(document).ready(function(){
  $('.search input[type="search"]').on("keyup input", function(){
      /* Get input value on change */
      var inputVal = $(this).val();
      var resultDropdown = $(this).siblings(".result");
      if(inputVal.length){
          $.get("search.php", {term: inputVal}).done(function(data){
              resultDropdown.html(data);
          });
      } else{
          resultDropdown.empty();
      }
  });
  
  // Set search input value on click of result item
  $(document).on("click", ".result p", function(){
      $(this).parents(".search").find('input[type="text"]').val($(this).text());
      $(this).parent(".result").empty();
  });
});






