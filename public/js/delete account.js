// Call function when delete account button is clicked
document.getElementById("deletebutton").onclick = function(){show_dialog()};
var overlayme = document.getElementById("dialog-container");

/* A function to show the dialog window */
function show_dialog(){
    overlayme.style.display = "block";
}

// If ok btn is clicked , the function ok() is executed
document.getElementById("confirm").onclick = function(){confirm()};
var overlayagain = document.getElementById("message");
function confirm(){
    /* code executed if confirm is clicked */  
    overlayagain.style.display = "block";
}

document.getElementById("close").onclick = function(){close()};
function close(){
    location.replace("register.html")
}

// If cancel btn is clicked , the function cancel() is executed
document.getElementById("cancel").onclick = function(){cancel()};
function cancel() {
 /* code executed if cancel is clicked */  
    overlayme.style.display = "none";
}