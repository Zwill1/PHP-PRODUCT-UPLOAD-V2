<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../db/register.php");
    exit;
}
?>
<?php include "../assets/header.php" ?>
<?php include "../assets/products-page-tags.php" ?>

<!-- Protected content here -->

<!-- Additional Security Measures

    Use HTTPS: Ensure your site is served over HTTPS to protect data in transit.
    Limit Login Attempts: Implement a mechanism to limit login attempts and prevent brute force attacks.
    Session Management: Regenerate session IDs on login and logout to prevent session fixation attacks.
    Password Policies: Enforce strong password policies to ensure users create strong passwords.
    Input Validation and Sanitization: Always validate and sanitize user input to prevent XSS and other injection attacks. -->

<p>account</p>