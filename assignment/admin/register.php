<?php 
session_start();
function detectError()
{
    // Use the global variables.
    global $adminId, $password, $confirm_password, $fName, $lName ,$email;

    // For holding error messages.
    $error = array();

    // id /////////////////////////////////////////////////////////////////////
    if ($adminId == null)
    {
        $error["id"] = 'Please enter <strong>Admin ID</strong>.';
    }
    else if (!preg_match('/^\d{2}[A-Z]{3}\d{5}$/', $adminId))
    {
        $error["id"] = '<strong>Admin ID</strong> is of invalid format. Format: 99XXX99999.';
    }

    // password ///////////////////////////////////////////////////////////////
    if ($password == null)
    {
        $error["password"] = 'Please enter <strong>Password</strong>.';
    }
    else if (strlen($password) < 8 || strlen($password) > 15)
    {
        $error["password"] = '<strong>Password</strong> must between 8 to 15 characters.';
    }   
    // confirm ////////////////////////////////////////////////////////////////
    if ($confirm_password == null)
    {
        $error["confirm-password"] = 'Please enter <strong>Confirm Password</strong>.';
    }
    else if ($confirm_password != $password)
    {
        $error["confirm-password"] = '<strong>Confirm Password</strong> must match the password.';
    }

    // name ///////////////////////////////////////////////////////////////////
    if ($fName == null)
    {
        $error["fname"] = 'Please enter <strong>First Name</strong>.';
    }
    else if (strlen($fName) > 15) // Prevent hacks.
    {
        $error["fname"] = '<strong>First Name</strong> must not more than 15 letters.';

    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $fName))
    {
        $error["fname"] = 'There are invalid letters in <strong>First Name</strong>.';
    }

    if ($lName == null)
    {
        $error["lname"] = 'Please enter <strong>Last Name</strong>.';
    }
    else if (strlen($lName) > 15) // Prevent hacks.
    {
        $error["lname"] = '<strong>Last Name</strong> must not more than 15 letters.';

    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $lName))
    {
        $error["lname"] = 'There are invalid letters in <strong>Last Name</strong>.';
    }

    // email //////////////////////////////////////////////////////////////////
    if ($email == null)
    {
        $error["email"] = 'Please enter <strong>Email Address</strong>.';
    }
    else if (strlen($email) > 30) // Prevent hacks.
    {
        $error["email"] = '<strong>Email Address</strong> must not more than 30 characters.';
    }
    else if (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email))
    {
        $error["email"] = '<strong>Email Address</strong> is of invalid format.';
    }

    ///////////////////////////////////////////////////////////////////////////
    return $error;
}

    include("includes/header.php"); 
    include("includes/sideNav.php"); 
?>
<?php 
include('./php/con_db.php');
if(isset($_POST['submit'])){
    $adminId = strtoupper(trim($_POST['adminId']));
    $fName = trim($_POST['firstName']);
    $lName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirmPassword']);

    $error = detectError();

    $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email' AND AdminID='$adminId'");
  
    if(empty($error)){
        if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                <p>This email is used, Try another One Please!</p>
            </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        } else {
            $query = "INSERT INTO users (AdminID, UserFirstName, UserLastName, Email, Password) VALUES ('$adminId','$fName', '$lName', '$email', '$password')";
            $result = mysqli_query($con, $query);
                if($result){
                    echo "<div class='message'>
                    <p>Account Created Successfully!</p>
                </div> <br>";
                    $_SESSION['valid-admin'] = $adminId;
                    $_SESSION['user-name'] = $fName + " " + $lName;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    echo "<a href='index.php'><button class='btn'>Go to Home</button>";
                } else {
                    echo "<div class='message'>
                    <p>Failed to create account!</p>
                </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                }
            }
    }else{
        echo "<div class='message error'>
        <h1>Oops!</h1>";
        foreach($error as $value){
            echo"<li>".$value."</li>";
        }
        echo "</div> <br>
        <a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
    }
} else{ ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputAdminId" name="adminId" type="text" placeholder="Enter your admin id" />
                                <label for="inputAdminId">Admin ID</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputFirstName" name="firstName" type="text" placeholder="Enter your first name" />
                                        <label for="inputFirstName">First name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputLastName" name="lastName" type="text" placeholder="Enter your last name" />
                                        <label for="inputLastName">Last name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Create a password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPasswordConfirm" name="confirmPassword" type="password" placeholder="Confirm password" />
                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Create An Account">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php } ?>
<?php
include("includes/footer.php");
include("includes/scripts.php");
?>
