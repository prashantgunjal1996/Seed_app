<html>
    <head>
     <!-- bootstrap -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
    .jk{
        overflow-x:scroll;
    }
    </style>
    </head>
    <body>
      <?php
             $row =""; 
             $Admid = "";
             $Add="";
             $msg="";
             //connect to database.... 
             include("include/dbconnection.php");

             if(isset($_REQUEST['delete'])){
                 $delete=$_REQUEST['delete'];
                 $qry="DELETE FROM admission WHERE adm_id=$delete";
                 mysqli_query($con,$qry);
                 if(mysqli_error($con))
                 {
                     $msg= "Error".mysqli_error($con);
                 }
                 else{
                     $msg="Student Deleted Successfully!";
                 }
                 
             }
      ?>
        <div class="container">
        <?php 
                
                include("include/header.php");
                if(!isset($_SESSION['username']) && $_SESSION['username']=="")
                 {
                     header("Location:index.php");
                  }
                                
        
       
        ?>
        <section>
            
            <h3 class="mt-4 ">Student Details... </h3>
            <?php if($msg!=""){ ?>
            <div class="alert alert-success" role="alert">
                <?=$msg?>
                <a href="studentList.php" class="alert-link">Click - Student List</a>
            </div>
            <?php  } ?>
            <hr>
            <div class="jk">
            <table class="table" border='2' width="90">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col"> Name</th>
                    
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Pincode</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">College</th>
                    <th scope="col">Course</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php 
                     if(isset($_REQUEST['view']))
                     {
                         $AdmId = $_REQUEST['view'];
             
                         $qry = "SELECT * FROM admission WHERE adm_id = '$AdmId' ";
                         $admissionList = mysqli_query($con,$qry);
                         if($admissionList)
                         {
                             $Add = mysqli_fetch_assoc($admissionList);
                           
                ?>
                <tbody>
               
                         
                        <td><?=$Add['adm_id']?></td>
                        <td><?=$Add["stud_first_name"]." ".$Add["stud_last_name"]?></td>
                    
                        <td><?=$Add["stud_email"]?></td>
                        <td><?=$Add["stud_mobile"]?></td>
                        <td><?=$Add["stud_address"]?></td>
                        <td><?=$Add["stud_city"]?></td>
                        <td><?=$Add["stud_pincode"]?></td>
                        <td><?=$Add["stud_qualification"]?></td>
                        <td><?=$Add["stud_college"]?></td>
                        <td><?php   
                                    $courseid=$Add["course_id"];
                                    $qry="SELECT * FROM course WHERE course_id=".$courseid;
                                    $courseIdList=mysqli_query($con,$qry);
                                    $row = mysqli_fetch_assoc($courseIdList);
                                    echo $row['course_name'];
                                ?>
                        </td>
                        <td><?=$Add['status']?></td>
                        <td> 
                            <a href="admissions.php?edit=<?=$Add["adm_id"]?>" ><img src="images/edit.png" title="Edit" width=16px; ></a> |
                           
                            <a href="studentDetails.php?delete=<?=$Add["adm_id"]?>"><img src="images/delete.png" title="Delete" width=16px; ></a>
                          
                        </td>
                    </tr>
                </tbody>
                         <?php } } ?>
                </table>
                </div>

                <section>
        </div>
        
    </body>
</html>