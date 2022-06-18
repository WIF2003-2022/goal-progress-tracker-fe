import { showError } from "./authValidateUtils.js";

const destinationPage = "index.php";

const form = document.getElementById("login-form");

const loginAction = (e) => {
  e.preventDefault();
  const fields = document.getElementsByTagName("input");
  let isValid = true;
  let data = {};
  for (let field of fields) {
    if (!(isValid = isValid && field.checkValidity())) {
      showError(field.getAttribute("id"));
    }
    const name = field.getAttribute("name");
    const value = field.value;
    data[name] = value;
  }
  form.classList.add("was-validated");
  console.log({ isValid });
  if (isValid) {
    $.ajax({
      url: "src/handleLogin.php",
      type: "POST",
      dataType: "json",
      data: $("#login-form").serialize(),
    })
      .done((json) => {
        window.location.href = "index.php";
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

form.addEventListener("submit", loginAction);
