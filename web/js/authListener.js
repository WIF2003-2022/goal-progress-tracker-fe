window.addEventListener("load", (e) => {
  const val = sessionStorage.getItem("auth");
  console.log(val !== "true");
  if (val !== "true") {
    window.location.href = "../views/login.html";
  }
});
