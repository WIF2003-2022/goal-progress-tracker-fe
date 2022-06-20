var ajax = new XMLHttpRequest();
var method = "GET";
var urlString = window.location.search;
var param = new URLSearchParams(urlString);
var queryID = parseInt(param.get("ap_id"));
var queryName = param.get("ap_name");
var url = "activity-data.php?ap_id=" + queryID;
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

var newAjax = new XMLHttpRequest();
var newURL = "activity-action-main-data.php?ap_id=" + queryID;
newAjax.open(method, newURL, asyn);
newAjax.send();
newAjax.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    var data = JSON.parse(this.responseText);
    console.log(data);
    var elem = document.querySelector(".ap");
    for (i = 0; i < data.length; i++) {
      elem.innerHTML +=
        `<ul><li class="card text-center mb-2 style="width:auto;"">
                    <div class="card-header text-start">Start Date: ${data[i].ap_start_date}<span class="float-end text-danger">Due Date: ${data[i].ap_due_date}</span></div>
                    <div class="card-body">
                      <h5 class="card-title">` +
        data[i].ap_title +
        `</h5>
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
        calculateDue(data[i].ap_start_date, data[i].ap_due_date) +
        `"
                              aria-valuemin="0"
                              aria-valuemax="100"
                              style="width: ` +
        calculateDue(data[i].ap_start_date, data[i].ap_due_date) +
        `%"
                            >
                            ` +
        calculateDue(data[i].ap_start_date, data[i].ap_due_date) +
        `%
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="progress">
                            <div
                              class="progress-bar bg-success progress-bar-striped progress-bar-animated avgPercentage"
                              role="progressbar"
                              aria-valuenow="` +
        0 +
        `"
                              aria-valuemin="0"
                              aria-valuemax="100"
                              style="width: ` +
        0 +
        `%"
                            >
                            ` +
        0 +
        `%
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  </ul>
      `;
    }
  }
  function calculateDue(start_date, due_date) {
    var diff = Math.floor(
      ((new Date().valueOf() - new Date(start_date).valueOf()) /
        (new Date(due_date).valueOf() - new Date(start_date).valueOf())) *
        100
    );
    if (diff < 0) {
      return 0;
    } else if (diff > 100) return 100;
    else return diff;
  }
};

ajax.open(method, url, asyn);
ajax.send();
ajax.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    var data = JSON.parse(this.responseText);
    console.log(data);
    var title = document.querySelector(".title");
    title.innerHTML = queryName;
    var urlPath = document.querySelector(".add");
    urlPath.parentNode.href =
      "activity-add.php?ap_name=" + queryName + "&ap_id=" + queryID;
    var html = document.querySelector(".starting");
    var totalPercentage = 0;
    for (i = 0; i < data.length; i++) {
      totalPercentage += parseFloat(data[i].a_complete);
      html.innerHTML +=
        `
      <ul>
      <li class="card text-center mb-2">
                    <div class="card-header text-start">Start Date: ${data[i].a_start_date}<span class="float-end text-danger">Due Date: ${data[i].a_due_date}</span></div>
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
                      <div class="mb-3 star"></div>
                      <a href="activity-edit.php?ap_name=${queryName}&ap_id=${queryID}&a_id=${data[i].a_id}" style="text-decoration: none">
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
                        <input class="form-check-input tick" type="checkbox" name="${data[i].a_id}">
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
        calculateDue(data[i].a_start_date, data[i].a_due_date) +
        `"
                              aria-valuemin="0"
                              aria-valuemax="100"
                              style="width: ` +
        calculateDue(data[i].a_start_date, data[i].a_due_date) +
        `%"
                            >
                            ` +
        calculateDue(data[i].a_start_date, data[i].a_due_date) +
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
        data[i].a_complete +
        `"
                              aria-valuemin="0"
                              aria-valuemax="100"
                              style="width: ` +
        data[i].a_complete +
        `%"
                            >
                            ` +
        data[i].a_complete +
        `%
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
      `;
    }

    html.innerHTML += modalHTML;
    modal = bootstrap.Modal.getOrCreateInstance(
      document.querySelector("#deleteModal")
    );

    function calculateDue(start_date, due_date) {
      var diff = Math.floor(
        ((new Date().valueOf() - new Date(start_date).valueOf()) /
          (new Date(due_date).valueOf() - new Date(start_date).valueOf())) *
          100
      );
      if (diff < 0) {
        return 0;
      } else if (diff > 100) return 100;
      else return diff;
    }

    //AP progress
    var avgPercentage = Math.floor((totalPercentage / data.length) * 100) / 100;
    var elem = document.querySelector(".avgPercentage");
    console.log(elem);
    elem.ariaValueNow = avgPercentage;
    elem.style.width = String(avgPercentage) + "%";
    elem.innerText = String(avgPercentage) + "%";

    //star function
    var elem = document.querySelectorAll(".star");
    for (let i = 0; i < elem.length; i++) {
      for (let j = 0; j < data[i].a_priority; j++) {
        elem[i].innerHTML +=
          "<i class='bi-star-fill' style='color: red; font-size: 2vw'></i>";
      }
    }

    //delete funtion
    var elem = document.querySelectorAll(".deleteAct");
    var key = document.querySelector(".deleteButton");
    for (let i = 0; i < elem.length; i++) {
      elem[i].addEventListener("click", function (e) {
        showModal();
        let id = elem[i]["name"];
        key.addEventListener("click", function () {
          location.href = "activity-delete.php?a_id=" + id;
          this.closest("div").querySelector(".cancelButton").click();
        });
      });
    }

    //complete function
    var elem = document.querySelectorAll(".tick");
    var fail = document.querySelectorAll(".due");
    var pass = document.querySelectorAll(".finish");

    for (let i = 0; i < elem.length; i++) {
      if (fail[i].ariaValueNow <= 0) {
        elem[i].closest("li").querySelector(".complete").innerHTML =
          "<strong style='color:gold'>TO BE STARTED</strong>";
        continue;
      }
      if (fail[i].ariaValueNow >= 100) {
        elem[i].closest("li").querySelector(".complete").innerHTML =
          "<strong style='color:red'>FAILED</strong>";
      } else if (pass[i].ariaValueNow == 100) {
        elem[i].closest("li").querySelector(".complete").innerHTML =
          "<strong style='color:green'>COMPLETED</strong>";
      }
      if (
        data[i].a_click <
        Math.ceil(
          (new Date().valueOf() - new Date(data[i].a_start_date).valueOf()) /
            1000 /
            60 /
            60 /
            24
        ) *
          data[i].a_times
      ) {
        elem[i].disabled = false;
      } else {
        elem[i].disabled = true;
      }
      elem[i].addEventListener("click", function () {
        let id = elem[i]["name"];
        if (
          this.checked &&
          confirm("Are you sure you have completed this activity?")
        ) {
          var x = this.closest("li").querySelector(".finish");
          a = parseFloat(x.ariaValueNow);
          b = parseFloat((1 / data[i].a_max_click) * 100);
          c = parseFloat(Math.floor((a + b) * 100) / 100);
          x.ariaValueNow = c;
          x.style.width = c + "%";
          x.innerText = c + "%";
          this.closest("li").querySelector(".tick").checked = false;
          if (c > 99) {
            x.ariaValueNow = 100;
            x.style.width = 100 + "%";
            x.innerText = 100 + "%";
            location.href =
              "activity-complete.php?a_id=" + id + "&a_complete=100";
            this.closest("li").querySelector(".complete").innerHTML =
              "<strong>COMPLETED</strong>";
          } else {
            location.href =
              "activity-complete.php?a_id=" + id + "&a_complete=" + c;
          }
        } else {
          this.checked = false;
        }
      });
    }
  }
  function showModal() {
    modal.show();
  }
};
