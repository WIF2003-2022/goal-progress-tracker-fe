import { showError } from "./authValidateUtils.js";

const destinationPage = "login.php";

const form = document.getElementById("request-email-form");

const requestEmailAction = (e) => {
  e.preventDefault();
  const fields = document.getElementsByTagName("input");
  let isValid = true;
  for (let field of fields) {
    if (!(isValid = isValid && field.checkValidity())) {
      showError(field.getAttribute("id"));
    }
  }
  form.classList.add("was-validated");
  if (isValid) {
    $.ajax({
      url: "src/handleRequestEmail.php",
      type: "POST",
      dataType: "json",
      data: $("#request-email-form").serialize(),
    })
      .done((json) => {
        window.location.href = destinationPage;
      })
      .fail((xhr, status, errorThrown) => {
        $("#errorText").text(xhr.responseText);
        $(".modal").modal("show");
        console.log("Error: " + errorThrown);
        console.log("Status: " + status);
        console.log(xhr.responseText);
      });
  }
};

$(".close").click(() => {
  $(".modal").modal("hide");
});

form.addEventListener("submit", requestEmailAction);
