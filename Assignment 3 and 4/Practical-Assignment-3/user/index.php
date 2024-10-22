<?php
    session_start();
    require "../db.php";

    if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
        header("Location: ../index.php");
        exit;
    }

    if(isset($_GET['cat']))
    {
        $query = mysqli_query($con, "SELECT product.*, category.name AS 'category' FROM product JOIN category ON category.id = product.category_id WHERE product.category_id = $_GET[cat]");
    }
    else
    {
        $query = mysqli_query($con, "SELECT product.*, category.name AS 'category' FROM product JOIN category ON category.id = product.category_id");
    }
    $products = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $category_query = mysqli_query($con, "SELECT * FROM category");
    $categories = mysqli_fetch_all($category_query, MYSQLI_ASSOC);
?>
<table width="100%" border="2">
    <tr>
        <td colspan="3">
            <ul>
                <li>
                    <a href="./index.php">All Products</a>
                </li>
                <?php
                    foreach ($categories as $category) 
                    {?>
                    <li>
                        <a href="./index.php?cat=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                    </li>
                    <?php
                    }
                ?>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </td>
    </tr>

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
</table>