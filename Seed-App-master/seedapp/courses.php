<!DOCTYPE html>
<html>
<head>
	<title>Seed Application</title>
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
    $courseName="";
    $courseFees="";
    $courseDuration="";
    if(isset($_POST['btnAddCourse']))
    {
        $courseName=$_POST['courseName'];
        $courseFees=$_POST['courseFees'];
        $courseDuration=$_POST['courseDuration'];

        $qry="INSERT INTO course(course_name,course_fees,course_duration) VALUES('$courseName','$courseFees','$courseDuration')";
        mysqli_query($con,$qry);
        if (mysqli_error($con)) {

            $msg = "Error: while inserting user!";
        }
        else{

            $msg = "Course Added Successfully!";
        }
    }
    
    //Delete Courses
    if(isset($_REQUEST['delete']))
    {
        $deleteId=$_REQUEST['delete'];
        $qry="DELETE FROM course WHERE course_id='$deleteId'";
        mysqli_query($con,$qry);
        if(mysqli_error($con)){

            $msg = "Error: while deleteing user!";
        }
        else{

            $msg = "Course Deleted Successfully!";
            header("Location:courses.php");
        }
    }

    //Edit Courses
    if(isset($_REQUEST['edit']))
    {
        $editId=$_REQUEST['edit'];
        $qry="SELECT * FROM course WHERE course_id='$editId'";
        $courseList=mysqli_query($con,$qry);
        $course=mysqli_fetch_assoc($courseList);
        $courseName=$course['course_name'];
        $courseFees=$course['course_fees'];
        $courseDuration=$course['course_duration'];
        
    }

    //Update Course
    if(isset($_POST['btnUpdateCourse']))
    {
        $courseName=$_POST['courseName'];
        $courseFees=$_POST['courseFees'];
        $courseDuration=$_POST['courseDuration'];

        $qry="UPDATE course SET course_name='$courseName',course_fees='$courseFees',course_duration='$courseDuration' 
        WHERE course_id=".$_REQUEST['edit'];
        mysqli_query($con,$qry);
        if (mysqli_error($con)) {

            $msg = "Error: while Updating user!";
        }
        else{

            $msg = "Course Updated Successfully!";
        }
    }
    



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
                    <h3>Manage Courses</h3>
                    <?php
                        if($msg!=""){?>
                        <div class="alert alert-success">
                        <?=$msg?>
                        </div>
                        <?php } ?>
                    
                    
                    <hr>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col">
                            <input type="text" name="courseName" class="form-control" placeholder="Course Name" value="<?=$courseName?>" required>
                            </div>
                            <div class="col">
                                <input type="text" name="courseFees" class="form-control" placeholder="Fees" value="<?=$courseFees?>" required>
                            </div>
                            <div class="col">
                                <input type="text" name="courseDuration" class="form-control" placeholder="duration" value="<?=$courseDuration?>" required>
                            </div>
                            
                            <div class="col">
                                <?php if(isset($_REQUEST['edit'])){ ?>
                                        <input type="submit" name="btnUpdateCourse" class="btn btn-dark" placeholder="duration" value="Update" required>
                                        <a href="courses.php" class="btn btn-primary"> CANCEL </a> 
                                <?php } else{?>
                                    <input type="submit" name="btnAddCourse" class="btn btn-primary" placeholder="duration" value="Add" required>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Course Fees</th>
                            <th scope="col">Course Duration</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $qry="SELECT * FROM course";
                                $courseList = mysqli_query($con,$qry);
                                while($course=mysqli_fetch_assoc($courseList)){
                                ?>
                                <tr>
                                    <th><?=$course["course_id"]?></th>
                                    <td><?=$course['course_name']?></td>
                                    <td><?=$course['course_fees']?></td>
                                    <td><?=$course['course_duration']?></td>
                                    <td><a href="courses.php?edit=<?=$course["course_id"]?>"><img src="images/edit.png" title="Edit" width=20px;></a> |
                                    <a href="courses.php?delete=<?=$course["course_id"]?>"><img src="images/delete.png" title="Delete" width=20px;></a></td>
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