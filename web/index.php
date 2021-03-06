<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css" />
  <link rel="stylesheet" href="./styles/index.css" />
  <link rel="stylesheet" href="./styles/home.css" />
  <title>Goal Progress Tracker</title>
</head>

<body>
  <?php 
      require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
    ?>
  <div class="wrapper">
    <nav-bar></nav-bar>
    <div class="content-wrapper">
      <div class="container p-4">
        <div class="row g-3">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-lg-8 d-flex flex-column right-border">
                    <blockquote class="blockquote">
                      <div class="text-area">
                        <i class="bi bi-quote"></i>
                        <p class="quote">A well-known quote</p>
                        <footer class="blockquote-footer text-end">
                          <cite class="author">Source</cite>
                        </footer>
                      </div>
                      <div class="position-absolute top-0 end-0">
                        <button class="refresh-btn" type="button">
                          <i class="bi bi-arrow-clockwise"></i>
                        </button>
                      </div>
                    </blockquote>
                  </div>
                  <form class="col d-flex flex-column m-2" id="quote-form">
                    <div class="mb-3 flex-grow-1">
                      <textarea class="form-control h-100" id="custom-quote"
                        placeholder="Write something to motivate yourself..." required></textarea>
                    </div>
                    <div>
                      <button class="btn btn-primary w-100 post-btn" type="submit">
                        Post
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card goal-card"></div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card goal-card"></div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card goal-card"></div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card goal-card"></div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card reminder">
              <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center">
                  <h3 class="card-title">Reminders</h3>
                  <button class="card-title edit-btn ms-2 invisible" type="button">
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                </div>
                <div class="accordion p-2" id="reminders">
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#today">
                        Today
                      </button>
                    </h2>
                    <div id="today" class="accordion-collapse collapse show" data-bs-parent="#reminders">
                      <div class="list-group">
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#tomorrow">
                        Tomorrow
                      </button>
                    </h2>
                    <div id="tomorrow" class="accordion-collapse collapse" data-bs-parent="#reminders">
                      <div class="list-group"></div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#upcoming">
                        Upcoming
                      </button>
                    </h2>
                    <div id="upcoming" class="accordion-collapse collapse" data-bs-parent="#reminders">
                      <div class="list-group"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h3 class="card-title">Activities</h3>
                  <button class="card-title edit-btn ms-2 invisible" type="button">
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                </div>
                <div class="p-2" id="calendar"></div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Reminder</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <h6>Are you sure you want to delete this reminder?</h6>
                  <p><i>The details of the reminder...</i></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger">Delete</button>
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="chooseGoal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Select A Goal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="list-group"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <script src="./js/authListener.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./js/navbar.js"></script>
  <script src="./js/home.js"></script>
</body>

</html>