<!-- Log out user and redirect to signup/login page -->
<?php
    session_start();
    unset($_SESSION['current_user']);
    header("Location: index.php");
?>