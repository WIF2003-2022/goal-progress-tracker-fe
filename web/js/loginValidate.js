import { showError } from "./authValidateUtils.js";

const destinationPage = "index.php";

const form = document.getElementById("login-form");

const loginAction = (e) => {
  const fields = document.getElementsByTagName("input");
  let isValid = true;
  e.preventDefault();
  for (let field of fields) {
    if (!(isValid = isValid && field.checkValidity())) {
      showError(field.getAttribute("id"));
    }
  }
  form.classList.add("was-validated");
  console.log({ isValid });
  if (isValid) {
    sessionStorage.setItem("auth", "true");
    window.location.href = destinationPage;
  }
};

form.addEventListener("submit", loginAction);
