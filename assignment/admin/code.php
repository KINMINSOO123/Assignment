<?php 
include('./php/con_db.php');
if(isset($_POST['submit'])){
  $adminId = strtoupper(trim($_POST['adminId']));
  $fName = $_POST['firstName'];
  $lName = $_POST['lastName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cPassword = $_POST['confirmPassword'];

  $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");
  
  if(mysqli_num_rows($verify_query) !=0 ){
    echo "<div class='message'>
        <p>This email is used, Try another One Please!</p>
      </div> <br>";
    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
  } else {
    if($password == $cPassword){
      $password = md5($password);
      $query = "INSERT INTO users (AdminID, UserFirstName, UserLastName, Email, Password) VALUES ('$adminId','$fName', '$lName', '$email', '$password')";
      $result = mysqli_query($con, $query);
      if($result){
        echo "<div class='message'>
        <p>Account Created Successfully!</p>
      </div> <br>";
        echo "<a href='login.php'><button class='btn'>Go to Login</button>";
      } else {
        echo "<div class='message'>
        <p>Failed to create account!</p>
      </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
      }
    } else {
      echo "<div class='message'>
        <p>Passwords do not match!</p>
      </div> <br>";
      echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
    }
  }
  
} else {
  header("Location: register.php");
  exit();
}
