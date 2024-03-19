<?php
	function detectError()
	{
    	// Use the global variables.
    	global $studentId, $password,$age,$confirm_password, $userName, $gender, $email;

    	// For holding error messages.
    	$error = array();

    	// id /////////////////////////////////////////////////////////////////////
    	if ($studentId == null)
    	{
        	$error["id"] = 'Please enter <strong>Student ID</strong>.';
    	}
    	else if (!preg_match('/^\d{2}[A-Z]{3}\d{5}$/', $studentId))
    	{
        	$error["id"] = '<strong>Student ID</strong> is of invalid format. Format: 99XXX99999.';
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
    	if ($userName == null)
    	{
        	$error["name"] = 'Please enter <strong>Student Name</strong>.';
    	}
    	else if (strlen($userName) > 30) // Prevent hacks.
    	{
        	$error["name"] = '<strong>Student Name</strong> must not more than 30 letters.';

    	}
    	else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $userName))
    	{
        	$error["name"] = 'There are invalid letters in <strong>Student Name</strong>.';
    	}

    	// gender /////////////////////////////////////////////////////////////////
    	if ($gender == null)
    	{
        	$error["gender"] = 'Please select a <strong>Gender</strong>.';
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login-register.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         
            include("php/config.php");
            if(isset($_POST['submit'])){
                $studentId = strtoupper(trim($_POST['studentId']));
                $userName = trim($_POST['username']);
                $gender = $_POST['gender'];
                $email = trim($_POST['email']);
                $age = $_POST['age'];
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm_password']);

                $error = detectError();

                if(empty($error)){//if no error
                    
                    //verifying the unique email
                    $verify_query = mysqli_query($con,"SELECT Email AND StudentID FROM users WHERE Email='$email' AND StudentID='$studentId'");

                    if(mysqli_num_rows($verify_query) !=0 ){
                        echo "<div class='message'>
                                <p>This email is used, Try another One Please!</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    }
                    else{

                        mysqli_query($con,"INSERT INTO users(StudentID,Username,Email,Gender,Age,Password) VALUES('$studentId','$userName','$email','$gender','$age','$password')") or die("Erroe Occured");

                        echo "<div class='message'>
                                <p>Registration successfully!</p>
                            </div> <br>";
                        echo "<a href='login.php'><button class='btn'>Login Now</button>";
                    }
                }else{
                    echo "<div class='message error'>
                            <h1>Oops!</h1><p><ul>";
                            foreach ($error as $value)
                            {
                                echo "<li>".$value."</li>";
                            }
                            echo "</ul></p>
                        </div> <br>
                    <a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                }
            }else{
        ?>

            <header>Sign Up</header>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">

                <div class="field input">
                    <label for="studentId">Student ID</label>
                    <input type="text" name="studentId" id="studentId" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="gender">Gender</label>
                </div>

                <div class="radio-field">
                        <input type="radio" name="gender" id="gender" value="M"/>
                        <label for="M">Male</label>
                        <input type="radio" name="gender" id="gender" value="F"/>
                        <label for="F">Female</label>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>

                    <input type="button" class="btn" name="reset" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'">
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>