var actionPlans = [
  {
    id: 1,
    content: [
      { refer: 1, actionPlan: "Exercise Regularly", dueDate: "7/5/2022" },
      {
        refer: 2,
        actionPlan: "Maintain Clean and Healthy Diet",
        dueDate: "7/5/2022",
      },
    ],
  },
  {
    id: 2,
    content: [
      {
        refer: 3,
        actionPlan: "Read Book Before Bed Time",
        dueDate: "5/25/2022",
      },
    ],
  },
  {
    id: 3,
    content: [
      { refer: 4, actionPlan: "Sleep Early Everyday", dueDate: "4/21/2022" },
    ],
  },
  {
    id: 4,
    content: [
      { refer: 5, actionPlan: "Record Daily Expenses", dueDate: "4/30/2022" },
    ],
  },
  {
    id: 5,
    content: [
      {
        refer: 6,
        actionPlan: "Study Hard",
        dueDate: "6/20/2022",
      },
    ],
  },
];

var modalHTML = `
<div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Action Plan</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                  ></button>
                </div>
                <div class="modal-body">
                  <h6>Are you sure you want to delete this action plan?</h6>
                  <p>Action plan details here</p>
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
var query = parseInt(param.get("id"));

var urlID = actionPlans.find((o) => o.id === query);
document.write('<ul><div class="row">');
for (i = 0; i < urlID.content.length; i++) {
  document.write(
    `
  <li class="card col-3 m-3 shadow" style="width: 25vw">
                <div class="row">
                  <div class="col-9"></div>
                  <div class="col-1">
                    <a
                      href="action-main-edit.html?id=` +
      urlID.id +
      `"
                      style="text-decoration: none"
                    >
                      <button style="border: none; background: none">
                        <i class="bi-pencil" style="font-size: 1.5vw"></i>
                      </button>
                    </a>
                  </div>
                  <div class="col-1">
                    <button
                      class="deleteAP"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteModal"
                      style="border: none; background: none"
                    >
                      <i class="bi-trash-fill" style="font-size: 1.5vw"></i>
                    </button>
                  </div>
                </div>
                <img
                  class="card-img-top"
                  src=` +
      "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRINomLSaFLHVYYfShk5a8DZ8SkubojQhUeLQ&usqp=CAU" +
      `
                />
                <div class="card-body">
                  <a
                    href="activity.html?id=` +
      urlID.id +
      "&refer=" +
      urlID.content[i].refer +
      `"
                    style="text-decoration: none"
                    class="card-text"
                    >` +
      urlID.content[i].actionPlan +
      `</a
                  >
                  <p class="card-text">Due ` +
      urlID.content[i].dueDate +
      `</p>
                </div>
              </li>
  `
  );
}
document.write("</div></ul>");
document.write(modalHTML);

//delete funtion
var elem = document.querySelectorAll(".deleteAP");
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

//JQuery
/*
$(".close").on("click", function () {
  if (confirm("Are you sure you want to delete this action plan?")) {
    $(this).closest("li").remove();
  }
});
*/
