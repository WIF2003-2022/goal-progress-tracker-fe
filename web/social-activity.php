<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/social-activity.css" />
    <title>Your Mentee/Mentor: Activity</title>
  </head>

  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container">
          <div class="row">
            <h2>
              "Learn Korean Language in 6 Months" - "Search Web for Korean
              Language Courses"
            </h2>
          </div>
          <ul>
            <li class="card text-center">
              <!-- activity -->
              <div class="card-header">Due 31/12/2021</div>
              <div class="card-body">
                <h5 class="card-title">Study Using Udemy for 1 Hour a Day</h5>
                <p class="card-text">Description...</p>
                <p class="card-text">1 time(s) per 1 day(s)</p>
                <div class="mb-3">
                  <script>
                    for (i = 0; i < 5; i++) {
                      document.write(
                        "<i class='bi-star-fill' style='color: red; font-size: 1.2rem'></i>"
                      );
                    }
                  </script>
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
                        class="progress-bar bg-danger progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        aria-valuenow="75"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 75%"
                      >
                        75%
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="progress">
                      <div
                        class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        aria-valuenow="75"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 75%"
                      >
                        75%
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- comment -->

              <div class="row p-3 text-start">
                <div class="col parent-comment">
                  <div class="p-3">
                    <h2>Comments</h2>
                  </div>
                  <!-- display comment -->
                  <div class="mt-2">
                    <div class="d-flex flex-row p-3">
                      <img
                        src="././images/sampleProfilePic.jpg"
                        width="40"
                        height="40"
                        class="rounded-circle mr-3"
                      />
                      <div class="w-100">
                        <div
                          class="d-flex justify-content-between align-items-center"
                        >
                          <div class="d-flex flex-row align-items-center">
                            <!-- name -->
                            <span class="mr-2">Christian Louboutin</span>
                            <!-- role -->
                            <small class="y-badge"
                              ><span class="px-3">You</span></small
                            >
                          </div>
                          <!-- time -->
                          <small>12h ago</small>
                        </div>
                        <p class="text-justify comment-text mb-0">
                          If you are a fast-learner yourself and are able to
                          learn comfortably at this pace, I suggest you to
                          increase the time to 1.5 hours daily.
                        </p>
                        <div class="d-flex flex-row user-feed">
                          <span class="wish"
                            ><i class="bi bi-pin mr-2"></i
                          ></span>
                          <span class="ml-3"
                            ><i class="fa fa-comments-o mr-2"></i>Reply</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-2">
                    <div class="d-flex flex-row p-3">
                      <img
                        src="././images/sampleProfilePic.jpg"
                        width="40"
                        height="40"
                        class="rounded-circle mr-3"
                      />
                      <div class="w-100">
                        <div
                          class="d-flex justify-content-between align-items-center"
                        >
                          <div class="d-flex flex-row align-items-center">
                            <!-- name -->
                            <span class="mr-2">Joshua</span>
                            <!-- role -->
                            <small class="o-badge"
                              ><span class="px-3">Mentee</span></small
                            >
                          </div>
                          <!-- time -->
                          <small>4h ago</small>
                        </div>
                        <p class="text-justify comment-text mb-0">
                          Alright mentor, I will try to adjust that according to
                          my current pace.
                        </p>
                        <div class="d-flex flex-row user-feed">
                          <span class="wish"
                            ><i class="bi bi-pin mr-2"></i
                          ></span>
                          <span class="ml-3"
                            ><i class="fa fa-comments-o mr-2"></i>Reply</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- comment box -->
                  <div
                    class="mt-3 d-flex flex-row align-items-center p-3 form-color before-comment"
                  >
                    <img
                      src="././images/sampleProfilePic.jpg"
                      width="50"
                      height="50"
                      class="rounded-circle mr-2"
                    />
                    <input
                      type="text"
                      class="form-control comment-typed"
                      placeholder="Leave your comment..."
                    />
                  </div>
                </div>
                <!-- button -->
                <div class="text-end mt-3">
                  <button type="button" class="btn btn-success">
                    Post Comment
                  </button>
                </div>
              </div>
              <!-- end comment -->
            </li>
            <!-- end activity -->
            <br />
            <li class="card text-center">
              <!-- activity -->
              <div class="card-header">Due 12/31/2022</div>
              <div class="card-body">
                <h5 class="card-title">
                  Learn by Watching Youtube Channel( Prof. Yoon's Korean
                  Language Class)
                </h5>
                <p class="card-text">Description...</p>
                <p class="card-text">1 time(s) per 1 day(s)</p>
                <div class="mb-3">
                  <script>
                    for (i = 0; i < 4; i++) {
                      document.write(
                        "<i class='bi-star-fill' style='color: red; font-size: 1.2rem'></i>"
                      );
                    }
                  </script>
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
                        class="progress-bar bg-danger progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        aria-valuenow="75"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 75%"
                      >
                        75%
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="progress">
                      <div
                        class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        aria-valuenow="75"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 75%"
                      >
                        75%
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- comment -->

              <div class="row p-3 text-start">
                <div class="col parent-comment">
                  <div class="p-3">
                    <h2>Comments</h2>
                  </div>
                  <!-- display comment -->
                  <div class="mt-2">
                    <div class="d-flex flex-row p-3">
                      <img
                        src="././images/sampleProfilePic.jpg"
                        width="40"
                        height="40"
                        class="rounded-circle mr-3"
                      />
                      <div class="w-100">
                        <div
                          class="d-flex justify-content-between align-items-center"
                        >
                          <div class="d-flex flex-row align-items-center">
                            <!-- name -->
                            <span class="mr-2">Christian Louboutin</span>
                            <!-- role -->
                            <small class="y-badge"
                              ><span class="px-3">You</span></small
                            >
                          </div>
                          <!-- time -->
                          <small>14h ago</small>
                        </div>
                        <p class="text-justify comment-text mb-0">
                          This is an excellent channel to learn Korean language
                          as a begineer. Keep up the good work, the progress is
                          looking good too!
                        </p>
                        <div class="d-flex flex-row user-feed">
                          <span class="wish"
                            ><i class="bi bi-pin mr-2"></i
                          ></span>
                          <span class="ml-3"
                            ><i class="fa fa-comments-o mr-2"></i>Reply</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-2">
                    <div class="d-flex flex-row p-3">
                      <img
                        src="././images/sampleProfilePic.jpg"
                        width="40"
                        height="40"
                        class="rounded-circle mr-3"
                      />
                      <div class="w-100">
                        <div
                          class="d-flex justify-content-between align-items-center"
                        >
                          <div class="d-flex flex-row align-items-center">
                            <!-- name -->
                            <span class="mr-2">Joshua</span>
                            <!-- role -->
                            <small class="o-badge"
                              ><span class="px-3">Mentee</span></small
                            >
                          </div>
                          <!-- time -->
                          <small>2h ago</small>
                        </div>
                        <p class="text-justify comment-text mb-0">
                          Thanks for the compliment on my progress, I will try
                          my best to maintain my progress for these 6 months.
                        </p>
                        <div class="d-flex flex-row user-feed">
                          <span class="wish"
                            ><i class="bi bi-pin mr-2"></i
                          ></span>
                          <span class="ml-3"
                            ><i class="fa fa-comments-o mr-2"></i>Reply</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- comment box -->
                  <div
                    class="mt-3 d-flex flex-row align-items-center p-3 form-color before-comment"
                  >
                    <img
                      src="././images/sampleProfilePic.jpg"
                      width="50"
                      height="50"
                      class="rounded-circle mr-2"
                    />
                    <input
                      type="text"
                      class="form-control comment-typed"
                      placeholder="Leave your comment..."
                    />
                  </div>
                </div>
                <!-- button -->
                <div class="text-end mt-3">
                  <button type="button" class="btn btn-success">
                    Post Comment
                  </button>
                </div>
              </div>
              <!-- end comment -->
            </li>
            <!-- end activity -->
            <br />
          </ul>
        </div>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script>
      const commentButton = document.querySelectorAll(".btn-success");
      const beforeComment = document.querySelectorAll(".before-comment");
      const parentComment = document.querySelectorAll(".parent-comment");
      const commentTyped = document.querySelectorAll(".comment-typed");
      for (let i = 0; i < commentButton.length; i++) {
        commentButton[i].addEventListener("click", () => {
          const newComment = document.createElement("comment");
          newComment.innerHTML = `
          <div class="mt-2">
            <div class="d-flex flex-row p-3">
              <img
                src="././images/sampleProfilePic.jpg"
                width="40"
                height="40"
                class="rounded-circle mr-3"
              />
              <div class="w-100">
                <div
                  class="d-flex justify-content-between align-items-center"
                >
                  <div class="d-flex flex-row align-items-center">
                    <span class="mr-2">Christian Louboutin</span>
                    <small class="y-badge"
                      ><span class="px-3">You</span></small
                    >
                  </div>
                  <small>Just now</small>
                </div>
                <p class="text-justify comment-text mb-0">
                  ${commentTyped[i].value}
                </p>
                <div class="d-flex flex-row user-feed">
                  <span class="wish"
                    ><i class="bi bi-pin mr-2"></i
                  ></span>
                  <span class="ml-3"
                    ><i class="fa fa-comments-o mr-2"></i>Reply</span
                  >
                </div>
              </div>
            </div>
          </div>
          `;
          parentComment[i].insertBefore(newComment, beforeComment[i]);
          commentTyped[i].value = null;
        });
      }
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

    <script src="./js/navbar.js"></script>
  </body>
</html>