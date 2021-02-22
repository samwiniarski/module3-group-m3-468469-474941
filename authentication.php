<?php

require 'database.php';


if(isset($_POST['register'],$_POST['username'],$_POST['password'])){
    $mysqli = connectdb(); 
    $new_user = $_POST['username'];//must check if username already exists??
    $new_pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt = $mysqli -> prepare("INSERT INTO users (id,hashed_password) values (?,?)");
                
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    } else {
        echo "Query successful!";            
        $stmt->bind_param('ss', $new_user, $new_pwd);
        $stmt->execute();
        $stmt->close();
    }
}else if(isset($_POST['login'])){
    // Use a prepared statement
    $stmt = $mysqli->prepare("SELECT COUNT(*), id, hashed_password FROM users WHERE username=?");

    // Bind the parameter
    $stmt->bind_param('s', $user);
    $user = $_POST['username'];
    $stmt->execute();

    // Bind the results
    $stmt->bind_result($cnt, $user_id, $pwd_hash);
    $stmt->fetch();

    $pwd_guess = $_POST['password'];
    // Compare the submitted password to the actual password hash

    if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
        // Login succeeded!
        $_SESSION['token'] = bin2hex(random_bytes(32));
        if(!hash_equals($_SESSION['token'], $_POST['token'])){
            die("Request forgery detected");
        }
        $_SESSION['user_id'] = $user_id;
        // Redirect to your target page
        header("Location: index.php");
        exit;
    } else{
        // Login failed; redirect back to the login screen
        header("Location: login.php");
        exit;
    }
}

?>