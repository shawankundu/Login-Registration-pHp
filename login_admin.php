<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include '_db_con.php';
  $adminemail = $_POST["admin_email"];
  $adminpassword = $_POST["admin_password"];

   $sql = "select * from admin where email = '$adminemail' AND password = '$adminpassword'";
   $result = mysqli_query($conn, $sql);
   $num = mysqli_num_rows($result);
   if($num == 1){
        $login = true;
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['email'] = $adminemail;
        $_SESSION['name'] = $row['name'];
        header("location: admin_dashboard.php");
   }else{
    $showError = true;
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
        <strong>Login Sucess!</strong> You login with admin.
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
          <form action="/login_registration_crud/login_admin.php" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="admin_email" name="admin_email" class="form-control form-control-lg" />
              <label class="form-label" for="admin_email">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="admin_password" name="admin_password" class="form-control form-control-lg" />
              <label class="form-label" for="admin_password">Password</label>
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                <label class="form-check-label" for="form1Example3"> Remember me </label>
              </div>
              <!-- <a href="signup.php">Register</a> -->
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>

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