let pinnedGoals = [];
let goals = [];

document.addEventListener("DOMContentLoaded", () => {
  fetchQuote();
  fetchGoals();
  fetchReminders();
  fetchActivities();
});

// quote
const refreshBtn = document.querySelector(".refresh-btn");
const textArea = document.querySelector(".text-area");
const quoteForm = document.querySelector("#quote-form");
refreshBtn.addEventListener("click", () => fetchQuoteFromAPI());
quoteForm.addEventListener("submit", (e) => {
  e.preventDefault();
  updateQuote();
});

function updateQuote() {
  const customQuoteElem = document.querySelector("#custom-quote");
  $.ajax({
    url: "./src/customQuote.php",
    type: "POST",
    data: { quote: customQuoteElem.value },
  })
    .done((json) => {
      const { author, quote } = JSON.parse(json);
      $(".author").text(author);
      $(".quote").text(quote);
      customQuoteElem.value = "";
    })
    .fail((xhr, status, errorThrown) => {
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    });
}

function fetchQuote() {
  $.ajax({
    url: "./src/customQuote.php",
    type: "GET",
    dataType: "json",
  })
    .done((json) => {
      const { author, quote } = json;
      if (!!quote && quote.length !== 0) {
        $(".author").text(author);
        $(".quote").text(quote);
      } else {
        fetchQuoteFromAPI();
      }
    })
    .fail((xhr, status, errorThrown) => {
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    });
}

function fetchQuoteFromAPI() {
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
  $.ajax({
    url: "./src/customQuote.php",
    type: "POST",
    data: { quote: null },
  }).fail((xhr, status, errorThrown) => {
    console.log("Error: " + errorThrown);
  });
}

function fetchGoals() {
  $.ajax({
    url: "./src/pinnedGoals.php",
    type: "GET",
    dataType: "json",
  })
    .done((json) => {
      goals = json.goals;
      pinnedGoals = json.pinnedGoals;
    })
    .fail((xhr, status, errorThrown) => {
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    })
    .always(() => renderGoals());
}

function updateGoals(goal_id, modal, index) {
  $.ajax({
    url: "./src/pinnedGoals.php",
    type: "POST",
    data: { goal_id: goal_id, goal_pinned: parseInt(index) },
  })
    .done(() => {
      fetchGoals();
      if (!!modal) modal.hide();
    })
    .fail((xhr, status, errorThrown) => {
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    });
}

function renderGoals() {
  const modal = bootstrap.Modal.getOrCreateInstance(
    document.querySelector("#chooseGoal")
  );
  const cards = document.querySelectorAll(".goal-card");
  cards.forEach((card, index) => renderPlaceholder(card, modal, index));
  pinnedGoals.forEach((goal, index) =>
    renderCard(cards[goal.goal_pinned], index)
  );
}

function renderCard(card, index) {
  card.classList.remove("pin-goal");
  const { goal_id, goal_title, action_plans, goal_progress } =
    pinnedGoals[index];
  let actionPlanList = "";
  action_plans.forEach((plan) => (actionPlanList += `<li>${plan}</li>`));
  card.innerHTML = `
    <div class="card-body d-flex align-items-center position-relative">
      <div
        class="spinner m-4"
        style="background: conic-gradient(#7380ec ${goal_progress}%, rgb(242, 242, 242) ${goal_progress}%);"
      >
        <div class="middle-circle">${goal_progress}%</div>
      </div>
      <div class="goal">
        <h3 class="card-title">${goal_title}</h3>
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
    updateGoals(goal_id, null, null);
  });
  card.firstElementChild.appendChild(unpinBtn);
}

function renderPlaceholder(card, modal, index) {
  card.classList.add("pin-goal");
  card.innerHTML = `
      <div class="card-body d-flex align-items-center justify-content-center w-100" >
        <i class="bi bi-pin-angle-fill fs-3 me-2"></i>
        <h3 class="m-0">Pin Goal</h3>
      </div>
    `;
  card.firstElementChild.addEventListener("click", () =>
    showModal(modal, index)
  );
}

function showModal(modal, index) {
  const list = document.querySelector("#chooseGoal .list-group");
  list.innerHTML = "";
  goals.forEach((goal) => {
    let actionPlanList = "";
    goal.action_plans.forEach((plan) => (actionPlanList += `<li>${plan}</li>`));
    const btn = document.createElement("button");
    btn.classList.add("list-group-item", "list-group-item-action");
    btn.innerHTML = `
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column">
          <p>
            <b>${goal.goal_title}</b>
          </p>
          <ul>${actionPlanList}</ul>
        </div>
        <p class="fs-4 m-0">${goal.goal_progress}%</p>
      </div>
    `;
    btn.addEventListener("click", () => {
      updateGoals(goal.goal_id, modal, index);
    });
    list.appendChild(btn);
  });
  modal.show();
}

//reminders
function fetchReminders() {
  $.ajax({
    url: "./src/handleActivities.php",
    type: "GET",
    dataType: "json",
    data: { data: "reminders" },
  })
    .done((reminders) => {
      let count = 0;
      const today = new Date(new Date().setHours(0, 0, 0, 0));
      const tomorrow = new Date(today);
      tomorrow.setDate(tomorrow.getDate() + 1);
      processActivities(reminders).forEach((reminder) => {
        const startDate = new Date(reminder.start);
        if (today <= startDate) {
          const listItem = document.createElement("div");
          listItem.classList.add(
            "list-group-item",
            "list-group-item-action",
            "d-flex",
            "justify-content-between",
            "align-items-center"
          );
          listItem.innerHTML = `
            <a class="flex-grow-1" href="./activity.php?ap_id=${reminder.ap_id}">
              <div class="d-flex flex-column">
                <h5 class="mb-1">${reminder.title}</h5>
                <p class="mb-1">${reminder.description}</p>
                <p class="mb-1 text-muted">${reminder.start}</p>
              </div>
            </a>
            <button
              class="delete-btn"
              type="button"
              data-bs-toggle="modal"
              data-bs-target="#deleteModal"
            >
              <i class="bi bi-x-circle-fill"></i>
            </button>
        `;
          if (startDate.toDateString() === today.toDateString()) {
            document
              .querySelector("#today > .list-group")
              .appendChild(listItem);
          } else if (startDate.toDateString() === tomorrow.toDateString()) {
            document
              .querySelector("#tomorrow > .list-group")
              .appendChild(listItem);
          } else if (count < 5) {
            count++;
            document
              .querySelector("#upcoming > .list-group")
              .appendChild(listItem);
          }
        }
      });
    })
    .fail((xhr, status, errorThrown) => {
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    });
}
const editBtn = document.querySelector(".edit-btn");
editBtn.addEventListener("click", () => {
  document.querySelector(".reminder").classList.toggle("editing");
  document
    .querySelectorAll(".reminder .list-group-item")
    .forEach((elem) => elem.classList.toggle("list-group-item-action"));
});

function fetchActivities() {
  $.ajax({
    url: "./src/handleActivities.php",
    type: "GET",
    dataType: "json",
    data: { data: "activities" },
  })
    .done((activities) => {
      renderCalendar(processActivities(activities));
    })
    .fail((xhr, status, errorThrown) => {
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    });
}

function processActivities(activities) {
  const data = [];
  activities.forEach((activity) => {
    let duration = parseInt(activity.a_days) / parseInt(activity.a_times);
    let times;
    if (duration < 1) {
      duration = 1;
      times = 1;
    } else {
      duration = Math.floor(duration);
      times = parseInt(activity.a_times);
    }
    const endDate = new Date(activity.a_due_date);
    let currDate = new Date(activity.a_start_date);
    while (currDate < endDate) {
      let start = new Date(currDate.getTime());
      for (let i = 0; i < times; i++) {
        const end = new Date(start.getTime());
        end.setDate(end.getDate() + duration);
        data.push({
          ap_id: activity.ap_id,
          title: activity.a_title,
          start: start.toISOString().split("T")[0],
          end: end.toISOString().split("T")[0],
          description: activity.a_description,
        });
        start = new Date(end.getTime());
      }
      currDate.setDate(currDate.getDate() + parseInt(activity.a_days));
    }
  });
  return data;
}

function renderCalendar(activities) {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: "bootstrap5",
    headerToolbar: {
      left: "prev",
      center: "title",
      right: "next",
    },
    footerToolbar: {
      right: "dayGridMonth,dayGridWeek,listWeek",
    },
    initialView: "dayGridMonth",
    events: activities,
  });
  calendar.render();
}
