const refreshBtn = document.querySelector(".refresh-btn");
const textArea = document.querySelector(".text-area");
const editBtn = document.querySelector(".edit-btn");
refreshBtn.addEventListener("click", () => generateQuote());
editBtn.addEventListener("click", () =>
  document.querySelector(".reminder").classList.toggle("editing")
);
function generateQuote() {
  const temp = textArea.innerHTML;
  textArea.innerHTML = `<span class="spinner-border"></span>`;
  refreshBtn.style.display = "none";
  fetch(
    "https://quotable.io/random?maxLength=125&tags=inspirational|life|success"
  )
    .then((res) => res.json())
    .then((result) => {
      textArea.innerHTML = temp;
      document.querySelector(".quote").textContent = result.content;
      document.querySelector(".author").textContent = result.author;
    })
    .finally(() => {
      refreshBtn.style.display = "";
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
