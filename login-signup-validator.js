var form = document.querySelector("form");
var username = document.getElementById("username");
var password = document.getElementById("password");

form.addEventListener("submit", onSubmit);
//username.addEventListener("change", validate_name, false);
//password.addEventListener("change", validate_email, false);

//Log In submit
function onSubmit(event) {
  event.preventDefault(); 
  const formData = new FormData(form);

  fetch("login.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      console.log(data); 
      // Optionally handle response, e.g., display a success message
      const [status, message] = data.split(";"); // Split by semicolon

      if (status === "success") {
          document.cookie = `sessionToken=${message}; path=/; Secure; HttpOnly`;
          alert("Login successful!");
      } else {
          alert(message); // Show the error message returned from the server
      }
  })
  .catch(error => {
      console.error("Error:", error); // Log any errors
  });
}

function validate_name(event) {
  var regexName = /^[a-z\s]+$/i;
  var name = event.currentTarget;
 
  if (!regexName.test(name.value)) {
    alert("The name you entered (" + name.value + 
          ") is not in the correct form. \nThe name must only contain alphabets and spaces. \n");
    name.focus();
    name.select();
	  return false;
  } 
}

function validate_email(event) {
  var regexEmail = /^[\w.-]+@([\w]+\.){1,3}[\w]{2,3}$/;
  var email = event.currentTarget;

  if (!regexEmail.test(email.value)) {
    alert("The email you entered (" + email.value + 
      ") is not in the correct form. \n" +
      "The user name part can  only contain word characters including hyphen (\"-\") and period (\".\").\n" +
      "The domain name contains two to four address extensions. \n" +
      "Each extension is string of word characters and separated from the others by a period (\".\").\n" +
      "The last extension must have two to three characters only. \n");
      email.focus();
      email.select();
    return false;
  }
}

function validate_date(event) {
  var today = new Date();
  
  var input = event.currentTarget;
  var inputDateStr = input.value;
  var inputDate = new Date(inputDateStr);

  today.setHours(0, 0, 0, 0);
  inputDate.setHours(0, 0, 0, 0);

  if(inputDate <= today) {
    alert("The starting date cannot be today and the past.");
    input.focus();
    input.select();
    return false;
  }
}

function validate_exp(event) {
  var exp = event.currentTarget;
  
  if (exp.value.trim() === "") {
    alert ("Experience field cannot be empty.");
    return false;
  }
}