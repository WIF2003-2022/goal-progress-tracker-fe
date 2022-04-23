import { showError } from "./authValidateUtils.js";

const destinationPage = "index.html";

const form = document.getElementById("register-form");

const registerAction = (e) => {
  const fields = document.getElementsByTagName("input");
  let isValid = true;
  for (let field of fields) {
    if (!(isValid = isValid && field.checkValidity())) {
      showError(field.getAttribute("id"));
      e.preventDefault();
    }
  }
  form.classList.add("was-validated");
  console.log({ isValid });
  if (isValid) {
    e.preventDefault();
    window.location.href = destinationPage;
  }
};

form.addEventListener("submit", registerAction);
