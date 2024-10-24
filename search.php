<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - Coding Forums </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .container{
            min-height:85vh;
        }
    </style>
</head>

<body>

    <?php   include "partials/_dbconnect.php";    ?>
    <?php   include "partials/_header.php";    ?>

    <div class="container my-2">
        <h1 class="py-3">Search Results for <em>"<?php echo $_GET["search"]?>"</em></h1>
        <?php
        $searchQue = $_GET["search"];
        $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title, thread_desc) AGAINST ('$searchQue')";
        $result = mysqli_query($conn, $sql);
        $cntOfResults = mysqli_num_rows($result);
        if($cntOfResults > 0) {
            while($row = mysqli_fetch_assoc($result)){
                echo'<div class="row">
                        <h3><a href="thread.php?threid='.$row['thread_id'].'" class="text-dark">'.$row['thread_title'].'</a></h3>
                        <p>'.$row['thread_desc'].'</p>
                    </div>
                ';
            }
        }
        else {
            echo '<h3>"No Search Results Found On '. $searchQue .'"</h3>';
        }
        ?>
        


    </div>


    <?php   include "partials/_footer.php";    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>