document.addEventListener("DOMContentLoaded", () => {
  generateQuote();
  renderGoals();
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

// quote
const refreshBtn = document.querySelector(".refresh-btn");
const textArea = document.querySelector(".text-area");
const quoteForm = document.querySelector("#quote-form");
refreshBtn.addEventListener("click", () => generateQuote());
quoteForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const customQuoteElem = document.querySelector("#custom-quote");
  document.querySelector(".quote").textContent = customQuoteElem.value;
  document.querySelector(".author").textContent = "Christian Louboutin";
  customQuoteElem.value = "";
});
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

//goal
const pinnedGoals = [
  {
    goal: "Loss 3kg in 3 months",
    actionPlan: ["Exercise regularly", "Maintain clean and healthy diet"],
    progress: "23",
  },
  {
    goal: "Read 2 books in 5 weeks",
    actionPlan: ["Read book before bed time"],
    progress: "50",
  },
  {
    goal: "Wake up at 7am for 21 days",
    actionPlan: ["Sleep early everyday"],
    progress: "100",
  },
];

const goals = [
  {
    goal: "Manage expenses within RM1000 in April",
    actionPlan: ["Record daily expenses"],
    progress: "81",
  },
  {
    goal: "Score 4.0 in this semester",
    actionPlan: ["Study hard"],
    progress: "50",
  },
  {
    goal: "Learn video-editing skill in 2 months",
    actionPlan: ["Practice video-editing regularly"],
    progress: "60",
  },
];

function renderGoals() {
  document.querySelectorAll(".goal-card").forEach((card, index) => {
    if (pinnedGoals[index] !== undefined) {
      const goal = pinnedGoals[index];
      renderCard(card, goal.goal, goal.actionPlan, goal.progress);
    } else {
      renderPlaceholder(card);
    }
  });
}

function renderPlaceholder(card) {
  const myModal = renderModal();
  card.classList.add("pin-goal");
  card.innerHTML = `
      <div class="card-body d-flex align-items-center">
        <i class="bi bi-pin-angle-fill fs-3 card-title me-2"></i>
        <h3 class="card-title">Pin Goal</h3>
      </div>
    `;
  card.addEventListener("click", () => {
    myModal.show();
    document
      .querySelectorAll("#chooseGoal .list-group-item")
      .forEach((elem, index) => {
        elem.addEventListener("click", () => {
          const goal = goals[index];
          renderCard(card, goal.goal, goal.actionPlan, goal.progress);
          card.classList.remove("pin-goal");
          myModal.hide();
        });
      });
  });
}

let rendered = false;

function renderModal() {
  if (!rendered) {
    const list = document.querySelector("#chooseGoal .list-group");
    goals.forEach((goal) => {
      let actionPlanList = "";
      goal.actionPlan.forEach((plan) => (actionPlanList += `<li>${plan}</li>`));
      const btn = document.createElement("button");
      btn.classList.add("list-group-item", "list-group-item-action");
      btn.innerHTML = `
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex flex-column">
        <p>
          <b>${goal.goal}</b>
        </p>
        <ul>${actionPlanList}</ul>
      </div>
      <p>${goal.progress}%</p>
    </div>
  `;
      list.appendChild(btn);
    });
    rendered = true;
  }
  return new bootstrap.Modal(document.querySelector("#chooseGoal"));
}

function renderCard(card, goal, actionPlan, progress) {
  let actionPlanList = "";
  actionPlan.forEach((plan) => (actionPlanList += `<li>${plan}</li>`));
  card.innerHTML = `
    <div class="card-body d-flex align-items-center position-relative">
      <div
        class="spinner m-4"
        style="background: conic-gradient(#7380ec ${progress}%, rgb(242, 242, 242) ${progress}%);"
      >
        <div class="middle-circle">${progress}%</div>
      </div>
      <div class="goal">
        <h3 class="card-title">${goal}</h3>
        <p class="card-text"><ul>${actionPlanList}</ul></p>
      </div>
    </div>
  `;
  const btn = document.createElement("button");
  btn.classList.add("btn-close", "position-absolute");
  btn.style.top = "5%";
  btn.style.right = "2%";
  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    renderPlaceholder(card);
  });
  card.appendChild(btn);
}

//reminders
const editBtn = document.querySelector(".edit-btn");
editBtn.addEventListener("click", () => {
  document.querySelector(".reminder").classList.toggle("editing");
  document
    .querySelectorAll(".reminder .list-group-item")
    .forEach((elem) => elem.classList.toggle("list-group-item-action"));
});
