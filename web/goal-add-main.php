<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Goals</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/goal.css" />
  </head>

  <body>
    <?php
      require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
      // current user data already saved in session
      // so you can just retrieve them from the session
      session_start();
      $userStr = $_SESSION['auth'];
      // getting from session would be a string
      // need to decode to get the class/object
      $user = json_decode($userStr);
      $userid = json_decode($userStr, true)["user_id"];
      if (!$user) {
          header("Location: ./login.php"); //change location of http header to login.php
      }
    ?>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container-float">
          <div class="row m-2">
            <div class="col-md-4">
              <div class="smart">
                <div class="card">
                  <h2>SMART goal</h2>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 align-self-center">
                  <div class="smartGoal">
                    <div class="card">
                      <div class="specific">Specific</div>
                    </div>
                  </div>
                </div>
                <!-- End of Left Column (SMART) -->

                <div class="col-md-8">
                  <div class="question">
                    <div class="card">
                      <div class="questionSpecific">
                        What do I want to accomplish? <br />
                        Why do I want to accomplish this? <br />
                        What are the requirements? <br />
                        What are the constrainsts?
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Question Column -->
              </div>

              <div class="row">
                <div class="col-md-4 align-self-center">
                  <div class="smartGoal">
                    <div class="card">
                      <div class="measurable">Measurable</div>
                    </div>
                  </div>
                </div>
                <!-- End of Left Column (SMART) -->

                <div class="col-md-8">
                  <div class="question">
                    <div class="card">
                      <div class="questionMeasurable>">
                        How will I measure my progress? <br />
                        How will I know when the goal is accomplished?
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Question Column -->
              </div>

              <div class="row">
                <div class="col-md-4 align-self-center">
                  <div class="smartGoal">
                    <div class="card">
                      <div class="achievable">Achievable</div>
                    </div>
                  </div>
                </div>
                <!-- End of Left Column (SMART) -->

                <div class="col-md-8">
                  <div class="question">
                    <div class="card">
                      <div class="questionAchievable>">
                        How can the goal be accomplished?<br />
                        What are the logical steps I should take?
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Question Column -->
              </div>

              <div class="row">
                <div class="col-md-4 align-self-center">
                  <div class="smartGoal">
                    <div class="card">
                      <div class="relevant">Relevant</div>
                    </div>
                  </div>
                </div>
                <!-- End of Left Column (SMART) -->

                <div class="col-md-8">
                  <div class="question">
                    <div class="card">
                      <div class="questionRelevant>">
                        Is this a worthwhile goal?<br />
                        Is this the right time?<br />
                        Do I have neccessary resources to accomplish this
                        goal?<br />
                        Is this goal in line with my long term objectives?
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Question Column -->
              </div>

              <div class="row justify-content-center">
                <div class="col-md-4 align-self-center">
                  <div class="smartGoal">
                    <div class="card">
                      <div class="timeBound">Time-Bound</div>
                    </div>
                  </div>
                </div>
                <!-- End of Left Column (SMART) -->

                <div class="col-md-8">
                  <div class="question">
                    <div class="card">
                      <div class="questionTimeBound>">
                        How long will it take to accomplish this goal?<br />
                        What is the completion of this goal due? When am I going
                        to work on this goal?
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Question Column -->
              </div>
            </div>
            <!-- End of Left Column -->

            <div class="col-md-8 mb-4">
              <div class="addNewGoal">
                <div class="heading">Add Goal</div>
                <form id="addGoal" class="row g-3">
                  <div class="col-md-8">
                    <label for="goalTitle" class="form-label">Goal Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="goalTitle"
                      placeholder="Eg: Run 100km in 5 weeks"
                      required
                    />
                    <div class="invalid-feedback">
                      Please enter a goal tilte
                    </div>
                  </div>

                  <div class="col-md-8">
                    <label for="specificTarget" class="form-label"
                      >Specific and Measurable Target</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="specificTarget"
                      placeholder="Eg: 100km"
                      required
                    />
                  </div>

                  <div class="col-md-6">
                    <label for="inputStartDate" class="form-label"
                      >Start Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      id="inputStartDate"
                      required
                    />
                  </div>

                  <div class="col-md-6">
                    <label for="inputEndDate" class="form-label"
                      >End Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      id="inputEndDate"
                      required
                    />
                  </div>

                  <fieldset>
                    <legend class="col-form-label col-md-8">
                      Track Progress By
                    </legend>
                    <div class="col-md-8 mb-2">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="trackProgress1"
                        />
                        <label class="form-check-label" for="trackProgress1">
                          Final outcome
                        </label>
                      </div>
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="trackProgress2"
                        />
                        <label class="form-check-label" for="trackProgress12">
                          Total number of completed activities
                        </label>
                      </div>
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="trackProgress3"
                        />
                        <label class="form-check-label" for="trackProgress3">
                          Manually updating current progress
                        </label>
                      </div>
                    </div>
                  </fieldset>
                  <div class="col-md-8 mb-2">
                    <label for="description" class="form-label"
                      >Description</label
                    >
                    <textarea
                      class="form-control"
                      id="description"
                      rows="4"
                      placeholder="Optional"
                    ></textarea>
                  </div>
                  <div class="col-md-6">
                    <select
                      class="form-select"
                      id="category"
                      aria-label="Select Category"
                      required
                    >
                      <option selected value="">Category</option>
                      <option value="1">Personal</option>
                      <option value="2">Health</option>
                      <option value="3">School</option>
                      <option value="3">Family</option>
                      <option value="3">Skill</option>
                    </select>
                  </div>

                  <div class="col-md-8 mb-3">
                    <label for="findMentor" class="form-label"
                      >Find Mentor</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="mentor"
                      placeholder="Enter mentor's username or email"
                    />
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                <!-- End of Form-->
              </div>
            </div>
            <!-- End of Right Column -->
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script type="text/javascript">
      console.log("Test1");
      // function to add goal into the database, '#addGoal' is the id of the form
      // $(selector).on(event,childSelector,function) - to add goal upon the submit button being pressed
      // e is the short var reference for event object which will be passed to event handlers.
      $(document).on('submit', '#addGoal', function(e) {
        console.log("Test2");
        e.preventDefault();     //cancel the default action of an event
        var title = $('#goalTitle').val();  // .val() returns the value attribute from the form
        var target = $('#specificTarget').val();
        var startDate = $('#inputStartDate').val();
        var endDate = $('#inputEndDate').val();
        var trackProgress1 = $('#trackProgress1').val();
        var trackProgress2 = $('#trackProgress2').val();
        var trackProgress3 = $('#trackProgress3').val();
        var tracking = trackProgress1 + trackProgress2 + trackProgress3;
        var description = $('#description').val();
        var category = $('#category').val();
        var mentor = $('#mentor').val();
        var mentee = <?php echo json_encode($userid); ?>;
        console.log("Test3");
        if (title != '' && target != '' && startDate != '' && endDate != '' && tracking != '' && category != '') {
          console.log("Test4");
          $.ajax({                              //$.ajax({}) - perform an AJAX (asynchronous HTTP) request
            url: "goal-add-process.php",       // url - Specifies the URL to send the request to. Default is the current page
            type: "post",                      // type - Specifies the type of request. (GET or POST)
            data: {                            // data - spscifies data to be sent to server
              title: title,
              startDate: startDate,
              endDate: endDate,
              tracking: tracking,
              // description: description,
              category: category,
              mentor: mentor,
              mentee: mentee
            },
            success: function(data) {               //success - A function to be run when the request succeeds
              console.log("Test6");
              console.log(data);
              var json = JSON.parse(data);          // parse the string data into javascript object
              var status = json.status;             // used to indicate either that a JSON PARSE statement executed successfully or that a nonexception condition occurred during the JSON parse operation
              if (status == 'true') {
                window.location.href = "goal.php";
              } else {
                alert('failed');
              }
            }
          });
        } else {
          alert('Fill all the required fields');
        }
      });
    </script>

    <script src="./js/authListener.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="./js/navbar.js"></script>
  </body>
</html>
