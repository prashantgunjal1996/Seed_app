<?php session_start();

 if(!isset($_SESSION['username']) && $_SESSION['username']=="")
 {
     header("Location:../index.php");
 }
?>
<style type="text/css">
	.profile_icon{
		color: white;
		height: 40px;
		width: 40px;
		border-radius: 50%;
	}
	.profile_name{
		padding:2px;
        margin:0px;
       text-align: center;
       font-size: 24px;
	}
    .logo{
        font-size: 25px;
    }
    .navbar{
        background-color:#2E71C0;
    }
</style>

<?php
        $username1="";
        $username=$_SESSION['username'];
        $username1= substr($username, 0,1);
        
?> 
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light logo" href="home.php" title="Logo">SEEP APP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-light " href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php  if($_SESSION['id']== 1){?>
            <li class="nav-item">
                <a class="nav-link text-light" href="users.php">Users</a>
            </li>
            <?php }?>
            <li class="nav-item">
                <a class="nav-link text-light" href="courses.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="admissions.php">Admissions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="logout.php">Logout</a>
            </li>
        </ul>

        <!-- Profile Button Starts -->
         <ul class="navbar-nav ml-auto nav-flex-icons">
              <li class="nav-item">
                <a class="nav-link p-0 profile_icon bg-dark" href="profile.php" style="text-decoration: none; color: white;">
                <h4 class="profile_name"><?= $username1;?></h4>
                </a>
              </li>
            </ul>
        <!-- Profile Button Ends -->
    </div>
</nav>
<!-- Navbar Ends -->

 