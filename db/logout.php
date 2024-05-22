<?php
session_start();
$_SESSION = array();
session_destroy();
// header("Location: login.php");
// exit;
?>


<script>
        // Remove session data from local storage
        localStorage.removeItem('user_id');
        localStorage.removeItem('username');

        // Redirect to another page
        window.location.replace("login.php?log_msg=Logout Successful!");
</script>