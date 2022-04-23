import { showError } from "./authValidateUtils.js";

const destinationPage = window.location.href;

const form = document.getElementById("request-email-form");
const info = document.getElementById("info");

const requestEmailAction = (e) => {
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
    e.preventDefault();
    info.style.display = "block";
  }
};

form.addEventListener("submit", requestEmailAction);
