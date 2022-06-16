var ajax = new XMLHttpRequest();
var method = "GET";
var url = "action-main-data.php";
var asyn = true;

ajax.open(method, url, asyn);
ajax.send();
html = "";
ajax.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    var data = JSON.parse(this.responseText);
    console.log(data);
    for (i = 0; i < data.length; i++) {
      document.write(
        `
      <li class="card col-3 m-3 shadow" style="width: 33%; max-width: 100%">
                    <div class="row">
                      <div class="col-1">
                        <a
                          href="action-main-edit.html?id=` +
          data[i].ap_id +
          `"
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
                          data-bs-toggle="modal"
                          data-bs-target="#deleteModal"
                          style="border: none; background: none;"
                        >
                          <i class="bi-trash-fill" style="font-size: 1.5vw;"></i>
                        </button>
                      </div>
                    </div>
                    <img
                      style="width: 100%; height:auto;"
                      class="card-img-top"
                      src=` +
          data[i].ap_image +
          `
                    />
                    <div class="card-body" style="line-height: 1em;">
                      <a
                        href="activity.html?id=` +
          data[i].goal_id +
          "&refer=" +
          data[i].ap_id +
          `"
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
      `
      );
    }
    document.write("</div></ul>");
  }
};

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
