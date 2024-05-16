<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="../css/products.css">

    <!-- remix icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <input type="checkbox" id="menu-collapse" checked hidden>
    <nav class="sidebar">
        <a href="" class="logo">
            <img src="../images/logo.png" alt="Clean Swim">
        </a>
        <ul class="menu">
            <li>
                <a href="../home">
                    <i class="ri-dashboard-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../users">
                    <i class="ri-group-line"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="../products">
                    <i class="ri-shopping-cart-line"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="../productcategory">
                    <i class="ri-shopping-bag-3-line"></i>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="../sales">
                    <i class="ri-wallet-2-line"></i>
                    <span>Sales</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="ri-chat-1-line"></i>
                    <span>Chats</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="ri-feedback-line"></i>
                    <span>Feedback</span>
                </a>
            </li>
        </ul>
        <ul class="buttons">
            <li>
                <a href="">
                    <i class="ri-logout-circle-line"></i>
                    <span>Sign out</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="ri-settings-2-line"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        <label for="menu-collapse"><i class="ri-arrow-left-s-fill"></i></label>
    </nav>
    <main>
        <div class="top-nav">
            <h3 style="font-weight: 300;">Products</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="add-btn"><a href="products/create"><i class="ri-add-line"></i><span>New Product</span></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <div class="container">
                <?php foreach ($data as $product) : ?>
                    <div class="product">
                        <div class="image-container">
                            <img src="../uploads/<?= $product['p_image'] ?>" alt="">
                        </div>
                        <div class="info">
                            <h3><?= $product['p_name'] ?></h3>
                            <p>GH¢ <?= number_format($product['p_price'], 2) ?></p>
                            <p>Avail. Quantity: <strong>120</strong></p>
                        </div>
                        <div class="actions">
                            <button class="delete-btn" onclick="deleteProduct(<?= $product['id'] ?>)">
                                <i class="ri-delete-bin-line"></i>
                                <span>Delete</span>
                            </button>
                            <a href="../products/edit?id=<?= $product['id'] ?>" class="edit-btn">
                                <i class="ri-edit-line"></i>
                                <span>Edit</span>
                            </a>
                            <a href="../products/product?product_id=<?= $product['id'] ?>" class="view-btn">
                                <i class="ri-eye-line"></i>
                                <span>View</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
    </main>
    <script>
         function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                console.log(true);
                let productId = id;

                let xhr = new XMLHttpRequest();

                xhr.open('GET', 'delete?product_id=' + productId, true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);

                            const response = JSON.parse(xhr.responseText);

                            if (response.success == true) {
                                location.href = '../products';

                                console.log(response)
                            } else {

                                console.log(response.message);
                            }
                        } else {
                            console.error('Request failed:', xhr.status);
                        }
                    }
                };

                xhr.send();
            }
        }
    </script>
</body>

</html>

<script src="/php_mvc_tutorial/public/js/menu.js"></script>