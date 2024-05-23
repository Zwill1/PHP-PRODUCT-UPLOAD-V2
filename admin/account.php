<?php include "../db/session.php" ?>
<?php include "../assets/header.php" ?>

<!-- display success when registering/logging in is done correctly -->
<?php        
    if(isset($_GET['acct_msg'])){
        echo 
        "<section class='container-fluid p-0'>
            <div class='bg-success p-2'>
                <div class='container text-white text-center fw-bold'>
                    <h6 class='text-center'>".$_GET['acct_msg']."</h6>
                </div>
            </div>
        </section>";
    }       
?>
<?php        
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

<!-- Set up local storage for session value and allow the nav to pick up if a session exists -->

<!-- Protected content here -->

<!-- Additional Security Measures

    Use HTTPS: Ensure your site is served over HTTPS to protect data in transit.
    Limit Login Attempts: Implement a mechanism to limit login attempts and prevent brute force attacks.
    Session Management: Regenerate session IDs on login and logout to prevent session fixation attacks.
    Password Policies: Enforce strong password policies to ensure users create strong passwords.
    Input Validation and Sanitization: Always validate and sanitize user input to prevent XSS and other injection attacks. -->

<div class="container">
    <div class="row">
        <p>account</p>
    </div>
</div>