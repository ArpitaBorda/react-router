<?php
session_start();
include '../db.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $query = mysqli_query($con, "INSERT INTO category (name) VALUES ('$name')");

    echo "Category created";
}
$query = mysqli_query($con, "SELECT * FROM category");
$categories = mysqli_fetch_all($query);
?>

<h2>Manage Categories</h2>
<form method="post" action="">
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Add Category</button>
</form>

<ul>
    <?php foreach ($categories as $category): ?>
        <li><?php echo htmlspecialchars($category[1]); ?></li>
    <?php endforeach; ?>
</ul>

<a href="./product.php">Manage Products</a>
<br>
<a href="../logout.php">Logout</a>