<html>
    <head>
        <!-- CSS   -->
        <link rer="stylesheet" href="style.css">
        
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>

        <?php
            $msg="";
            //connect ot database.... 
            include("include/dbconnection.php");

            //when submit button is clicked...  
            if(isset($_POST['btnsubmit']))
            {
                $stud_Fname = $_POST['Stud_Fname'];
                $stud_Lname = $_POST['Stud_Lname'];
                $stud_email = $_POST['Stud_email'];
                $stud_mob = $_POST['Stud_mob'];
                $stud_addr = $_POST['Stud_addr'];
                $stud_city = $_POST['Stud_city'];
                $stud_pin = $_POST['Stud_pin'];
                $stud_qual = $_POST['Stud_qual'];
                $stud_college = $_POST['Stud_college'];
                $courselist = $_POST['CourseList'];
                $status = $_POST['courseStatus'];


                $qry = "INSERT INTO admission(stud_first_name,stud_last_name,stud_email,stud_mobile,stud_address,stud_city,stud_pincode,stud_qualification,stud_college,course_id,status)
                        VALUES('$stud_Fname','$stud_Lname','$stud_email','$stud_mob','$stud_addr',' $stud_city','$stud_pin','$stud_qual','$stud_college','$courselist','$status')";

                $courseList= mysqli_query($con,$qry);
                if(mysqli_error($con))
                {

                    $msg= "Error: while Adding student....!".mysqli_error($con);
                }
                else
                {
                    $msg=  "Student Added Successfully!";
                    
                }
                
            }

        //fetch data from admission table.. 
        $qry = "SELECT * FROM admission";
        $admissionList = mysqli_query($con,$qry);
        // if($con)
        // {
        //     echo "error".mysqli_error($con);
        // }

        //view the student detail... 


        if(isset($_REQUEST['view']))
        {
            $AdmId = $_REQUEST['view'];

            $qry = " SELECT * FROM admission WHERE adm_id = '$AdmId' ";
            $admissionList = mysqli_query($con,$qry);
            if($admissionList)
            {
                $Add = mysqli_fetch_assoc($admissionList);
            }
        }
                
       //admission(Student) show  in text box
        $stud_first_name=$stud_last_name=$stud_email=$stud_mobile=$stud_address=$stud_city=$stud_pincode=$stud_qualification=$stud_college=$course_id=$status="";
        if(isset($_REQUEST["edit"]))
        {
           $adm_id=$_REQUEST["edit"];

           $qry="SELECT * FROM admission WHERE adm_id=$adm_id";
           $admList=mysqli_query($con,$qry);
           $adm = mysqli_fetch_assoc($admList);

           $stud_first_name=$adm['stud_first_name'];
           $stud_last_name=$adm['stud_last_name'];
           $stud_email=$adm['stud_email'];
           $stud_mobile=$adm['stud_mobile'];
           $stud_address=$adm['stud_address'];
           $stud_city=$adm['stud_city'];
           $stud_pincode=$adm['stud_pincode'];
           $stud_qualification=$adm['stud_qualification'];
           $stud_college=$adm['stud_college'];
           $course_id=$adm['course_id'];
           $status=$adm['status'];
         }
         
        
         //admission(Student) Update  in database
        if(isset($_POST['btnUpdate']))
         {
            $stud_Fname = $_POST['Stud_Fname'];
            $stud_Lname = $_POST['Stud_Lname'];
            $stud_email = $_POST['Stud_email'];
            $stud_mob = $_POST['Stud_mob'];
            $stud_addr = $_POST['Stud_addr'];
            $stud_city = $_POST['Stud_city'];
            $stud_pin = $_POST['Stud_pin'];
            $stud_qual = $_POST['Stud_qual'];
            $stud_college = $_POST['Stud_college'];
            $courselist = $_POST['CourseList'];
            $status = $_POST['courseStatus'];

            $qry="UPDATE admission SET stud_first_name='$stud_Fname',stud_last_name='$stud_Lname',stud_email='$stud_email',stud_mobile='$stud_mob',stud_address='$stud_addr',stud_city='$stud_city',stud_pincode='$stud_pin',stud_qualification='$stud_qual',stud_college='$stud_college',course_id='$courselist',status='$status'WHERE adm_id=".$_REQUEST['edit'];
            mysqli_query($con,$qry);
            if(mysqli_error($con))
            {
                $msg= "Error ";
            }
            else{
                session_start();
                $msg = "Student Updated Successfully!";
                $_SESSION['msg']=$msg;
                header("Location:studentList.php");
                
            }
         }
        ?>


        <div class="container">
        
        
                <?php   include("include/header.php");
                         if(!isset($_SESSION['username']) && $_SESSION['username']=="")
                         {
                             header("Location:index.php");
                         }
                
                ?>
           
            <div class=row>
                <div class=col>
                    <h3 class="mt-3 mb-2 float-left">Student Registration Form..</h3>
                    <a href="studentList.php" class="float-right mt-3 mr-3"><u>Student List</u></a>
                </div>
            </div>
            <hr>
            <?php if($msg!=""){ ?>
            <div class="alert alert-success" role="alert">
                <?=$msg?>
                <a href="studentList.php" class="alert-link">Click - Student List</a>
            </div>
            <?php  } ?>
            <!-- student admission form start -->
            
            <form action="" method="post">
                <div class="row">
                    <div class="col-2"><b>First Name :</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_Fname" class="form-control" placeholder="Enter your first name" value="<?= $stud_first_name?>" required>
                    </div>
                <!-- </div>
                <br>
                <div class="row"> -->
                    <div class="col-2"><b>Last Name :</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_Lname" class="form-control " placeholder="Enter your last names" value="<?= $stud_last_name?>" required>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-2"><b>Email :</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_email" class="form-control" placeholder="Enter your email" value="<?= $stud_email?>" required>
                    </div>
                <!-- </div>
                <br>
                <div class="row"> -->
                <div class="col-2"><b>Mobile No:</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_mob" class="form-control" placeholder="Enter Mobile Number" value="<?=$stud_mobile?>" required>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-2"><b>Addresse :</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_addr" class="form-control" placeholder="Enter Address" value="<?=$stud_address?>" required>
                    </div>
                <!-- </div>
                <br> 
                <div class="row"> -->
                <div class="col-2"><b>City:</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_city" class="form-control" placeholder="Enter your City" value="<?=$stud_city?>" required>
                    </div>
                </div>
                <br> 
                <div class="row">
                <div class="col-2"><b>Pincode :</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_pin" class="form-control" placeholder="pincode" value="<?=$stud_pincode?>" required>
                    </div>
                <!-- </div>
                <br>
                <div class="row"> -->
                <div class="col-2"><b>Qualification :</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_qual" class="form-control" placeholder="Enter qualification" value="<?=$stud_qualification?>" required>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-2"><b>College:</b></div>
                    <div class="col-4">
                        <input type="text" name="Stud_college" class="form-control" placeholder="Enter College" value="<?=$stud_college?>" required>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-2"><b>Course:</b></div>
                    <div class="col-4">
                        <select name="CourseList" value=" <?=$course_id?> ">
                        <?php 
                            $qry = " SELECT * FROM course ";
                            $courselist = mysqli_query($con,$qry);
                            while($row = mysqli_fetch_assoc($courselist))
                            {
                                if($row['course_id']==$course_id)
                                {
                                    echo "<option value= ".$row['course_id']." selected>" .$row['course_name']. "</option>";
                                }
                                else{
                                echo "<option value= ".$row['course_id'].">" .$row['course_name']. "</option>";
                                }
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-2"><b>Status :</b></div>
                    <div class="col-4">
                        <select name="courseStatus">
                        <option value="1" <?php if($status=="Ongoing"){ ?> selected="selected" <?php } ?> >ongoing</option>
                            <option value="2" <?php if($status=="Completed"){ ?> selected="selected" <?php } ?>>completed</option>
                            <option value="3" <?php if($status=="Cancelled"){ ?> selected="selected" <?php } ?>>cancelled</option>
                            <option value="4" <?php if($status=="Not Started"){ ?> selected="selected" <?php } ?>> Not started</option>
                            
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-2"></div>
                <div class="col-2">
                        
               <?php if(isset($_REQUEST["edit"])){
                   ?> 
                <input type="submit" name="btnUpdate" class="form-control btn btn-success" value="Update">  </div>
                <a href="admissions.php" class="btn btn-secondary"> Cancel </a>
               <?php } else {?>
                    <input type="submit" name="btnsubmit" class="form-control btn btn-primary" value="Submit" id="jk">  </div>
                    <a href="admissions.php" class="btn btn-secondary"> Cancel </a>
                    
               <?php } ?></div>
                </div>
            
                </div>
                            
            </form>
            
            <!-- student admission form end -->
            
            
        </div>
        
      
        </div>
    </body>
</html>