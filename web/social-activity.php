<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/index.css" />
  <link rel="stylesheet" href="./styles/social-activity.css" />
  <title>
    <?php echo (($_GET['role']=="Mentor" ) ? "Mentee: Your Mentee's Activity" :"Mentor: My Activity"); ?>
  </title>
</head>

<body>
  <div class="wrapper">
    <nav-bar></nav-bar>
    <div class="content-wrapper">
      <div class="container">

        <div class="row">
          <?php
            require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");

            $stmt = $conn->prepare(
              "SELECT ap_title from `action plan` WHERE ap_id = ?"
            );
            $stmt->bind_param("i", $_GET['actionplanID']);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            echo '<h2>"'.$row['ap_title'].'" - Action Plan</h2>'
          ?>
        </div>

        <ul>
          <?php
            session_start();
            require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
            
            $userID = json_decode($_SESSION['auth'],true)['user_id'];

            if (isset($_POST['commentText'])){
              // update database
              echo $_POST['commentText'];
            }else{
              echo "hi";
            }        

            $haveAct = false;
            $stmt = $conn->prepare(
              "SELECT * from activity WHERE ap_id = ?"
            );
            $stmt->bind_param("i", $_GET['actionplanID']);
            $stmt->execute();
            $result = $stmt->get_result();
            // echo json_encode($result);
            
            while ($row = $result->fetch_assoc()) {
              // echo 'ap_id: '.$row['ap_id'].'</br>';
              // echo 'a_id: '.$row['a_id'].'</br>';
              $haveAct = true;
              $html = '';
              $html .= '<!-- activity -->
              <li class="card text-center">
              <div class="card-header">'.$row['a_due_date'].'</div>
              <div class="card-body">
                <h5 class="card-title">'.$row['a_title'].'</h5>
                <p class="card-text">'.$row['a_description'].'</p>
                <p class="card-text">'.$row['a_times'].' time(s) per '.$row['a_days'].' day(s)</p>
                <div class="mb-3">';
              for ($i = 0; $i < $row['a_priority']; $i++) {
                $html .= '<i class="bi-star-fill" style="color: red; font-size: 1.2rem"></i>';
              }
                  
              $html .= '
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
                      <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        75%
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="progress">
                      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        75%
                      </div>
                    </div>
                  </div>
                </div>
              </div>';

              //comment title
              $html .= '
              <div class="row p-3 text-start">
                <div class="col parent-comment">
                  <div class="p-3">
                    <h2>Comments</h2>
                  </div>';

              $stmt1 = $conn->prepare(
                "SELECT * from comment WHERE a_id = ?"
              );
              $stmt1->bind_param("i", $row['a_id']);
              $stmt1->execute();
              $result1 = $stmt1->get_result();
              while ($row1 = $result1->fetch_assoc()) {
                // echo 'c_id:'.$row1['comment_id'].'</br>';
                //display comment
                $stmt2 = $conn->prepare(
                  "SELECT name from user WHERE user_id = ?"
                );
                $stmt2->bind_param("i", $row1['commentor_id']);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $row2 = $result2->fetch_assoc();
                ($_GET['role'] == 'Mentor') ? $other = 'Mentee' : $other = 'Mentor';
                ($userID == $row1['commentor_id']) ? $roleLabel = "You" : $roleLabel = $other;
                // echo $row2['name'].'</br>';
                $html .= '
                  <div class="mt-2">
                    <div class="d-flex flex-row p-3">
                      <img src="././images/sampleProfilePic.jpg" width="40" height="40" class="rounded-circle mr-3" />
                      <div class="w-100">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex flex-row align-items-center">
                            <!-- name -->
                            <span class="mr-2">'.$row2['name'].'</span>
                            <!-- role -->
                            <small class="'.(($roleLabel == "You")? 'y':'o').'-badge"><span class="px-3">'.$roleLabel.'</span></small>
                          </div>
                          <!-- time -->
                          <small>12h ago</small>
                        </div>
                        <p class="text-justify comment-text mb-0">'.$row1["comment_text"].'</p>
                        <div class="d-flex flex-row user-feed">
                          <!-- <span class="wish"><i class="bi bi-pin mr-2"></i></span> -->
                        </div>
                      </div>
                    </div>
                  </div>';
              }
                $html .= '<!-- comment box -->
                          <div class="mt-3 d-flex flex-row align-items-center p-3 form-color before-comment">
                            <img src="././images/sampleProfilePic.jpg" width="50" height="50" class="rounded-circle mr-2" />
                            <input type="text" class="form-control comment-typed" placeholder="Leave your comment..." />
                          </div>
                        </div>
                        <!-- button -->
                        <form class="text-end mt-3">
                          <button type="button" class="btn btn-success">
                            Post Comment
                          </button>
                        </form>
                      </div>
                      <!-- end comment -->
                    </li>
                    <!-- end activity -->
                    <br />';
                echo ($haveAct) ? $html : null;
            }                  
          ?>
        </ul>
      </div>
    </div>
  </div>
  <script src="./js/authListener.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script>
  const commentButton = document.querySelectorAll(".btn-success");
  const beforeComment = document.querySelectorAll(".before-comment");
  const parentComment = document.querySelectorAll(".parent-comment");
  const commentTyped = document.querySelectorAll(".comment-typed");
  var commentNumber = '';
  var commentText = '';

  for (let i = 0; i < commentButton.length; i++) {
    commentButton[i].addEventListener("click", (e) => {
      // e.preventDefault();
      commentNumber = i;
      commentText = commentTyped[i].value;
      // const newComment = document.createElement("comment");
      // newComment.innerHTML = `
      //     <div class="mt-2">
      //       <div class="d-flex flex-row p-3">
      //         <img
      //           src="././images/sampleProfilePic.jpg"
      //           width="40"
      //           height="40"
      //           class="rounded-circle mr-3"
      //         />
      //         <div class="w-100">
      //           <div
      //             class="d-flex justify-content-between align-items-center"
      //           >
      //             <div class="d-flex flex-row align-items-center">
      //               <span class="mr-2">Christian Louboutin</span>
      //               <small class="y-badge"
      //                 ><span class="px-3">You</span></small
      //               >
      //             </div>
      //             <small>Just now</small>
      //           </div>
      //           <p class="text-justify comment-text mb-0">
      //             ${commentTyped[i].value}
      //           </p>
      //           <div class="d-flex flex-row user-feed">
      //             <span class="wish"
      //               ><i class="bi bi-pin mr-2"></i
      //             ></span>
      //             <span class="ml-3"
      //               ><i class="fa fa-comments-o mr-2"></i>Reply</span
      //             >
      //           </div>
      //         </div>
      //       </div>
      //     </div>
      //     `;
      // parentComment[i].insertBefore(newComment, beforeComment[i]);
      // commentTyped[i].value = null;
      console.log("no.:" + commentNumber);
      console.log("text: " + commentText);
      $.ajax({
        type: "POST",
        url: './social-activity.php',
        data: {
          number: commentNumber,
          commentText: commentText,
        },
        success: function(data) {
          // console.log(data);
        },
        error: function(xhr, status, error) {
          console.error(xhr);
        }
      });
    });
  }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="./js/navbar.js"></script>
</body>

</html>