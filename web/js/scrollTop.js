var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 200 ||
    document.documentElement.scrollTop > 200
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// if (window.history.replaceState) {
//   window.history.replaceState(null, null, window.location.href);
// }
// const commentButton = document.querySelectorAll(".btn-success");
// const beforeComment = document.querySelectorAll(".before-comment");
// const parentComment = document.querySelectorAll(".parent-comment");
// const commentTyped = document.querySelectorAll(".comment-typed");
// var commentNumber = "";
// var commentText = "";

// for (let i = 0; i < commentButton.length; i++) {
//   commentButton[i].addEventListener("click", (e) => {
//     // e.preventDefault();
//     commentNumber = i;
//     commentText = commentTyped[i].value;
//     // const newComment = document.createElement("comment");
//     // newComment.innerHTML = `
//     //     <div class="mt-2">
//     //       <div class="d-flex flex-row p-3">
//     //         <img
//     //           src="././images/sampleProfilePic.jpg"
//     //           width="40"
//     //           height="40"
//     //           class="rounded-circle mr-3"
//     //         />
//     //         <div class="w-100">
//     //           <div
//     //             class="d-flex justify-content-between align-items-center"
//     //           >
//     //             <div class="d-flex flex-row align-items-center">
//     //               <span class="mr-2">Christian Louboutin</span>
//     //               <small class="y-badge"
//     //                 ><span class="px-3">You</span></small
//     //               >
//     //             </div>
//     //             <small>Just now</small>
//     //           </div>
//     //           <p class="text-justify comment-text mb-0">
//     //             ${commentTyped[i].value}
//     //           </p>
//     //           <div class="d-flex flex-row user-feed">
//     //             <span class="wish"
//     //               ><i class="bi bi-pin mr-2"></i
//     //             ></span>
//     //             <span class="ml-3"
//     //               ><i class="fa fa-comments-o mr-2"></i>Reply</span
//     //             >
//     //           </div>
//     //         </div>
//     //       </div>
//     //     </div>
//     //     `;
//     // parentComment[i].insertBefore(newComment, beforeComment[i]);
//     // commentTyped[i].value = null;
//     console.log("no.:" + commentNumber);
//     console.log("text: " + commentText);
//     url = window.location.search;
//     $.ajax({
//       type: "POST",
//       url: url,
//       data: {
//         number: commentNumber,
//         commentText: commentText,
//       },
//       success: function (data) {
//         console.log(data);
//       },
//       error: function (xhr, status, error) {
//         console.error(xhr);
//       },
//     });
//   });
// }
