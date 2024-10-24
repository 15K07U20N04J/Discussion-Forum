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
    $cid = $_GET['catid'];  
    $insert = false;
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['thtitle'];
        $title = str_replace('<','&lt;',$title);
        $title = str_replace('>','&gt;',$title);

        $desc = $_POST['thdesc'];
        $desc = str_replace('<','&lt;',$desc);
        $desc = str_replace('>','&gt;',$desc);
        
        $user = $_SESSION['user_id'];
        $sql = "INSERT INTO threads (thread_title, thread_desc, thread_cat_id, thread_user_id) VALUES ('$title', '$desc', $cid, '$user')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>SUCCESS!</strong> Your Thread has been Added!. Please Wait for Community Responds.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>


    <div class="container my-4" style="width:800px">

        <?php
            $cid = $_GET['catid'];
            $sql = "SELECT * FROM categories WHERE category_id = $cid";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $catName  = $row['category_name'];
            $catDesc = $row['category_description'];
            echo '<div class="p-3 mb-3 bg-body-tertiary rounded-3">
            <div class="container-fluid py-2">
                <h2 class="display-6 fw-bold">'.$catName.'</h2>
                <p class="my-4">'.$catDesc.'</p>
                <button class="btn btn-primary btn-lg" type="button">Learn More</button>
            </div>
        </div>';
        ?>

        <?php
        // session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
        echo'<div class="container">
            <h1 class="py-3">Start a Discussion</h1>

            <form action="'.$_SERVER["REQUEST_URI"].'" , method="post">
                <div class="mb-3">
                    <label for="thtitle" class="form-label">Problem title</label>
                    <input type="text" class="form-control" name="thtitle" id="thtitle">
                </div>
                <div class="mb-3">
                    <label for="thdesc" class="form-label">Ellobrate your concern</label>
                    <textarea class="form-control" name="thdesc" id="thdesc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>';
        }
        else{
            echo' <h1 class="py-3">Start a Discussion</h1>
                <p>You are not logged in. Please login to be able to start a discussion</p>';
        }
        ?>

        <h1 class="py-3">Browse Questions</h1>

        <?php
                $cid = $_GET['catid'];
                $sql = "SELECT * FROM threads WHERE thread_cat_id = $cid";
                $result = mysqli_query($conn, $sql);
                $cntQue = mysqli_num_rows($result);
                if($cntQue > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $thid = $row['thread_id'];
                        $threadTitle  = $row['thread_title'];
                        $threadDesc = $row['thread_desc'];
                        $time = $row['timestamp'];
                        $thread_user_id = $row['thread_user_id'];
                        
                        $sql2 = "SELECT user_email FROM users WHERE user_id = '$thread_user_id'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        
                        echo '<div class="d-flex my-4">
                                <div class="flex-shrink-0">
                                    <img src="img/user.png" style="height:46px" alt="...">
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <p class="fw-semibold my-0">'.$row2["user_email"].'  at '.$time.'</p>
                                    <h6 class="mt-0 "> <a href="thread.php?threid='.$thid.'">'.$threadTitle.'</a></h6>
                                    '.$threadDesc.'
                                </div>
                            </div>';
                    }
                }
                else {
                    echo '<div class="container-fluid py-1">
                <p class="display-6 my-4 text-left fw-bold">No Threads Found</p>
                <p class="my-4">Be the first person to ask a questions</p>
                
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