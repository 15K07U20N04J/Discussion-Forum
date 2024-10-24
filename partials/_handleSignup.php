<?php

$showerr = "";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "_dbconnect.php";
    $email = $_POST['signupemail'];
    $pass = $_POST['signuppass'];
    $cpass = $_POST['conPass'];

    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $cntOfUser = mysqli_num_rows($result); 
    
    if($cntOfUser == 0) {
        if($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql= "INSERT INTO users (user_email, user_pass) VALUES ('$email', '$hash')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $showalert = true;
                header("location: /forum/index.php?sigunupsuccess=true");
                exit();
            }
        }
        else {
            $showerr = "Password Do Not Match";
        }
    }
    else{
        $showerr = "User Email is already exists. Please try with another user email.";
    }

    header("location: /forum/index.php?sigunupsuccess=false&showerror=$showerr");
}

?>