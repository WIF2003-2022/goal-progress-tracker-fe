const quoteNode = document.querySelector(".quote");
const authorNode = document.querySelector(".author");
const refreshBtn = document.querySelector(".refresh");
function generateQuote() {
  const temp = refreshBtn.innerHTML;
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
    });
}
document.addEventListener("DOMContentLoaded", () => {
  generateQuote();
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: "bootstrap5",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridDay,listWeek",
    },
    initialView: "listWeek",
  });
  calendar.render();
});

refreshBtn.addEventListener("click", () => generateQuote());
