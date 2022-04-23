let password = document.getElementById("password");
let showPasswordIcon = document.getElementById("showPassword");
showPasswordIcon.addEventListener("click", () => {
  if (password.type === "password") {
    password.type = "text";
    showPasswordIcon.style.color = "blue";
  } else {
    password.type = "password";
    showPasswordIcon.style.color = "grey";
  }
});
