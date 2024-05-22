<?php
session_start();

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
    $password = trim($_POST["password"]);

    // Validate input
    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Fetch user from database
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start a new session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "Login successful!";
        header("location:../admin/account.php?acct_msg=Registration successful!");
    } else {
        echo "Invalid username or password.";
    }
}
?>
<?php include "../assets/header.php" ?>
<?php include "../assets/products-page-tags.php" ?>

<div class="container">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Login to your Account</h1>
    </section>
    <section class="row">
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">Username</label>
                <input type="text" class="form-control" id="firstName" placeholder="Enter your username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </section>

<?php include "../assets/footer.php" ?>