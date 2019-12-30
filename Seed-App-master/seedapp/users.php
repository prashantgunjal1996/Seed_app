<html>
<head>
    <title> Seed Application </title>

    <!-- CSS FILES -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>

<?php
    include("include/dbconnection.php");
    
    
    //If btnAddUser is Submitted...
    $msg="";
    $userName="";
    $userEmail="";
    $userPassword="";
    $userRole="";


    if(isset($_POST["btnAddUser"]))
    {
        $txtRole = $_POST["txtRole"];
        $txtName = $_POST["txtName"];
        $txtEmail = $_POST["txtEmail"];
        $txtPassword = $_POST["txtPassword"];

        $qry = "INSERT INTO user (user_name, user_email, user_password, role_id) 
                VALUES ('$txtName','$txtEmail','$txtPassword','$txtRole')";

        mysqli_query($con, $qry);

        if(mysqli_error($con)){

            $msg = "Error: while inserting user!";
        }
        else{

            $msg = "User Added Successfully!";
        }

    }

    if(isset($_POST["btnUpdateUser"]))
    {
        $txtRole = $_POST["txtRole"];
        $txtName = $_POST["txtName"];
        $txtEmail = $_POST["txtEmail"];
        $txtPassword = $_POST["txtPassword"];

        $qry = "UPDATE user  SET user_name='$txtName', user_email='$txtEmail', user_password='$txtPassword', role_id='$txtRole' 
                WHERE user_id=".$_REQUEST["edit"];

        mysqli_query($con, $qry);

        if(mysqli_error($con)){

            $msg = "Error: whie updating user!";
        }
        else{

            $msg = "User Updated Successfully!";
        }

    }

    if(isset($_REQUEST["delete"]))
    {
        $userId = $_REQUEST["delete"];

        $qry = "DELETE FROM user WHERE user_id=".$userId;
        mysqli_query($con, $qry);

        if(mysqli_error($con)){

            $msg = "Error: whie deleteing user!";
        }
        else{

            $msg = "User Deleted Successfully!";
            header("Location:users.php");
        }
    }


    if(isset($_REQUEST["edit"]))
    {
        $userId = $_REQUEST["edit"];

        $qry = "SELECT * FROM user WHERE user_id=".$userId;
        $userList = mysqli_query($con, $qry);

        $user = mysqli_fetch_assoc($userList);
        $userName = $user["user_name"];
        $userEmail = $user["user_email"];
        $userPassword = $user["user_password"];
        $userRole = $user["role_id"];

    }

    //Fetch all users to display in a grid
    $qry = "SELECT * FROM user, role WHERE user.role_id=role.role_id";
    $userList = mysqli_query($con, $qry);

    
?>

<div class="container">

   <?php include("include/header.php"); 
    if(!isset($_SESSION['username']) && $_SESSION['username']=="")
    {
        header("Location:index.php");
    }

   ?>

   <br>

   <section>

        <div class="row">
            <div class="col">

            <h3> Manage Users </h3>

            <hr>

            <?php if($msg!=""){ ?>
            <div class="alert alert-success" role="alert">
                <?=$msg?>
            </div>
            <?php  } ?>

            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <select class="form-control" name="txtRole" >
                            <?php
                                $qry = "SELECT * FROM role";
                                $roleList = mysqli_query($con, $qry);
                                while($role = mysqli_fetch_assoc($roleList))
                                {
                                    if($role["role_id"] == $userRole)
                                        echo "<option value='".$role["role_id"]."' selected=selected> ".$role["role_name"]." </option>";
                                    else
                                        echo "<option value='".$role["role_id"]."'> ".$role["role_name"]." </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="txtName" class="form-control" placeholder="Name" value="<?=$userName?>" required>
                    </div>
                    <div class="col">
                        <input type="text" name="txtEmail" class="form-control" placeholder="Email" value="<?=$userEmail?>" required>
                    </div>
                    <div class="col">
                        <input type="text" name="txtPassword" class="form-control" placeholder="Password" value="<?=$userPassword?>" required>
                    </div>
                    <div class="col">

                        <?php if( isset($_REQUEST["edit"]) ) { ?> 
                        <input type="submit" name="btnUpdateUser" class="btn btn-secondary" value="UPDATE">    
                        <a href="users.php" class="btn btn-primary"> CANCEL </a> 
                        <?php } else { ?> 
                        <input type="submit" name="btnAddUser" class="form-control btn btn-primary" value="ADD"> 
                        
                        <?php } ?>
                    </div>
                </div>
            </form>
            <hr>
            
            <table class="table" id="jk">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php while($user = mysqli_fetch_assoc($userList)) { ?>
                    <tr>
                        <th scope="row"><?=$user["user_id"]?></th>
                        <td><?=$user["user_name"]?></td>
                        <td><?=$user["user_email"]?></td>
                        <td><?=$user["role_name"]?></td>
                        <td><?=$user["user_password"]?></td>
                        <td> 
                            <a href="users.php?edit=<?=$user["user_id"]?>"><img src="images/edit.png" title="Edit" width=20px;></a> |
                            <a href="users.php?delete=<?=$user["user_id"]?>"><img src="images/delete.png" title="Delete" width=20px;></a> 
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
                </table>

                
            </div>
        </div>  

   </section>

</div>

</body>

</html>