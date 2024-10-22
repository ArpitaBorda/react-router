<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $user_input = $_POST['captcha_input'];

    if (strtolower($user_input) != strtolower($_SESSION['captcha'])) {
        echo "CAPTCHA verification unsuccessful!";
    }
    else
    {
        $query = mysqli_query($con, "INSERT INTO users (name, password, email, role_id) VALUES ('$name', '$password', '$email', 2)");
    
        echo "Registration successful!";
    }
}
?>

<form method="post" action="register.php">
    <input type="text" name="name" placeholder="Name" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="captcha_input" placeholder="Enter CAPTCHA" required>

    <img src="captcha.php" alt="CAPTCHA">
    <button type="submit">Register</button>
</form>

<a href="index.php">Back to Login</a>