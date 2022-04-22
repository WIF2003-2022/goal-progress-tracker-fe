const quoteNode = document.querySelector(".quote");
const authorNode = document.querySelector(".author");
const refreshBtn = document.querySelector(".refresh");
function generateQuote() {
  const temp = refreshBtn.innerHTML;
  quoteNode.style.visibility = "hidden";
  authorNode.style.visibility = "hidden";
  refreshBtn.innerHTML = `<span class="spinner-border spinner-border-sm"></span>`;
  refreshBtn.disabled = true;
  fetch(
    "https://quotable.io/random?maxLength=125&tags=inspirational|life|success"
  )
    .then((res) => res.json())
    .then((result) => {
      quoteNode.textContent = result.content;
      authorNode.textContent = result.author;
    })
    .finally(() => {
      refreshBtn.innerHTML = temp;
      refreshBtn.disabled = false;
      quoteNode.style.visibility = "visible";
      authorNode.style.visibility = "visible";
    });
}
document.addEventListener("DOMContentLoaded", () => {
  generateQuote();
  setProgress();
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: "bootstrap5",
    headerToolbar: {
      left: "prev",
      center: "title",
      right: "next",
    },
    footerToolbar: {
      right: "dayGridMonth,timeGridDay,listWeek",
    },
    initialView: "listWeek",
  });
  calendar.render();
});

refreshBtn.addEventListener("click", () => generateQuote());

function setProgress() {
  const arr = [];
  const spinners = document.querySelectorAll(".spinner");
  for (let i = 0; i < spinners.length; i++) {
    arr.push(Math.floor(Math.random() * 100));
  }
  spinners.forEach((e, index) => {
    progress = arr[index];
    e.style.background =
      "conic-gradient(rgb(3, 133, 255) " +
      progress +
      "%,rgb(242, 242, 242) " +
      progress +
      "%)";
  });
  document.querySelectorAll(".middle-circle").forEach((e, index) => {
    progress = arr[index];
    e.innerHTML = progress.toString() + "%";
  });
}
