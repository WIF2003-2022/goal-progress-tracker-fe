import { showError } from "./authValidateUtils.js";

const destinationPage = "email-verification.html";

const form = document.getElementById("register-form");

const registerAction = (e) => {
  console.log("register");
  e.preventDefault();
  const fields = document.getElementsByTagName("input");
  let isValid = true;
  for (let field of fields) {
    if (!(isValid = isValid && field.checkValidity())) {
      showError(field.getAttribute("id"));
    }
  }
  form.classList.add("was-validated");
  console.log({ isValid });
  if (isValid) {
    $.ajax({
      url: "src/handleRegister.php",
      type: "POST",
      dataType: "json",
      data: $("#register-form").serialize(),
    })
      .done((json) => {
        console.log(json);
        window.location.href = destinationPage;
      })
      .fail((xhr, status, errorThrown) => {
        console.log(errorThrown);
        $("#errorText").text(xhr.responseText);
        $(".modal").modal("show");
      });
  }
};

$(".close").click(() => {
  $(".modal").modal("hide");
});

form.addEventListener("submit", registerAction);
