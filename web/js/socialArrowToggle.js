const arrow = document.querySelector("#right-tab-arrow");
const tab = document.querySelector(".right-tab-open");
arrow.addEventListener("click", () => {
  const contents = document.querySelectorAll(".text");
  const images = document.querySelectorAll(".img-thumbnail");
  for (let i = 0; i < contents.length; i++) {
    contents[i].classList.toggle("visually-hidden");
    images[i].classList.toggle("visually-hidden");
  }
  tab.classList.toggle("right-tab-close");
  if (arrow.classList.contains("bi-chevron-right")) {
    arrow.classList.replace("bi-chevron-right", "bi-chevron-left");
  } else {
    arrow.classList.replace("bi-chevron-left", "bi-chevron-right");
  }
});
