<?php 
session_start();
ob_start(); 
include('includes/header.php');
include('includes/sideNav.php');?>
<main>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
            <div class="card-body">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <?php 
              include('php/con_db.php');
              if(isset($_POST['submit'])){
                $adminId = $_POST['adminId'];
                $password = $_POST['password'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE AdminID = '$adminId' AND Password = '$password'");
                if(mysqli_num_rows($query) > 0){
                  $_SESSION['valid-admin'] = $adminId;
                  header("Location: index.php");
                } else {
                  echo "<div class='message error'>
                  <p>Invalid Admin ID or Password!</p>"
                  ."</div> <br> <button><a href='javascript:self.history.back()'>Go Back</a></button>";
                }
              }else{?>
              <div class="form-floating mb-3">
                <input class="form-control" id="inputAdminId" name="adminId" type="text" placeholder="Enter your Admin ID" />
                <label for="inputAdminId">Admin ID</label>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                <label for="inputPassword">Password</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
              </div>
              <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <a class="small" href="password.html">Forgot Password?</a>
                <input type="submit" name="submit" class="btn btn-primary" value="Login">
              </div>
            </form>
          </div>
          <div class="card-footer text-center py-3">
            <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php }?>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php'); ob_end_fluhs();?>