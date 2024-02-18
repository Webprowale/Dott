<?php
$err_field = $succ = $err_pass = $err_username = $err_email = "";
$creat_email = null;
 $creat_pass = null;
 $creat_username = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $creat_username = htmlspecialchars(filter_input(INPUT_POST, "creat_name", FILTER_SANITIZE_SPECIAL_CHARS));
    $creat_email = htmlspecialchars(filter_input(INPUT_POST, "creat_email", FILTER_VALIDATE_EMAIL));
    $creat_pass = htmlspecialchars(filter_input(INPUT_POST, "creat_pass", FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($creat_email) || empty($creat_pass) || empty($creat_username)) {
        $err_field = "All the input fields are required";
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d !@#$%^&*()-_=+]*$/', $creat_pass)) {
            $err_pass = "Minimum 8 character";
        } else {
            $hash = password_hash($creat_pass, PASSWORD_DEFAULT);
            include('./index.php');
            $check_user = $db_conn->prepare("SELECT * FROM auth WHERE username =?");
            $check_user->bind_param("s", $creat_username );
            $check_user->execute();
            $result_user = $check_user->get_result();
            if($result_user->num_rows > 0){
                $err_username = "Username already exists. Please choose a different one";
                $check_user->close();
            }else{
                $check_email = $db_conn->prepare("SELECT * FROM auth WHERE email =?");
                $check_email->bind_param("s", $creat_email);
                $check_email->execute();
                $result_email = $check_email->get_result();
                if($result_email->num_rows > 0){
                   $err_email = "Email already exists. Please choose a different one";
                   $check_email->close();
            }else{
            $sql = $db_conn->prepare("INSERT INTO auth (username, email, password) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $creat_username, $creat_email, $hash);
            if ($sql->execute()) {
                $succ = "Registration successful. You can now <a href='log.php'>login</a>.";
            } else {
                $err_use = "Error during registration: " . $sql->error;
            }
            $sql->close();
        }
        }
            mysqli_close($db_conn);
        }
          
        
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="auth.css">
</head>

<body>
    <main class="create">
        <div class="container pt-5">
            <div class="text-center pt-5">
                <h1>Welcome to Dott!</h1>
            </div>
            <div class="mt-2">
            <h4 class=" bgW text-success text-center w-10"><?= $succ ?></h4>
            <h4 class=" bgW text-danger text-center w-10"><?= $err_field ?></h4>
            </div>
            <div class="row justify-content-center mt-2 pt-5">
                <div class="col-md-6">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="shadow ">
                        <div class=" form-group mb-3">
                            <input type="text" class="form-con" value="<?= $creat_username ?>" name="creat_name" placeholder="Enter username">                           <div class="text-danger">
                                <div class="text-danger fw-bold"><?= $err_username ?></div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" value="<?= $creat_email ?>" class="form-con " name="creat_email" placeholder="Enter Email Address">
                            <div class="text-danger fw-bold"><?= $err_email ?></div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="pss d-flex">
                            <input type="password" id="passwordInput" class="passwordInput ps-1" value="<?= $creat_pass ?>"   name="creat_pass" placeholder="Enter password">
                            <span class=" password-toggle" onclick="togglePassword()" id="passwordToggle"><i class="fas fa-eye"></i></span>
                            </div>
                            <div class="text-danger">
                                <?= $err_pass ?>
                            </div>
                        </div>
                        <input type="submit" value="Join Dott" class=" ms-1 btn btn-outline-info px-3 fs-5 fw-bold w-50 sendbtn">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="auth.js"></script>
</body>

</html>