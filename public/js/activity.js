var activities = [
  {
    refer: 1,
    contents: [
      {
        act: 1,
        dueDate: "7/5/2022",
        activity: "Jog 3 Times a Week",
        description: "Description...",
        xValue: 3,
        yValue: 7,
        priority: 5,
        due: 33,
        complete: 23,
      },
      {
        act: 2,
        dueDate: "7/5/2022",
        activity: "Play Basketball 2 Times a Week",
        description: "Description...",
        xValue: 2,
        yValue: 7,
        priority: 3,
        due: 33,
        complete: 23,
      },
    ],
  },
  {
    refer: 2,
    contents: [
      {
        act: 3,
        dueDate: "7/5/2022",
        activity: "Eat Salad 1 Time Everday",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 2,
        due: 33,
        complete: 23,
      },
      {
        act: 4,
        dueDate: "7/5/2022",
        activity: "Consume 2500 calories per Day",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 4,
        due: 33,
        complete: 23,
      },
      {
        act: 5,
        dueDate: "7/5/2022",
        activity: "Have only 3 Meals Per Day",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 3,
        due: 33,
        complete: 23,
      },
    ],
  },
  {
    refer: 3,
    contents: [
      {
        act: 6,
        dueDate: "5/25/2022",
        activity: "Allocate 30 Mins to Read Books Before Bed Time",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 4,
        due: 53,
        complete: 50,
      },
    ],
  },
  {
    refer: 4,
    contents: [
      {
        act: 7,
        dueDate: "4/21/2022",
        activity: "Sleep Before 12am Every Night",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 5,
        due: 99,
        complete: 100,
      },
      {
        act: 8,
        dueDate: "4/21/2022",
        activity: "Set A No-Screen Time of 30 Mins Before Bed Time",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 4,
        due: 99,
        complete: 100,
      },
    ],
  },
  {
    refer: 5,
    contents: [
      {
        act: 9,
        dueDate: "4/30/2022",
        activity: "Spend Less than RM 200 per Day",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 4,
        due: 100,
        complete: 81,
      },
      {
        act: 10,
        dueDate: "4/30/2022",
        activity: "Save at Least RM 50 per Day",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 2,
        due: 100,
        complete: 81,
      },
    ],
  },
  {
    refer: 6,
    contents: [
      {
        act: 11,
        dueDate: "6/20/2022",
        activity: "Revise 2 Chapters a Day",
        description: "Description...",
        xValue: 2,
        yValue: 1,
        priority: 4,
        due: 13,
        complete: 20,
      },
      {
        act: 12,
        dueDate: "6/20/2022",
        activity: "Do at Least 1 Past Year Paper a Day",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 5,
        due: 13,
        complete: 20,
      },
      {
        act: 13,
        dueDate: "6/20/2022",
        activity: "Watch Online Tutorials for at Least 30 Minutes a Day",
        description: "Description...",
        xValue: 1,
        yValue: 1,
        priority: 1,
        due: 13,
        complete: 20,
      },
    ],
  },
];

var modalHTML = `
<div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Activity</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                  ></button>
                </div>
                <div class="modal-body">
                  <h6>Are you sure you want to delete this activity?</h6>
                  <p>Activity details here</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger deleteButton">
                    Delete
                  </button>
                  <button
                    type="button"
                    class="btn btn-light cancelButton"
                    data-bs-dismiss="modal"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
`;

var url = window.location.search;
var param = new URLSearchParams(url);
var query = parseInt(param.get("refer"));

var urlRefer = activities.find((o) => o.refer === query);
document.write("<ul>");
for (i = 0; i < urlRefer.contents.length; i++) {
  document.write(
    `
  <li class="card text-center">
                <div class="card-header">Due ` +
      urlRefer.contents[i].dueDate +
      `</div>
                <div class="card-body">
                  <h5 class="card-title">` +
      urlRefer.contents[i].activity +
      `</h5>
                  <p class="card-text">` +
      urlRefer.contents[i].description +
      `</p>
                  <p class="card-text">` +
      urlRefer.contents[i].xValue +
      ` time(s) per ` +
      urlRefer.contents[i].yValue +
      ` day(s)</p>
                  <div class="mb-3">
                    <script>
                      for (j = 0; j < ` +
      urlRefer.contents[i].priority +
      `; j++) {
                        document.write(
                          "<i class='bi-star-fill' style='color: red; font-size: 1.2rem'></i>"
                        );
                      }
                    </script>
                  </div>
                  <a href="activity-edit.html" style="text-decoration: none">
                    <button style="border: none; background: none">
                      <i class="bi-pencil" style="font-size: 1.5rem"></i>
                    </button>
                  </a>
                  <button
                    class="deleteAct"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    style="border: none; background: none"
                  >
                    <i class="bi-trash-fill" style="font-size: 1.5rem"></i>
                  </button>
                  <div class="mt-3 complete">
                    <input class="form-check-input tick" type="checkbox" />
                    Complete
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                      <div class="text-start">Due</div>
                    </div>
                    <div class="col-6">
                      <div class="text-start">Complete</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="progress">
                        <div
                          class="progress-bar bg-danger progress-bar-striped progress-bar-animated due"
                          role="progressbar"
                          aria-valuenow="` +
      urlRefer.contents[i].due +
      `"
                          aria-valuemin="0"
                          aria-valuemax="100"
                          style="width: ` +
      urlRefer.contents[i].due +
      `%"
                        >
                        ` +
      urlRefer.contents[i].due +
      `%
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="progress">
                        <div
                          class="progress-bar bg-success progress-bar-striped progress-bar-animated finish"
                          role="progressbar"
                          aria-valuenow="` +
      urlRefer.contents[i].complete +
      `"
                          aria-valuemin="0"
                          aria-valuemax="100"
                          style="width: ` +
      urlRefer.contents[i].complete +
      `%"
                        >
                        ` +
      urlRefer.contents[i].complete +
      `%
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li><br>
  `
  );
}
document.write("</ul>");
document.write(modalHTML);

//delete funtion
var elem = document.querySelectorAll(".deleteAct");
var key = document.querySelector(".deleteButton");
for (i = 0; i < elem.length; i++) {
  elem[i].addEventListener("click", function () {
    var x = this.closest("li");
    key.addEventListener("click", function () {
      x.remove();
      this.closest("div").querySelector(".cancelButton").click();
    });
  });
}

//Jquery
/*
$(".deleteAct").on("click", function () {
  if (confirm("Are you sure you want to delete this action plan?")) {
    $(this).closest("li").remove();
  }
});
*/
