// Call function when delete account button is clicked
document.getElementById("deleteAccount").onclick = function () {
  show_dialog();
};
var overlayme = document.getElementById("deleteModal");

/* A function to show the dialog window */
function show_dialog() {
  overlayme.style.display = "block";
}

// If delete btn is clicked , the function delete() is executed
document.getElementById("delete").onclick = function () {
  confirm();
};
var overlayagain = document.getElementById("message");
function confirm() {
  /* code executed if confirm is clicked */
  overlayagain.style.display = "block";
}

// If close icon is clicked, the function exit() is executed
document.getElementById("close").onclick = function () {
  exit();
};
function exit() {
  window.location.href = "login.php";
}

// If exit button is clicked, the function exit() is executed
document.getElementById("exit").onclick = function () {
  exit();
};
function exit() {
  window.location.href = "login.php";
}
