var elem = document.querySelectorAll(".tick");
var percentage = document.querySelectorAll(".progress");
var fail = document.querySelectorAll(".due");

for (i = 0; i < elem.length; i++) {
  if (fail[i].ariaValueNow >= 100) {
    console.log(fail[i]);
    elem[i].closest("li").querySelector(".complete").innerHTML =
      "<strong>FAILED</strong>";
  }
  elem[i].addEventListener("click", function () {
    if (
      this.checked &&
      confirm("Are you sure you have completed this activity?")
    ) {
      var x = this.closest("li").querySelector(".finish");
      a = Number(x.ariaValueNow);
      b = Number(15);
      c = a + b;
      x.ariaValueNow = c;
      x.style.width = c + "%";
      x.innerText = c + "%";
      this.closest("li").querySelector(".tick").checked = false;
      if (c >= 100) {
        this.closest("li").querySelector(".complete").innerHTML =
          "<strong>COMPLETED</strong>";
      } else {
        this.closest("li").querySelector(".tick").disabled = true;
      }
    } else {
      this.checked = false;
    }
  });
}
