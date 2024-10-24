<?php

$showerr = "";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "_dbconnect.php";
    $user_email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "SELECT * FROM users WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];

        if(password_verify($pass, $row['user_pass'])) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['useremail']  = $user_email;
        $_SESSION['user_id'] = $user_id;
        header("location: /forum/index.php");
        }
        else {
            $showerr = "Invalid user email and password";
        }
    }
    else {
        $showerr = "Invalid user email and password";
    }
    header("location: /forum/index.php?showerror=$showerr");
  
}

?>