<?php

    include "database.php"; // Using database connection file here
    $mysqli = connectdb(); 
    $id = $_GET['id']; // get id through query string

    $delete = mysqli_query($mysqli,"DELETE from stories where newsid = '$id'"); // delete query

    if($delete)
    {
        mysqli_close($mysqli); // Close connection
        header("location: index.php"); // redirects to all records page
        exit;	
    } else
    {
        echo "Error deleting record"; // display error message if not delete
    }
?>