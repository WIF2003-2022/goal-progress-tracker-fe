import { showError } from "./authValidateUtils.js";

const destinationPage = "login.php";

const form = document.getElementById("forgot-password-form");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");

const forgotPasswordAction = (e) => {
  const fields = document.getElementsByTagName("input");
  let isValid = true;
  for (let field of fields) {
    if (!(isValid = isValid && field.checkValidity())) {
      showError(field.getAttribute("id"));
    }
  }
  form.classList.add("was-validated");
  if (isValid) {
    window.location.href = destinationPage;
  }
};

form.addEventListener("submit", forgotPasswordAction);
