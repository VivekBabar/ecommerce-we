<?php
require("includes/common.php");
session_start();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO users_products(user_id, item_id, status) VALUES('$user_id', '$item_id', 'Added to cart')";
    mysqli_query($con, $query) or die(mysqli_error($con));
    header('location: products.php');
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        // Add the product to the cart (your existing logic here)
    
        // Redirect back to the products page with a success message
        header("Location: products.php?added=true");
        exit();
    }
}

?>