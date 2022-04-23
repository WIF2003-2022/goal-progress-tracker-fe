import { showError } from "./authValidateUtils.js";

const destinationPage = "login.html";

const form = document.getElementById("forgot-password-form");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");

const forgotPasswordAction = (e) => {
  const fields = document.getElementsByTagName("input");
  let isValid = true;
  for (let field of fields) {
    if (!(isValid = isValid && field.checkValidity())) {
      showError(field.getAttribute("id"));
      e.preventDefault();
    }
  }
  form.classList.add("was-validated");
  if (isValid) {
    console.log(password.value === confirmPassword.value);
    if (password.value === confirmPassword.value) {
      e.preventDefault();
      window.location.href = destinationPage;
    } else {
      e.preventDefault();
      const confirmPasswordErr = document.getElementById("passwordMismatch");
      confirmPasswordErr.style.display = "block";
    }
  }
};

form.addEventListener("submit", forgotPasswordAction);
