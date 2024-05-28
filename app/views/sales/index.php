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
                <!-- <div class="categories">
                </div> -->
                <div class="product-list" id="productList">
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
        function getProducts() {
            let xhr = new XMLHttpRequest();

            xhr.open('GET', 'products/getProducts', true);

            let searchParam = document.getElementById('search');

            if (searchParam.value == '') {

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {

                            const response = JSON.parse(xhr.responseText);

                            if (response.success == true) {
                                const productList = document.querySelector('.product-list');
                                const productsRecieved = document.createElement('div')

                                console.log(response.message);

                                if (response.products.length > 0) {
                                    for (let items = 0; items < response.products.length; items++) {
                                        const product = response.products[items];

                                        let productItem = document.createElement('div');
                                        productItem.classList.add('product');

                                        let imageContainer = document.createElement('div');
                                        imageContainer.classList.add('image-container');
                                        productItem.appendChild(imageContainer)

                                        let image = document.createElement('img');
                                        imageContainer.appendChild(image)
                                        image.src = `uploads/products/${product.p_image}`;

                                        let info = document.createElement('div');
                                        info.classList.add('info');

                                        let productName = document.createElement('p');
                                        productName.innerText = product.p_name;
                                        info.appendChild(productName);

                                        let price = document.createElement('p');

                                        let formatter = new Intl.NumberFormat('en-US');

                                        price.innerText = 'GH¢ ' + formatter.format(product.p_price);
                                        info.appendChild(price)

                                        let addBtn = document.createElement('button');
                                        addBtn.innerText = 'Add to cart';
                                        info.appendChild(addBtn)

                                        productItem.appendChild(info);

                                        productsRecieved.appendChild(productItem)
                                    }
                                }else {
                                    let message = document.createElement('p')
                                    message.innerText = 'No products to show'

                                    productsRecieved.innerHTML = message;
                                }

                                productList.innerHTML = productsRecieved.innerHTML
                            } else {

                                console.log(response.message);
                            }
                        } else {
                            console.error('Request failed:', xhr.status);
                        }
                    }
                };
            } else {
                let param = searchParam.value;

                xhr.open('GET', 'products/search?param=' + param, true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {

                            const response = JSON.parse(xhr.responseText);

                            if (response.success == true) {
                                const productList = document.querySelector('.product-list');
                                const productsRecieved = document.createElement('div')

                                for (let items = 0; items < response.products.length; items++) {
                                    const product = response.products[items];

                                    let productItem = document.createElement('div');
                                    productItem.classList.add('product');

                                    let imageContainer = document.createElement('div');
                                    imageContainer.classList.add('image-container');
                                    productItem.appendChild(imageContainer)

                                    let image = document.createElement('img');
                                    imageContainer.appendChild(image)
                                    image.src = `uploads/products/${product.p_image}`;

                                    let info = document.createElement('div');
                                    info.classList.add('info');

                                    let productName = document.createElement('p');
                                    productName.innerText = product.p_name;
                                    info.appendChild(productName);

                                    let price = document.createElement('p');

                                    let formatter = new Intl.NumberFormat('en-US');

                                    price.innerText = 'GH¢ ' + formatter.format(product.p_price);
                                    info.appendChild(price)

                                    let addBtn = document.createElement('button');
                                    addBtn.innerText = 'Add to cart';
                                    info.appendChild(addBtn)

                                    productItem.appendChild(info);

                                    productsRecieved.appendChild(productItem)
                                }

                                productList.innerHTML = productsRecieved.innerHTML

                                const itemZ = productList.querySelectorAll('.product');

                                itemZ.forEach(items => {
                                    items.onclick = () => {
                                        
                                    }
                                });
                            } else {

                                console.log(response.message);
                            }
                        } else {
                            console.error('Request failed:', xhr.status);
                        }
                    }
                };

            }

            xhr.send();
        }

        setInterval(() => {
            getProducts()
        }, 1000);
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

<script src="/clean_swim_admin/public/js/menu.js"></script>