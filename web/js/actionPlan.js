var ajax = new XMLHttpRequest();
var method = "GET";
var urlString = window.location.search;
var param = new URLSearchParams(urlString);
var queryID = parseInt(param.get("goal_id"));
var queryName = param.get("goal_name");
var url = "action-main-data.php?goal_id=" + queryID;
var asyn = true;
var modal;
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
                  <p class="detail">Action plan details here</p>
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
    urlPath.parentNode.href =
      "action-main-add.php?goal_name=" + queryName + "&goal_id=" + queryID;
    var html = document.querySelector("#starting");
    html.innerHTML += "<ul>";
    for (i = 0; i < data.length; i++) {
      html.innerHTML +=
        `
      <li class="card shadow col-3 m-3" style="width: 30%; max-width: 100%">
                    <div class="row">
                      <div class="col-1">
                        <a
                          href="action-main-edit.php?goal_name=${queryName}&goal_id=${queryID}&ap_id=${data[i].ap_id}"
                          style="text-decoration: none"
                        >
                          <button style="border: none; background: none;">
                            <i class="bi-pencil" style="font-size: 1.5vw;"></i>
                          </button>
                        </a>
                      </div>
                      <div class="col-1">
                          <button
                            class="deleteAP"
                            name="${data[i].ap_id}"
                            style="border: none; background: none;"
                            onclick="handleDelete(${data[i].ap_id})"
                          >
                            <i class="bi-trash-fill" style="font-size: 1.5vw;"></i>
                          </button>
                      </div>
                    </div>
                    <img
                      style="width: 100%; height:15vw;"
                      class="card-img-top"
                      src=` +
        data[i].ap_image +
        `
                    />
                    <div class="card-body" style="line-height: 1em;">
                      <a
                        href="activity.php?ap_name=${data[i].ap_title}&ap_id=${data[i].ap_id}" 
                        style="text-decoration: none; font-size: 1.5vw;"
                        class="card-text"
                        >` +
        data[i].ap_title +
        `</a
                      >
                      <p class="card-text" style="font-size: 1vw;">Due ` +
        data[i].ap_due_date +
        `</p>
                    </div>
                  </li>
      `;
    }
    html.innerHTML += "</div></ul>";
    html.innerHTML += modalHTML;
    modal = bootstrap.Modal.getOrCreateInstance(
      document.querySelector("#deleteModal")
    );
    document.querySelector(".loader").style.display = "none";

    //delete funtion
    var elem = document.querySelectorAll(".deleteAP");
    var key = document.querySelector(".deleteButton");
    for (let i = 0; i < elem.length; i++) {
      elem[i].addEventListener("click", function (e) {
        showModal();
        let id = elem[i]["name"];
        key.addEventListener("click", function () {
          location.href = "action-main-delete.php?ap_id=" + id;
          this.closest("div").querySelector(".cancelButton").click();
        });
      });
    }
  }

  function showModal() {
    modal.show();
  }
};
