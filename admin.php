<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <div class="header">
        <h1>Admin Panel</h1>
    </div>

    <div class="col-md-3 col-6 py-3">
        <div class="card">
            <img id="productImage" src="images/shirt2.jpg" alt="Product Image" class="img-fluid pb-1">
            
            <div class="figure-caption">
                <h6>Product Name</h6>
                <input type="text" id="productName" class="form-control" placeholder="Name">

                <h6>Price</h6>
                <input type="text" id="productPrice" class="form-control" placeholder="Price">

                <h6>Add Image</h6>
                <input type="file" id="productImageUpload" class="form-control">

                <?php if (!isset($_SESSION['email'])) { ?>
                    <p>
                        <button id="addToShopBtn" class="btn btn-warning text-white">Add To Shop</button>
                    </p>
                <?php } else { 
                    if (check_if_added_to_cart(6)) { ?>
                        <p>
                            <a href="#" class="btn btn-warning text-white" disabled>Added to cart</a>
                        </p>
                    <?php } else { ?>
                        <p>
                            <a href="cart-add.php?id=6" name="add" value="add" class="btn btn-warning text-white">Add to cart</a>
                        </p>
                    <?php } 
                } ?>
            </div>
        </div>
    </div>

    <!-- JavaScript to Handle Add To Shop -->
    <script>
       document.getElementById('addToShopBtn').addEventListener('click', function () {
    const productName = document.getElementById('productName').value;
    const productPrice = document.getElementById('productPrice').value;
    const productImageUpload = document.getElementById('productImageUpload').files[0];

    // Validate inputs
    if (!productName || !productPrice || !productImageUpload) {
        alert('Please fill all fields and upload an image.');
        return;
    }

    // Create a FormData object to send data
    const formData = new FormData();
    formData.append('name', productName);
    formData.append('price', productPrice);
    formData.append('image', productImageUpload);

    // Log FormData for debugging
    console.log([...formData.entries()]);

    // Send data to the server using Fetch API
    fetch('add_product.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the card dynamically
            document.getElementById('productImage').src = URL.createObjectURL(productImageUpload);
            alert('Product added successfully!');
        } else {
            alert('Failed to add product: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the product.');
    });
});

    </script>

</body>
</html>