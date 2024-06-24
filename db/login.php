<?php include "dbcon-pdo.php" ?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validate input
    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Fetch user from database
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
    // Using BindParam for more security
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    // $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start a new session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "Login successful!";
        // header("location:../admin/account.php?acct_msg=Login Successful!");
    } else {
        echo "Invalid username or password.";
    }
}

?>
<?php include "../assets/header.php" ?>

<!-- display message when logging out -->
<?php        
if(isset($_GET['log_msg'])){
    echo 
    "<section class='container-fluid p-0'>
        <div class='bg-success p-2'>
            <div class='container text-white text-center fw-bold'>
                <h6 class='text-center'>".$_GET['log_msg']."</h6>
            </div>
        </div>
    </section>";
}
if(isset($_GET['reg_msg'])){
    echo 
    "<section class='container-fluid p-0'>
        <div class='bg-success p-2'>
            <div class='container text-white text-center fw-bold'>
                <h6 class='text-center'>".$_GET['reg_msg']."</h6>
            </div>
        </div>
    </section>";
}            
?>


<div class="container my-5">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Login to your Account</h1>
    </section>
    <section class="row">
        <div class="col-md-6 offset-md-3">
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="firstName" class="form-label">Username</label>
                    <input type="text" class="form-control rounded-0" id="firstName" placeholder="Enter your username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control rounded-0" id="password" placeholder="Enter your password" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-0">Login</button>
            </form>
        </div>
    </section>
</div>
    <script>
        // Check if session data exists
        if(<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
            // Store session data in local storage
            localStorage.setItem('user_id', <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>);
            localStorage.setItem('username', '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>');

            // Redirect to another page
            window.location.replace("../admin/account.php?acct_msg=Login Successful!");
        }
    </script>

<?php include "../assets/footer.php" ?>