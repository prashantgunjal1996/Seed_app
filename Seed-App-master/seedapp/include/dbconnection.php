<?php

//Connecting to the database...
    $con = mysqli_connect("localhost","root","","seed_db");
    if(mysqli_connect_error())
    {
        echo "Error in connection: ".mysqli_connect_error();
    }
    

?>