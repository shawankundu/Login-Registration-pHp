<?php
$showAlart = false;
$showError = false;
$ErrMsg = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include '_db_con.php';

  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $usrname =($_POST["usr_name"]);
  $usremail = validate($_POST["usr_email"]);
  $usrpassword = validate($_POST["usr_password"]);
  $usrcpassword = $_POST["usr_cpassword"];
  
  $exist_usrslq = "SELECT * FROM `registration_user` WHERE email = '$usremail'";
  $result = mysqli_query($conn, $exist_usrslq);
  $num_existROws = mysqli_num_rows($result);;
  if(!preg_match ("/^[a-zA-z]*$/", $usrname) || empty($_POST["usr_name"]) ){
    $ErrMsg = true; 
    }else{
    if($num_existROws > 0){
      $showError = "User already exists!";
      }else{
        if($usrpassword == $usrcpassword ){
          $sql = "INSERT INTO `registration_user` (`name`, `email`, `password`, `dt`) VALUES 
          ('$usrname', '$usremail', '$usrpassword', current_timestamp())";
          $result = mysqli_query($conn, $sql);
          if($result){
            $showAlart = true;
          }
        }else{
          // $showError = true;
          $showError = "Password Do no match!";
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Sign UP</title>
</head>

<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <?php
                if($showAlart){
                  echo '<div class="alart alert-success alert-dismissible fade show" role="alert">
                  <strong>Sucess!</strong> Your account was created.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
                }
                if($showError){
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> '.$showError.'.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
                }
                if($ErrMsg){
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Enter name or Only alphabets and whitespace are allowed.</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
                }
                ?>
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form class="mx-1 mx-md-4" action="/login_registration_crud/signup.php" method="POST">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="usr_name" name="usr_name" class="form-control" />
                        <label class="form-label" for="usr_name">Your Name</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="usr_email" name="usr_email" class="form-control" />
                        <label class="form-label" for="usr_email">Your Email</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="usr_password" name="usr_password" class="form-control" />
                        <label class="form-label" for="usr_password">Password</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="usr_cpassword" name="usr_cpassword" class="form-control" />
                        <label class="form-label" for="usr_cpassword">Repeat your password</label>
                      </div>
                    </div>


                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary ">Register</button>
                      <button type="button" class="btn btn-primary mx-4"
                        onclick="document.location='index.php'">Signin</button>
                    </div>

                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="image/draw1.webp" class="img-fluid" alt="Sample image">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>