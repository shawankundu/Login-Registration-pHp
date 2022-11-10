<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include '_db_con.php';
  $slno = $_POST["slno"];
  $usremail = $_POST["usr_email"];
  $usrpassword = $_POST["usr_password"];
  if (empty($usremail)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($usrpassword)){
        header("Location: index.php?error=Password is required");
	    exit();
  }
  else{
      $sql = "select * from registration_user where email = '$usremail' AND password = '$usrpassword'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if($num == 1){
            $login = true;
            $row = mysqli_fetch_assoc($result);
            if($row['email'] == $usremail && $row['password'] == $usrpassword){
              session_start();
              $_SESSION['usr_loggedin'] = true;
              $_SESSION['email'] = $row['email'];
              $_SESSION['name'] = $row['name'];
              $_SESSION['slno'] = $row['slno'];
              header("location: usr_dashboard.php");
            }
      }else{
        $showError = true;
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
  <title>Sign iN</title>
</head>

<body>
  <section class="vh-100">
    <?php
     if($login){
     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Login Sucess!</strong> You sucessfully login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        }
        if($showError){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Invaid Credentials </strong> Please check email and password.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }
    ?>
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="image/draw2.svg" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form action="/login_registration_crud/index.php" method="POST">
            <input type="hidden" name="usr_name" id="usr_name">
            <input type="hidden" name="slno" id="slno">
            <!-- Email input -->
            <div class=" form-outline mb-4">
              <input type="email" id="usr_email" name="usr_email" class="email form-control form-control-lg" />
              <label class="form-label" for="usr_email">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="usr_password" name="usr_password" class="form-control form-control-lg" />
              <label class="form-label" for="usr_password">Password</label>
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                <label class="form-check-label" for="form1Example3"> Remember me </label>
              </div>
              <a href="signup.php">Register</a>
            </div>

            <!-- Submit button -->
            <button type="submit" class="signin btn-primary btn-lg btn-block">Sign in</button>
          </form>
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