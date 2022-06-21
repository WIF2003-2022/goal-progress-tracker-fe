$(document).ready(() => {
  const generateActivity = ({ a_title, a_complete = "0" }) =>
    `<li>
    ${a_title}
    <div class="progress">
      <div
        class="progress-bar progress-bar-striped progress-bar-animated"
        role="progressbar"
        style="width: ${a_complete}%"
        aria-valuenow="${a_complete}"
        aria-valuemin="0"
        aria-valuemax="100"
      >
        ${a_complete}%
      </div>
    </div>
  </li>`;

  const generateActionPlan = ({ ap_title }, activities) =>
    `<li>
      ${ap_title}
      <ul>
        ${activities.join("")}
      </ul>
    </li>`;

  const generateGoal = (
    { goal_id, goal_status, goal_title, goal_start_date, goal_due_date },
    actionPlans
  ) =>
    `<div class="filterDiv ${goal_status.toLowerCase()}">
    <div class="box" style="background-color: rgb(255, 255, 255)">
      <span
        style="
          font-size: 100%;
          color: rgb(255, 109, 4);
          font-family: 'roboto';
        "
      >
        <i class="bi bi-activity"></i>
        ${goal_status.toUpperCase()}
      </span>
      <div>
        <div class="goal" id="goal-title">${goal_title}</div>
        <span
          style="
            font-size: 80%;
            color: rgb(165, 160, 160);
            font-family: 'verdana';
          "
        >
          Date: ${goal_start_date} - ${goal_due_date}
        </span>
        <div class="goalName">
          <ul>
            ${actionPlans.join("")}
          </ul>
        </div>
      </div>
    </div>
  </div>`;
  $.ajax({
    url: "./src/visualisationDetails.php",
    type: "GET",
    dataType: "json",
  })
    .done((goals) => {
      const goalLists = Object.values(goals).map((goal) =>
        generateGoal(
          goal,
          Object.values(goal["action_plans"]).map((actionPlan) =>
            generateActionPlan(
              actionPlan,
              actionPlan["activities"].map((activity) =>
                generateActivity(activity)
              )
            )
          )
        )
      );
      console.log({ goalLists });
      $(".objects").html(goalLists.join(""));
      filterObjects("all");
    })
    .fail((xhr, status, errorThrown) => {
      alert("Sorry, there was a problem!");
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    })
    .always(function (xhr, status) {
      console.log("The request is complete!");
    });
});
