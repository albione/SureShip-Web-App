var form = document.querySelector("form");
var username = document.getElementById("username");
var password = document.getElementById("password");
var submitBtn = document.getElementById("submitBtn");

form.addEventListener("submit", onSubmit);

// validation check flag
var isValidUsername = false;
var isValidEmail = false;
var isValidPassword = false;

// Is sign up page
if (document.getElementById("signUp")) {
  var email = document.getElementById("email");
  var confpassword = document.getElementById("confpassword");

  username.addEventListener("change", validate_username);
  password.addEventListener("change", validate_password);
  confpassword.addEventListener("change", validate_password);
  email.addEventListener("change", validate_email);
}

function onSubmit(event) {
  event.preventDefault(); 
  const formData = new FormData(form);

  if(document.getElementById("signUp")) {
    url = "signup.php";
  } else {
    url = "login.php";
  }

  fetch(url, {
      method: "POST",
      body: formData
  })
  .then(response => response.text())
  .then(data => {
    console.log(data); 
    // Optionally handle response, e.g., display a success message
    const [type, status,message] = data.split(";");
    if (type === "login") {
      if (status === "success") {
        document.cookie = `sessionToken=${message}; path=/; Secure; HttpOnly`;
        window.location.href = "index.php";
      } else {
        alert(message);
      }
    }
    if (type === "signup") {
      alert(message);
      if (status === "success") {
        window.location.href = "login.html";
      }
    }
  })
  .catch(error => {
      console.error("Error:", error);
  });
}

function validate_username(event) {
  var regexName = /^[a-z\s]+$/i;
  var username = event.currentTarget;
 
  if (!regexName.test(username.value)) {
    isValidUsername = false;
    alert("The username you entered (" + username.value + 
          ") is not in the correct form. \nThe name must only contain alphabets, and spaces. \n");
    username.focus();
    username.select();
    document.getElementById("usernameErrorMsg").innerHTML = "Invalid. Only alphabets and spaces";
	  return false;
  }
  document.getElementById("usernameErrorMsg").innerHTML = "";
  isValidUsername = true;
  check_submit_button();
}

function validate_email(event) {
  var regexEmail = /^[\w.-]+@([\w]+\.){1,3}[\w]{2,3}$/;
  var email = event.currentTarget;

  if (!regexEmail.test(email.value)) {
    isValidEmail = false;
    alert("The email you entered (" + email.value + 
      ") is not in the correct form. \n" +
      "The user name part can  only contain word characters including hyphen (\"-\") and period (\".\").\n" +
      "The domain name contains two to four address extensions. \n" +
      "Each extension is string of word characters and separated from the others by a period (\".\").\n" +
      "The last extension must have two to three characters only. \n");
    email.focus();
    email.select();
    document.getElementById("emailErrorMsg").innerHTML = "Invalid email format.";
    return false;
  }
  isValidEmail = true;
  document.getElementById("emailErrorMsg").innerHTML = "";
  check_submit_button();
}

function validate_password(event) {
  if (event.currentTarget.id == "confpassword") {
    if (password.value) {
      if (confpassword.value === password.value) {
        isValidPassword = true;
        document.getElementById("confpwdErrorMsg").innerHTML = "";
        check_submit_button();
        return true;
      }
      isValidPassword = false;
      alert("Your confirm password does not match.");
      confpassword.focus();
      confpassword.select();
      document.getElementById("confpwdErrorMsg").innerHTML = "Your confirm password does not match.";
      return false;
    }
  }
  if (event.currentTarget.id == "password") {
    if (confpassword.value) {
      if (password.value === confpassword.value) {
        isValidPassword = true;
        document.getElementById("confpwdErrorMsg").innerHTML = "";
        return true;
      }
      isValidPassword = false;
      alert("Your confirm password does not match.");
      password.focus();
      password.select();
      document.getElementById("confpwdErrorMsg").innerHTML = "Your confirm password does not match.";
      return false;
    }
  }
  
}

function check_submit_button() {
  if (isValidUsername && isValidEmail && isValidPassword) {
    submitBtn.disabled = false;
    return true;
  }
  submitBtn.disabled = true;
  return false;
}