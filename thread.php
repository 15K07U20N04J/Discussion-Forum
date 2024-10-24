<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - Coding Forums </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



</head>

<body>
    <?php   include "partials/_dbconnect.php";    ?>
    <?php   include "partials/_header.php";    ?>

    <?php
    $tid = $_GET['threid'];  
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comment = $_POST['comment'];
        $comment = str_replace('<','&lt;',$comment);
        $comment = str_replace('>','&gt;',$comment);
        $user_id = $user = $_SESSION['user_id'];
        $sql = "INSERT INTO comments (comment_content, thread_id, comment_by) VALUES ('$comment', '$tid', '$user_id')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>SUCCESS!</strong> Your Comment has been Posted Successfully!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>

    <?php

    $tid = $_GET['threid'];
    $sql = "SELECT * FROM threads WHERE thread_id = $tid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $thtitle = $row['thread_title'];
    $thdesc = $row['thread_desc'];
    $thread_user_id = $row['thread_user_id'];

    $sql2 = "SELECT user_email FROM users WHERE user_id = '$thread_user_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    
    ?>

    <div class="container my-4" style="width:800px">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-2">
                <h6 class="display-5 fw-bold"><?php echo $thtitle ?></h6>
                <p class="my-4"><?php echo $thdesc ?></p>
                <p>Posted By : <b><?php echo $row2["user_email"];?></b></p>
            </div>
        </div>

        <div class="container">
            <h1 class="py-3">Post a Comment</h1>
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<form action="'.$_SERVER['REQUEST_URI'] .'" , method="post">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Type your Comment</label>
                            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>';
            }
            else {
                echo'<p>You are not logged in. Please login to be able to post a comment.</p>';
            }

            ?>
            <h1 class="py-3">Discussion</h1>

            <?php
                $tid = $_GET['threid'];
                $sql = "SELECT * FROM comments WHERE thread_id = $tid";
                $result = mysqli_query($conn, $sql);
                $cntcomm = mysqli_num_rows($result);
                if($cntcomm > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $comid = $row['comment_id'];
                        $comment_content  = $row['comment_content'];
                        $time = $row['comment_time'];
                        $comment_by = $row['comment_by'];
                        
                        $sql2 = "SELECT user_email FROM users WHERE user_id = '$comment_by'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        
                        echo '<div class="d-flex my-4">
                                <div class="flex-shrink-0">
                                    <img src="img/user.png" style="height:46px" alt="...">
                                </div>
                            
                                <div class="flex-grow-1 ms-3">
                                    <p class="fw-semibold my-0">'.$row2['user_email'].'  at '.$time.'</p>
                                    '.$comment_content.'
                                </div>
                            </div>';
                    }
                }
                else {
                    echo '<div class="container-fluid py-1">
                <p class="display-6 my-4 text-left fw-bold">No Comments Found</p>
                <p class="my-4">Be the first person to Post a Comment</p>
                
            </div>';
                }
            ?>

        </div>
    </div>

    <?php   include "partials/_footer.php";    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>