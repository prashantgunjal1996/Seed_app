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
    <div class="container">
    <?php include("include/dbconnection.php");
          include("include/header.php");
                         if(!isset($_SESSION['username']) && $_SESSION['username']=="")
                         {
                             header("Location:index.php");
                         }  
    
    ?>
        <section>
        <h3 class="mt-3 mb-3">Student Lists....</h3>
        <hr>
         
        <!-- <div class="row"> -->
            <?php if(isset($_SESSION['msg'])) 
            if($_SESSION['msg']!="") :?>
            <div class="alert alert-success" role="alert">
                <?=$_SESSION['msg'];?>
            </div>
            <?php endif;?>
            <?php unset($_SESSION['msg']);?>
                     

        <table class="table">
                
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $qry="SELECT * FROM admission";
                        $admissionList=mysqli_query($con,$qry);
                     { while($row =mysqli_fetch_assoc($admissionList)) {
                    ?>        
                    <tr>                
                    <td><?=$row['adm_id']?></td>
                        <td><?=$row['stud_first_name']?></td>
                        <td><?=$row["stud_email"]?></td>
                        <td><?=$row["stud_mobile"]?></td>
                        <td><?=$row["stud_address"]?></td>
                        <td> 
                            <a href="studentDetails.php?view=<?=$row["adm_id"]?>"> VIEW </a>        
                        </td>
                    </tr>
                    <?php } }?>
                <div class="col-5"></div>
              </section>
        </div>
        </body>
        </html>