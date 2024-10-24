<?php
    session_start();
     echo '<nav class="navbar bg-dark navbar-expand-lg border-bottom border-body" data-bs-theme="dark">
     <div class="container-fluid">
       <a class="navbar-brand" href="#">iDiscuss</a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="index.php">Home</a>
           </li>
           <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="about.php">About</a>
           </li>
           <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Top Categories
               <ul class="dropdown-menu">
             </a>';
             $sql = "SELECT category_name, category_id FROM categories LIMIT 4";
             $result = mysqli_query($conn, $sql);
             while($row = mysqli_fetch_assoc($result)){
               echo '<li><a class="dropdown-item" href="threadList.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
             }
               
             echo '</ul>
           </li>
           <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
           </li>
         </ul>
         <form class="d-flex" action="search.php" method = "get">
           <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
           <button class="btn btn-success mx-2" type="submit">Search</button>
         </form>';
         if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
            echo '<p class="my-2 mx-2 text-white">Welcome '.$_SESSION["useremail"].'</p>
           <a href="partials/_logout.php" class="btn btn-outline-success mx-2" type="submit">Logout</a>';
         }
         else{
          echo'
          <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal" type="submit">Login</button>
          <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal" type="submit">SignUp</button>
          ';
         }
   
       echo '
       </div>
     </div> 
   </nav>';

   include "_loginModal.php";
   include "_signupModal.php";

   if(isset($_GET['sigunupsuccess']) && $_GET['sigunupsuccess'] === "true" ) {
    echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Account has been created successfully. You can login now.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';  
   }

   if(isset($_GET['showerror']) && $_GET['showerror'] != "" ) {
    echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
            <strong>Warning! </strong> '.$_GET['showerror'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';  
   }
?>