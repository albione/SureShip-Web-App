var form = document.querySelector("form");
var username = document.getElementById("username");
var password = document.getElementById("password");
var email = document.getElementById("email");
var address = document.getElementById("address");
var saveBtn = document.getElementById("saveBtn");

form.addEventListener("submit", onSubmit);
password.addEventListener("change", validate_password);
address.addEventListener("change", validate_address);
email.addEventListener("change", validate_email);

// validation check flag
var isValidEmail = true;
var isValidPassword = true;

if (address.value.trim()) {
    var isValidAddress = true;
} else {
    var isValidAddress = false;
}

function onSubmit(event) {
  event.preventDefault(); 
  const formData = new FormData(form);

  fetch("myAccountUpdate.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.text())
  .then(data => {
    // Optionally handle response, e.g., display a success message
    const [status,message] = data.split(";");
    if (status === "success") {
        alert(message);
        window.location.href = "myAccount.php";
    } else {
        alert(message);
    }
    })
  .catch(error => {
      console.error("Error:", error);
  });
}

function validate_email(event) {
  var regexEmail = /^[\w.-]+@([\w]+\.){1,3}[\w]{2,3}$/;
  var email = event.currentTarget;

  if (!regexEmail.test(email.value)) {
    isValidEmail = false;
    check_save_button();
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
    if (password.value) {
        isValidPassword = true;
        check_save_button();
        document.getElementById("passwordErrorMsg").innerHTML = "";
        check_save_button();
        return true;
      }
      isValidPassword = false;
      check_save_button();
      alert("Your password must not be empty.");
      password.focus();
      password.select();
      document.getElementById("passwordErrorMsg").innerHTML = "Your password must not be empty.";
      return false;
}


function validate_address(event) {
    var address = event.currentTarget;
  
    if (address.value.trim() === "") {
        isValidAddress = false;
        check_save_button();
        alert ("Address field cannot be empty.");
        document.getElementById("addressErrorMsg").innerHTML = "Your address must not be empty.";
        return false;
    }
    isValidAddress = true;
    document.getElementById("addressErrorMsg").innerHTML = "";
    check_save_button();
    return true;
}

function check_save_button() {
  if (isValidEmail && isValidPassword && isValidAddress) {
    saveBtn.disabled = false;
    return true;
  }
  saveBtn.disabled = true;
  return false;
}