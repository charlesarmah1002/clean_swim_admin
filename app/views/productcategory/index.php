<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="css/product_category.css">

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
            <h3 style="font-weight: 300;">Product Category</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="add-btn"><a href="productcategory/create"><i class="ri-add-line"></i><span>New Category</span></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <div class="container">
                <?php
                foreach ($data as $category) : ?>
                    <div class="category" title="">
                        <i class="ri-arrow-down-s-fill"></i>
                        <p><?= $category['p_category'] ?> </p>
                        <div class="options">
                            <a href="productcategory/products?category_id=<?= $category['id'] ?>" class="view-btn">
                                <i class="ri-eye-line"></i>
                                <span>View</span>
                            </a>
                            <a href="productcategory/edit?category_id= <?= $category['id'] ?>" class="edit-btn">
                                <i class="ri-edit-box-line"></i>
                                <span>Edit</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <script>
                function deleteCat(id) {
                    let categoryId = id;

                    let xhr = new XMLHttpRequest();

                    xhr.open('GET', 'productcategory/delete?category_id=' + categoryId, true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);

                                const response = JSON.parse(xhr.responseText);

                                if (response.success == true) {
                                    location.reload();
                                } else {
                                    window.alert(response.message);
                                }
                            } else {
                                console.error('Request failed:', xhr.status);
                            }
                        }
                    };

                    xhr.send();
                }
            </script>
        </div>
    </main>
    <script src="/php_mvc_tutorial/public/js/menu.js"></script>
</body>

</html>