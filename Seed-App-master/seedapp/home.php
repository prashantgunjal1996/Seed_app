<html>
<head>
    <title> Seed Application </title>

    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style type="text/css" media="screen">
   .one{
       background-color:#00C0EF;
   }
   .two{
       background-color:#FF4A43;
   }
   .three{
       background-color:#A2D200;
   }
   .four{
       background-color:#8F44AD;
   }
</style>
</head>

<body>

<?php

    include("include/dbconnection.php");
    $error=" ";

                $qry="SELECT * FROM admission";
                $admissionList=mysqli_query($con,$qry);
                $adm=mysqli_num_rows($admissionList);
               

?>



<div class="container">
    <div class="row bg-primary">
        <div class="col">
            <?php include("include/header.php");
                 

                if(!isset($_SESSION['username']) && $_SESSION['username']=="")
                {
                    header("Location:index.php");
                }

                // session automatically destroy within 1 minute
            //   $now=time();
            //   if($now > $_SESSION['expire'])
            //   {
            //       session_destroy();
            //       header("Location:index.php");
            //   }
            //      session_regenerate_id( true );
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
                <h2 class="mt-3">Dashboard <span class="text-muted" style="font-size:15px;">Control Panel</span> </h2>
        </div>
    </div>

    <div class="row bg-light mt-3">
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card one">
                <div class="card-body">
                    
                    <small>
                     <h2 class="card-title text-white"><b><?php print_r($adm); ?></b><i class="fa fa-user-plus fa-2x text-white float-right "></i></h2>
                    </small>
                    <p class="card-text text-white">Total Admissions.</p>
                </div>
                <div class="card-footer text-center">
                    <small><a href="studentList.php" class="text-white">More Info</a></small>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
            <div class="card two">
            <div class="card-body">
                    
                    <small>
                     <h2 class="card-title text-white"><b>4</b><i class="fa fa-user-plus fa-2x text-white float-right "></i></h2>
                    </small>
                    <p class="card-text text-white">Total Admissions.</p>
                </div>
                <div class="card-footer text-center">
                    <small><a href="#" class="text-white">More Info</a></small>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
            <div class="card three">
            <div class="card-body">
                    
                    <small>
                     <h2 class="card-title text-white"><b>4</b><i class="fa fa-user-plus fa-2x text-white float-right "></i></h2>
                    </small>
                    <p class="card-text text-white">Total Admissions.</p>
                </div>
                <div class="card-footer text-center">
                    <small><a href="#" class="text-white">More Info</a></small>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
            <div class="card four">
            <div class="card-body">
                    
                    <small>
                     <h2 class="card-title text-white"><b>4</b><i class="fa fa-user-plus fa-2x text-white float-right "></i></h2>
                    </small>
                    <p class="card-text text-white">Total Admissions.</p>
                </div>
                <div class="card-footer text-center">
                    <small><a href="#" class="text-white">More Info</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>