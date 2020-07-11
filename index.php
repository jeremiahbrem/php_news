<?php include "templates/header.php"; ?>

<?php include 'connect.php'; ?>

<h1>Sign Up for News App</h1>

<?php include 'signup.php'; ?>

<form action="" method="POST">
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" name="first-name" required><br>
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" name="last-name" required><br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required><br>
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit">
</form>
    
<h2>Login</h2>

<?php include 'login.php'; ?>

<form action="" method="POST">
    <label for="username-login">Username</label>
    <input type="text" id="username-login" name="username-login"><br>
    <label for="password-login">Password</label>
    <input type="password" id="password-login" name="password-login"><br>
    <input type="submit">
</form>

<?php include "templates/footer.php"; ?>