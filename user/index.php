<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location:../inc/log.php");
}
$current_time = time();
$logout = 24 * 60 * 60;
if ($current_time - $_SESSION['login_time'] > $logout) {
  session_destroy();
  header("Location:../inc/log.php");
  exit();
}
# USER DETAILS
$first_name = $last_name = "";
if(isset($_POST['upload_user'])){
  $first_name = htmlentities(filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $last_name = htmlentities(filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $bio = htmlspecialchars(filter_input(INPUT_POST, "bio", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dott || let dot the world</title>
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
        <button class=" d-lg-none " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background-color: transparent; border:none; outline:none;"><i class="fa-solid fa-bars fs-2 primaryT"></i></button>

        <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title primaryT fs-1 fw-bold" id="offcanvasRightLabel">Dott <span><i class="fa-brands fa-wirsindhandwerk"></i></span></h5>
            <button type="button" class="fa-solid fa-xmark primaryT fs-4" data-bs-dismiss="offcanvas" aria-label="Close" style="background-color: transparent;border:none; outline:none;"></button>
          </div>
          <div class="offcanvas-body ps-5 d-flex flex-column">
            <a class="nav-link fw-bold text-white" href="../index.php">Home</a>
            <a class="nav-link fw-bold text-white my-2">Question</a>
            <a class="nav-link fw-bold text-white  my-2">Job Directory</a>
            <a class="nav-link fw-bold text-white primaryB  my-2 px-3" style="width: fit-content;">ASK A ANSWER</a>
          </div>
        </div>
      </div>
      </div>
    </nav>
    <section class="d-flex px-5 justify-content-center align-items-center flex-column" id="newUser">
      <div class="header">
        <h2 class="fs-4 text-white fw-bold">Welcome <span class="primaryT fs-2"><?= $_SESSION['username']?></span></h2>
        <h5 class="text-white textS">Let us set up your profile to aid optimization</h5>
      </div>
    <div class=" mx-5  bg-white rounded p-3 userinfo">
      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 mb-1">
            <input type="text" name="first_name" class=" form-control" placeholder="Enter your first name">
          </div>
          <div class="col-12">
            <input type="text" name="last_name" class="form-control" placeholder="Enter your last name">
          </div>
          <div class="col-12">
            <textarea name="bio" class="form-control bio" placeholder="Enter your bio description" onfocus="userBio()" oninput="userBio()"></textarea>
            <span class="text-danger textBio textS"></span>
          </div>
          <div class="col-12">
            <div class="d-flex flex-column">
            <label for="file" class="text-black fw-bold ">Profile Image</label>
            <input type="file" name="prof_img" placeholder="Upload profile image">
            </div>
          </div>
          <input type="submit" name="upload_user" value="Update Profile" class="btn w-80 mt-4 primaryB text-white fw-bold">
        </div>
      </form>
    </div>
    </section>
    <section class="container-fiuld">

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="user.js"></script>
</body>

</html>