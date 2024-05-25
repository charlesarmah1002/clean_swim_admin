<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="css/sales.css">

    <!-- remix icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <input type="checkbox" id="menu-collapse" checked hidden>
    <nav class="sidebar">
        <a href="" class="logo">
            <img src="images/logo.png" alt="Clean Swim">
        </a>
        <ul class="menu">
            <li>
                <a href="home">
                    <i class="ri-dashboard-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="users">
                    <i class="ri-group-line"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="products">
                    <i class="ri-shopping-cart-line"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="productcategory">
                    <i class="ri-shopping-bag-3-line"></i>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="sales">
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
                <a href="auth/logout">
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
            <h3 style="font-weight: 300;">Sales</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="add-btn"><a href="sales/create"><i class="ri-add-line"></i><span>New Sale</span></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <div class="products-container">
                <input type="text" name="search" id="search" placeholder="Search">
                <div class="categories">
                    <?php foreach ($data['categories'] as $category) :?>
                        <a href="<?= $category['id'] ?>"> <?= $category['p_category'] ?> </a>
                    <?php endforeach; ?>
                </div>
                <div class="product-list">
                    <!-- <div class="product">
                        <div class="image-container">
                            <img src="664258db2f915.png" alt="">
                        </div>
                        <div class="info">
                            <p>Product name that might be too long to fit the space</p>
                            <p>GH¢ 12,000.00</p>
                            <button>Add to cart</button>
                        </div>
                    </div> -->
                    <?php foreach ($data['products'] as $product) :?>
                    <div class="product">
                        <div class="image-container">
                            <img src="uploads/products/<?= $product['p_image'] ?>" alt="">
                        </div>
                        <div class="info">
                            <p style="text-align: center;"><?= $product['p_name'] ?></p>
                            <p style="text-align: center;">GH¢ <?= $product['p_price'] ?></p>
                            <p style="text-align: center;"><?= $product['stock'] ?> Units Left</p>
                            <button onclick="addToCart(<?= $product['id'] ?>)" >Add to cart</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="summary">
                <input type="text" name="customer_name" id="customer_name" placeholder="Customer Name">
                <ol class="sale-list" id="saleList">
                    <li class="sale-item">
                        <div class="image-container">
                            <img src="664258db2f915.png" alt="">
                        </div>
                        <div class="info">
                            <p>2.0HP Swimming Pool Pump by Astral Pools add</p>
                            <p>¢12,000.00</p>
                            <div class="quantity">
                                <button class="subBtn"><i class="ri-subtract-line"></i></button>
                                <input type="text" id="quantity" name="quantity" value="0">
                                <button class="addBtn"><i class="ri-add-line"></i></button>
                            </div>
                        </div>
                    </li>
                </ol>
                <div class="total">
                    <p>Total:</p>
                    <h3 id="total">0.00</h3>
                </div>
                <button class="complete-btn">Complete Sale</button>
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
    <script>
        let saleItemList = document.getElementById('saleList'),
            saleItems = saleItemList.querySelectorAll('.sale-item');

        saleItems.forEach(item => {
            quantity = item.querySelector('input').value;

            addBtn = item.querySelector('.addBtn');
            subBtn = item.querySelector('.subBtn');

            addBtn.onclick = () => {
                quantity++;
                item.querySelector('input').value = quantity;
            }

            subBtn.onclick = () => {

                if (quantity <= 0) {
                    quantity = 0;
                } else {
                    quantity--;
                }

                item.querySelector('input').value = quantity;
            }
        });
    </script>
</body>

</html>

<script src="/php_mvc_tutorial/public/js/menu.js"></script>