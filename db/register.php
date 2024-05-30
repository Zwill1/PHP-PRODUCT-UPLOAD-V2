<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpproductupload";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmpassword = trim($_POST["confirmpassword"]);

    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Check if passwords match
    if ($password !== $confirmpassword) {
        die("Passwords do not match.");
    }

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);
    if ($stmt->fetch()) {
        die("Username or email already taken.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password])) {
        // echo "Registration successful!";
        // header("location:../admin/account.php?reg_msg=Registration Successful!");
        header("location: login.php?reg_msg=Registration Successful!");
    } else {
        echo "Something went wrong. Please try again.";
    }
}
?>
<?php include "../assets/header.php" ?>

<div class="container">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Register for an Account</h1>
    </section>
    <section class="row">
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">Username</label>
                <input type="text" class="form-control" id="firstName" placeholder="Enter your username" name="username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
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