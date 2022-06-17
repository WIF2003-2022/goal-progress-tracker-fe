var ajax = new XMLHttpRequest();
var method = "GET";
var urlString = window.location.search;
var param = new URLSearchParams(urlString);
var queryID = parseInt(param.get("id"));
var queryName = param.get("name");
var url = "activity-data.php?id=" + queryID;
var asyn = true;
var modal;
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

ajax.open(method, url, asyn);
ajax.send();
ajax.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    var data = JSON.parse(this.responseText);
    console.log(data);
    var title = document.querySelector(".title");
    title.innerHTML = queryName;
    var urlPath = document.querySelector(".add");
    urlPath.parentNode.href = "activity-add.html?id=" + queryID;
    var html = document.querySelector(".starting");
    html.innerHTML += "<ul>";
    for (i = 0; i < data.length; i++) {
      html.innerHTML +=
        `
      <li class="card text-center">
                    <div class="card-header">Due ` +
        data[i].a_due_date +
        `</div>
                    <div class="card-body">
                      <h5 class="card-title">` +
        data[i].a_title +
        `</h5>
                      <p class="card-text">` +
        data[i].a_description +
        `</p>
                      <p class="card-text">` +
        data[i].a_times +
        ` time(s) per ` +
        data[i].a_days +
        ` day(s)</p>
                      <div class="mb-3">
                        <script>
                          for (j = 0; j < ` +
        data[i].a_priority +
        `; j++) {
                            document.write(
                              "<i class='bi-star-fill' style='color: red; font-size: 2vw'></i>"
                            );
                          }
                        </script>
                      </div>
                      <a href="activity-edit.php?id=${data[i].a_id}" style="text-decoration: none">
                        <button style="border: none; background: none">
                          <i class="bi-pencil" style="font-size: 2vw"></i>
                        </button>
                      </a>
                      <button
                        class="deleteAct"
                        name="${data[i].a_id}"
                        style="border: none; background: none"
                      >
                        <i class="bi-trash-fill" style="font-size: 2vw"></i>
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
        50 +
        `"
                              aria-valuemin="0"
                              aria-valuemax="100"
                              style="width: ` +
        50 +
        `%"
                            >
                            ` +
        50 +
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
        50 +
        `"
                              aria-valuemin="0"
                              aria-valuemax="100"
                              style="width: ` +
        50 +
        `%"
                            >
                            ` +
        50 +
        `%
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li><br>
      `;
    }
    html.innerHTML += "</ul>";
    html.innerHTML += modalHTML;
    modal = bootstrap.Modal.getOrCreateInstance(
      document.querySelector("#deleteModal")
    );

    //delete funtion
    var elem = document.querySelectorAll(".deleteAct");
    var key = document.querySelector(".deleteButton");
    for (i = 0; i < elem.length; i++) {
      elem[i].addEventListener("click", function (e) {
        showModal();
        console.log(e.target.name);
        const id = e.target.name;
        //var x = this.closest("li");
        key.addEventListener("click", function () {
          //x.remove();
          location.href = "activity-delete.php?id=" + id;
          this.closest("div").querySelector(".cancelButton").click();
        });
      });
    }
  }

  function showModal() {
    modal.show();
  }
};

// var urlRefer = activities.find((o) => o.refer === queryID);
// for (i = 0; i < urlRefer.contents.length; i++) {}

//Jquery
/*
$(".deleteAct").on("click", function () {
  if (confirm("Are you sure you want to delete this action plan?")) {
    $(this).closest("li").remove();
  }
});
*/
