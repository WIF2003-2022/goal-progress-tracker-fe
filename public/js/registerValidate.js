import { showError } from "./authValidateUtils.js";

const destinationPage = "index.html";

const form = document.getElementById("register-form");

const registerAction = (e) => {
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

form.addEventListener("submit", registerAction);
