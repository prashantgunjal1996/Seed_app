<html>
<head>
    <title>Seed App</title>

     <!-- CSS FILES -->
     <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .section{
            background-color:white;
        }
       
    
    
	.avatar{
				
				margin-top: -5rem;
				max-width: 8rem;
				box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.5);
			}
			h4{
				font-size: 1.5rem;
			}
			.card{
				margin-bottom: 5rem;
				
				transition:0.3s;
			}
			 .img{
				height:30vh;
			}
			.icon{
				max-width: 2.2rem;
			}
			
			.jk{
				margin-bottom: 1rem;
				color: black;
			}
			h2{
				font-size: 3rem;
			}
    </style>
</head>

<body>
<div class="container bg-primary">

<?php 
	   include("include/dbconnection.php");
 	  include("include/header.php"); 
    if(!isset($_SESSION['username']) && $_SESSION['username']=="")
    {
        header("Location:index.php");
    }
		$str = $_SESSION['id'];
		$qry="SELECT * FROM role WHERE role_id=$str";
		$r=mysqli_query($con,$qry);
	 	$res=mysqli_fetch_assoc($r);
	  
	
	
   ?>
    <section class="section">
    <!-- <div class="row">
				<div class=" jk col-sm-12 text-center">
					<h2> Profile </h2>
				</div>
			</div> -->
			<div class="row">
				
				
				<div class="col-sm-12 col-md-6 col-lg-12">
					<div class="card ">
                    <img class="card-img-top img" src="ganesh_premium_fg.jpg" alt="Card image cap"  width="20px">
						<div class="card-body text-center">
                        
						<img class="card-img-top avatar rounded-circle" src="images/logo1.jpg" alt="Card image cap">
							<h4 class="card-title mt-2"><?= $_SESSION['username'];?></h4>
							<p class=" name text-muted"><?= $res['role_name'];?></p>
							<p class="card-text"><button class="btn btn-primary"> Update Profile </button></p>
						</div>
						
						
					</div>
				</div>
			</div>
    </section>   
</div>
</body>
</html>