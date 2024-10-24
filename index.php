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

    <!-- Slider starts here. -->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://media.licdn.com/dms/image/C4E12AQFCW1WDUb8Ipg/article-cover_image-shrink_720_1280/0/1645456014612?e=2147483647&v=beta&t=fHvWJVG85uTIXkFcLNVKUAiWWO3dwyvHhFB-tJCJWZ4"
                    height="600px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://tanakasanji.site/wp/wp-content/uploads/2023/06/f6155152be8b3e7a2ac6803cde64d2fd.jpg"
                    height="600px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://superblog.supercdn.cloud/site_cuid_clvc4016q001j13bhaleswmt1/images/5-1716408503525-compressed.jpg"
                    height="600px" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- category container starts here. -->
    <div class="container">
        <h2 class="text-center my-4">
            iDiscuss - Categories
        </h2>
        <!-- Use a loop to iterate throgh categories -->
        <div class="row">

            <?php
                $sql = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);

                if($num > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $cat = $row["category_name"];
                        $desc = $row["category_description"];
                        $id = $row["category_id"];
                        echo '<div class="col-md-3">
                                <div class="card my-2" style="width: 18rem;">
                                    <img src="https://www.digitalnest.in/blog/wp-content/uploads/2019/06/PythonProgramming-740x493.jpg"
                                    class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"> <a href="threadList.php?catid='.$id.'">'.$cat.'</a></h5>
                                        <p class="card-text">'. substr($desc, 0, 93).'...</p>
                                        <a href="threadList.php?catid='.$id.'" class="btn btn-success">View Threads</a>
                                    </div>
                                </div>
                            </div>';
                    }
                }
            ?>
            <!-- <div class="col-md-3">
                <div class="card my-2" style="width: 18rem;">
                    <img src="https://www.digitalnest.in/blog/wp-content/uploads/2019/06/PythonProgramming-740x493.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-success">View Threads</a>
                    </div>
                </div>
            </div> -->

        </div>
    </div>


    <?php   include "partials/_footer.php";    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>