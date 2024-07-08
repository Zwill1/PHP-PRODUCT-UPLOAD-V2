<?php include "dbcon-pdo.php" ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmpassword = trim($_POST["confirmpassword"]);

    // Validate input
    if (empty($username) || $username == "") {
        // die("Please fill in all fields.");
        header("location:./register.php?message=Please fill in all form fields!");
    }
    if (empty($email) || $email == "") {
        // die("Please fill in all fields.");
        header("location:./register.php?message=Please fill in all form fields!");
    }
    if (empty($password) || $password == "") {
        // die("Please fill in all fields.");
        header("location:./register.php?message=Please fill in all form fields!");
    }
    if (empty($confirmpassword) || $confirmpassword == "") {
        // die("Please fill in all fields.");
        header("location:./register.php?message=Please fill in all form fields!");
    }
    // if (empty($username) || empty($email) || empty($password)) {
    //     // die("Please fill in all fields.");
    //     header("location:./register.php?message=Please fill in all form fields!");
    // }

    // Check if passwords match
    if ($password !== $confirmpassword) {
        // die("Passwords do not match.");
        header("location:./register.php?message=Passwords do not match.");
    }

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    // Using BindParam for more security
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // $stmt->execute(['username' => $username, 'email' => $email]);
    if ($stmt->fetch()) {
        // die("Username or email already taken.");
        header("location:./register.php?message=Username or email already taken.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    // Using BindParam for more security
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

    // if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password])) 
    
    if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password])){
        // echo "Registration successful!";
        // header("location:../admin/account.php?reg_msg=Registration Successful!");
        header("location: login.php?reg_msg=Registration Successful!");
    } else {
        echo "Something went wrong. Please try again.";
    }
}
?>
<?php include "../assets/header.php" ?>

<?php 
if(isset($_GET['message'])){
    echo 
    "<section class='container-fluid p-0'>
        <div class='bg-danger p-2'>
            <div class='container text-white text-center fw-bold'>
                <h6 class='text-center'>".$_GET['message']."</h6>
            </div>
        </div>
    </section>";
}  
?>

<div class="container my-5">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Register for an Account</h1>
    </section>
    <section class="row">
        <div class="col-md-6 offset-md-3">
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="firstName" class="form-label">Username</label>
                    <input type="text" class="form-control rounded-0" id="firstName" placeholder="Enter your username" name="username">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control rounded-0" id="email" placeholder="name@example.com" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control rounded-0" id="password" placeholder="Enter your password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control rounded-0" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword">
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-0">Register</button>
            </form>
        </div>
    </section>
</div>
    <script>
        // MIDDLEWARE: Check if session data exists. if exists, move back to account page
        if(localStorage.getItem('username' && 'user_id')) {
            // Redirect to another page
            window.location.replace("../admin/account.php");
        }
    </script>

<?php include "../assets/footer.php" ?>