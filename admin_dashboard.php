<?php
   include '_db_con.php';
    $update = false;
    $delete = false;
    session_start();
    if(!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true){
        header("location: login_admin.php");
        exit();
    }
    if(isset($_GET['delete'])){
      $slno = $_GET['delete'];
      // echo $slno;
      $sql = "DELETE FROM `registration_user` WHERE `slno` = '$slno'";
      $result = mysqli_query($conn, $sql);
      if($result){
        $delete = true;
      }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      include '_db_con.php';
      if(isset($_POST["slnoEdit"])){
        //update the record
        $slno = $_POST["slnoEdit"];
        $usrname = $_POST["usr_nameEdit"];
        $usremail = $_POST["usr_emailEdit"];
        $sql = "UPDATE `registration_user` SET `name` = '$usrname' , `email` = '$usremail' WHERE `registration_user`.`slno` = $slno";
        $result = mysqli_query($conn, $sql);
        if($result){
          $update = true;
        }
        else{
          echo "We could not Update your Record Sucessfully";
        }
      }
    }
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
</head>

<body>
  <div class="container">
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal">
      Edit Modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editmodalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="mx-1 mx-md-4" action="/login_registration_crud/admin_dashboard.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="slnoEdit" id="slnoEdit">
              <div class="d-flex flex-row align-items-center mb-4">
                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                  <input type="text" id="usr_nameEdit" name="usr_nameEdit" class="form-control" />
                  <label class="form-label" for="usr_name">Your Name</label>
                </div>
              </div>
              <div class="d-flex flex-row align-items-center mb-4">
                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                  <input type="email" id="usr_emailEdit" name="usr_emailEdit" class="form-control" />
                  <label class="form-label" for="usr_email">Your Email</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container">
      <?php
      if($update){
        echo '<div class="alert alert-sucess alert-dismissible fade show" role="alert">
        <strong>Sucess!</strong> You upadte sucessfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    ?>
      <?php
    if($delete){
      echo '<div class="alert alert-sucess alert-dismissible fade show" role="alert">
      <strong>Sucess!</strong> You deleted sucessfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
  ?>
      <h3>Hello,
        <?php echo $_SESSION['name'] ?>
      </h3>
      <div class="d-flex justify-content-end"><a href="logout_admin.php">logout</a></div>
    </div>
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">SL No.</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
            include '_db_con.php';
            $sql = "select * from `registration_user`";
            $result = mysqli_query($conn, $sql);
            $slno = 0;
            while($row = mysqli_fetch_assoc($result)){
              $slno = $slno + 1;
              echo "<tr>
              <th scope='row'>".$slno."</th>
              <td>".$row['name']."</td>
              <td>".$row['email']."</td>
              <td><button class='edit btn btn-primary' id=".$row['slno'].">Edit</button> <button class='delete btn btn-primary' id=d".$row['slno'].">Delete</button></td>
            </tr>";
            }
          ?>

    </table>
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">SL No.</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
            include '_db_con.php';
            $sql = "select * from `admin`";
            $result = mysqli_query($conn, $sql);
            $slno = 0;
            while($row = mysqli_fetch_assoc($result)){
              $slno = $slno + 1;
              echo "<tr>
              <th scope='row'>".$slno."</th>
              <td>".$row['name']."</td>
              <td>".$row['email']."</td>
              <td><button class='edit btn btn-primary' id=".$row['slno'].">Edit</button> <button class='delete btn btn-primary' id=d".$row['slno'].">Delete</button></td>
            </tr>";
            }
          ?>

    </table>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        email = tr.getElementsByTagName("td")[1].innerText;
        console.log(name, email);
        usr_nameEdit.value = name;
        usr_emailEdit.value = email;
        slnoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editmodal').modal('toggle')
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ");
        slno = e.target.id.substr(1,);
        if (confirm("Are you sure you want to delete this User!")) {
          // console.log("yes");
          window.location = `/login_registration_crud/admin_dashboard.php?delete=${slno}`;
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>