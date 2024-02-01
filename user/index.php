<?php
  session_start();
  if(!isset($_SESSION['id'])){
    header("Location:../inc/log.php");
  }
  $current_time = time();
  $logout = 24 * 60 * 60 ;
  if($current_time - $_SESSION['login_time'] > $logout){
    session_destroy();
    header("Location:../inc/log.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dott the World</title> 
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
   <link rel="stylesheet" href="../style.css">
   <link rel="stylesheet" href="user.css">
</head>
<body>
     <main>
     <nav class="navbar navbar-expand-lg container">
        <div class="container">
          <a class="navbar-brand primaryT fs-1 fw-bold" href="index.html">Dott <span><i class="fa-brands fa-wirsindhandwerk"></i></span></a>
          <button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-black"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item mx-lg-3">
                <a class="nav-link text-white fw-bold " href="../index.php">Home</a>
              </li>
              <li class="nav-item mx-lg-3">
                <a class="nav-link text-white fw-bold ">Question</a>
              </li>
              <li class="nav-item mx-lg-3 ">
                <a class="nav-link text-white fw-bold ">Job Directory</a>
              </li>
              <li class="nav-item mx-lg-3 ">
                <a class="nav-link text-white fw-bold primaryB ">ASK A ANSWER</a>
              </li>
            </ul>
          </div>
          <button class="border-0 outline-0 d-lg-none " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"> <span class="navbar-toggler-icon text-black"></span></button>

         <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
         <div class="offcanvas-header">
         <h5 class="offcanvas-title" id="offcanvasRightLabel">Dott</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
       </div>
      <div class="offcanvas-body ps-5 d-flex flex-column">
        <a class="nav-link fw-bold text-white" href="../index.php">Home</a>
        <a class="nav-link fw-bold text-white my-2">Question</a>
        <a class="nav-link fw-bold text-white  my-2" >Job Directory</a>
        <a class="nav-link fw-bold text-white primaryB  my-2">ASK A ANSWER</a>
      </div>
    </div>
          </div>
        </div>
      </nav>
     </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>