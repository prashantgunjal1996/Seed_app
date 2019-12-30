<?php session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['username']) && $_SESSION['username']!="")
    {
        header("Location:home.php");
    }

?>

<html>
<head>
    <title> Seed Application </title>
    <link rel="stylesheet" href="css/style.css">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>



<body>

<?php

    include("include/dbconnection.php");
    $error=" ";

    //If login button is submitted - check login.
    if(isset($_POST["btnLogin"]))
    {
        //read the values of username and password entered by the user
        // $tusername = $_POST["tusername"];
        // $tpassword = $_POST["tpassword"];
        $tusername = mysqli_real_escape_string($con, $_POST['tusername']);
        $tpassword= mysqli_real_escape_string($con, $_POST['tpassword']);
        //Check Login
        if($tusername == "" || $tpassword == "")
        {
            $error = "Sorry, Username or Password is blank!";
        }
        else
        {
            $qry = "SELECT * FROM user WHERE user_email='$tusername' AND user_password='$tpassword'";
            $loginResult = mysqli_query($con, $qry);

            if(mysqli_num_rows($loginResult) > 0)
            {
                $js=mysqli_fetch_assoc($loginResult);
                $_SESSION['username']=$js['user_name'];
                $_SESSION['id']=$js['role_id'];
                $_SESSION['start']=time();
                $_SESSION['expire']= $_SESSION['start'] + (1 * 60);
                header("Location:home.php");
            }
            else
            {
                $error = "Invalid Login, Please try again!";
            }

        }

    }
?>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <!-- Login Form Starts -->
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="tusername" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="tpassword" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"> </label><br>
                                <input type="submit" name="btnLogin" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="forgot.php" class="text-info">Forgot Password</a>
                            </div>
                            <h3> <?= $error ?> </h3>
                        </form>
                        <!-- Login Form Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
