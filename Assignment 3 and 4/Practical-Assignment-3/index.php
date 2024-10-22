<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");
    if(mysqli_num_rows($query) != 1)
    {
        echo "Credentials invalid";
    }
    else
    {
        $row = mysqli_fetch_assoc($query);
        if(!password_verify($password, $row['password']))
        {
            echo "Credentials invalid";
        }
        else
        {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role_id'] = $row['role_id'];

            if($row['role_id'] == 1)
            {
                header('location: admin/index.php');
            }
            else
            {
                header('location: user/index.php');
            }
        }
    }
}
?>

<form method="post" action="">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<a href="register.php">Register</a>