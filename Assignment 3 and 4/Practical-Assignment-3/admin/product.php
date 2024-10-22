<?php
session_start();
include '../db.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $_FILES['image']['name']);
    $query = mysqli_query($con, "INSERT INTO product (name, price, image, category_id) VALUES ('$name', $price, '$image', $category_id)");

    echo "Product created";
}
$query = mysqli_query($con, "SELECT * FROM product");
$products = mysqli_fetch_all($query, MYSQLI_ASSOC);

$category_query = mysqli_query($con, "SELECT * FROM category");
$categories = mysqli_fetch_all($category_query);
?>

<h2>Manage Products</h2>
<form method="post" action="" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" name="price" placeholder="Product Price" required>
    <input type="file" name="image" placeholder="Product Image" required>
    <select required name="category_id">
        <option value="">-Select Category-</option>
        <?php
            foreach ($categories as $category) 
            {?>
                <option value="<?php echo $category[0]; ?>"><?php echo $category[1]; ?></option>    
            <?php
            }
        ?>
    </select>
    <button type="submit">Add Product</button>
</form>

<table width="100%" border="2">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($products as $product) 
            {?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><img src="../images/<?php echo $product['image']; ?>" width="200"></td>
            </tr>    
            <?php
            }
        ?>
    </tbody>
</table>

<a href="./index.php">Manage Category</a>
<br>
<a href="../logout.php">Logout</a>