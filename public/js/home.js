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
    initialView: "dayGridMonth",
    events: [
      {
        id: "a",
        title: "Jog 3 times a week",
        start: "2022-05-04",
        end: "2022-05-07",
      },
      {
        id: "b",
        title: "Jog 3 times a week",
        start: "2022-04-27",
        end: "2022-04-30",
      },
      {
        id: "c",
        title: "Jog 3 times a week",
        start: "2022-04-20",
        end: "2022-04-23",
      },
    ],
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
  {},
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
  const modal = bootstrap.Modal.getOrCreateInstance(
    document.querySelector("#chooseGoal")
  );
  document.querySelectorAll(".goal-card").forEach((card, index) => {
    if (Object.keys(pinnedGoals[index]).length !== 0) {
      renderCard(card, index);
    } else {
      renderPlaceholder(card, modal, index);
    }
  });
}

function renderCard(card, cIndex) {
  card.classList.remove("pin-goal");
  const { goal, actionPlan, progress } = pinnedGoals[cIndex];
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
  const unpinBtn = document.createElement("button");
  unpinBtn.classList.add("btn-close", "position-absolute");
  unpinBtn.style.top = "5%";
  unpinBtn.style.right = "3%";
  unpinBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    goals.push(pinnedGoals[cIndex]);
    pinnedGoals[cIndex] = {};
    renderGoals();
  });
  card.firstElementChild.appendChild(unpinBtn);
}

function renderPlaceholder(card, modal, cIndex) {
  card.classList.add("pin-goal");
  card.innerHTML = `
      <div class="card-body d-flex align-items-center justify-content-center w-100" >
        <i class="bi bi-pin-angle-fill fs-3 me-2"></i>
        <h3 class="m-0">Pin Goal</h3>
      </div>
    `;
  card.firstElementChild.addEventListener("click", () =>
    showModal(modal, cIndex)
  );
}

function showModal(modal, cIndex) {
  const list = document.querySelector("#chooseGoal .list-group");
  list.innerHTML = "";
  goals.forEach((goal, index) => {
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
        <p class="fs-4 m-0">${goal.progress}%</p>
      </div>
    `;
    btn.addEventListener("click", () => {
      pinnedGoals[cIndex] = goals.splice(index, 1)[0];
      renderGoals();
      modal.hide();
    });
    list.appendChild(btn);
  });
  modal.show();
}

//reminders
const editBtn = document.querySelector(".edit-btn");
editBtn.addEventListener("click", () => {
  document.querySelector(".reminder").classList.toggle("editing");
  document
    .querySelectorAll(".reminder .list-group-item")
    .forEach((elem) => elem.classList.toggle("list-group-item-action"));
});
