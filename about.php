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
    <!-- <link rel="stylesheet" href="admin.css"> -->
</head>
<body>

    <div class="header">
        <h1>Admin Panel</h1>
    </div>

    <!-- Container to center the card -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-12 py-3">
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
<style>
    /* General Styles */
    body {
        background: rgb(133, 102, 102);
        color: white;
        text-align: center;
        padding: 2px;
        font-family: 'Andika', sans-serif;
    }

    .header h2 {
        margin-top: 0;
        font-family: 'Delius Swash Caps', cursive;
    }
    .header:hover{
        
    }

    /* Card Styles with Animation */
    .card {
        width: 100%;
        max-width: 500px;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        background: rgb(0, 0, 0);
        animation: fadeInUp 0.8s ease-out;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(216, 152, 152, 0.3);
    }

    /* Fade-in Animation for Card */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Button Styles with Animation */
    .btn-warning {
        background: #ffc107;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
        animation: pulse 2s infinite;
    }

    .btn-warning:hover {
        background: #d4958f;
        transform: scale(1.1);
        animation: none; /* Disable pulse animation on hover */
    }

    /* Pulse Animation for Button */
    @keyframes pulse {
        0% {
            transform: scale(1);
            background-color: #180707;
        }
        50% {
            transform: scale(1.05);
            background-color: #988c8c;
        }
        100% {
            transform: scale(1);
            background-color: #180707;
        }
    }

    /* Background Gradient Animation */
    body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .header {
        height: 100px;
        width: 100%;
        background-color: #180707;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        font-family: 'Andika', sans-serif;
    }

    /* Center the card */
    .container {
        height: calc(100vh - 100px); /* Subtract header height */
    }
</style>
</html>