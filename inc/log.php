<?php
session_start();
$_SESSION['login_time'] = time();
$log_username = "";
$log_pass ="";
$err_field = "";
$err_username = "";
$err_pass = "";
$succ = "";
$password = "";
if($_SERVER['REQUEST_METHOD']== 'POST'){
   $log_username = htmlspecialchars(filter_input(INPUT_POST, "log_username", FILTER_SANITIZE_SPECIAL_CHARS));
   $log_pass = htmlspecialchars(filter_input(INPUT_POST, "log_pass", FILTER_SANITIZE_SPECIAL_CHARS));
    if(empty($log_pass) || empty($log_username)){
      $err_field = " All the field is required";
    }else{
      include("./index.php");
       $check_user = $db_conn->prepare("SELECT * FROM auth WHERE username = ? ");
       $check_user->bind_param("s", $log_username);
       $check_user->execute();
       $res = $check_user->get_result();
       if(!$res->num_rows > 0){
        $err_username = "Username does not exist";
       }else{
        $user = $res->fetch_assoc();
        $user_id = $user['id'];
        $_SESSION['id'] = $user_id;
        $_SESSION['username'] = $log_username;
        $password = $user['password'];
        if(password_verify($log_pass, $password)){
          $succ = "Login Successfully";
          header("location:../user/index.php");
          exit();
        } else{
          $err_pass = "Incorrect password";
        }
       }
       $check_user->close();
      mysqli_close($db_conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dott"t || dot the world</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <main class="log">
    <div class="container pt-5">
        <div class="text-center pt-5">
            <h1 class="text-info">Login to Dott!</h1>
        </div>
        <div class="mt-2">
            <h4 class=" bgW text-success text-center w-10"><?= $succ ?></h4>
            <h4 class=" bgW text-danger text-center w-10"><?= $err_field ?></h4>
            </div>
        <div class="row justify-content-center pt-5">
            <div class="col-md-6">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="shadow ">
                    <div class=" form-group mb-3">
                        <input type="text" class="con-form " value="<?= $log_username ?>" name="log_username" placeholder="Enter username" aria-label="Username">
                        <div class="text-danger">
                        <?= $err_username ?>
                          </div>
                    </div>
                    <div class=" form-group mb-3">
                    <div class="pss d-flex bg-white">
                            <input type="password" id="passwordInput" class="passwordInputU" value="<?= $log_pass ?>"   name="log_pass" placeholder="Enter password">
                            <span class=" password-toggleU" onclick="togglePassword()" id="passwordToggle"><i class="fas fa-eye"></i></span>
                            </div>
                        <div class="text-danger">
                        <?= $err_pass ?>
                          </div>
                    </div>
                  <input type="submit" value="Join Dott" class=" ms-2 btn bg-white w-50 text-info px-3 fs-5 fw-bold ">
                </form>
            </div>
        </div>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="auth.js"></script>
</body>

</html>
