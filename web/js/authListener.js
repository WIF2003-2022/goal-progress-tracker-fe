window.addEventListener("load", (e) => {
  const val = sessionStorage.getItem("auth");
  console.log(val !== "true");
});
