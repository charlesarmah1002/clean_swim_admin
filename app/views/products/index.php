<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="css/products.css">

    <!-- remix icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- tinymce cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js" integrity="sha512-bAtLCmEwg+N9nr6iVELr/SlDxBlyoF0iVdPxAvcOCfUiyi6RcuS6Lzawi78iPbAfbNyIUftvwK9HPWd+3p975Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            <h3 style="font-weight: 300;">Products</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="add-btn"><a href="javascript: activateForm('create')"><i class="ri-add-line"></i><span>New Product</span></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <div class="products-container">
                <input type="text" name="search" id="search" placeholder="Search">
                <div class="product-list" id="productList">
                </div>
            </div>
        </div>
        <div class="popUp createPopUp">
            <div class="form-container">
                <label for="p_image" class="p_image">
                    <img src="images/image.png" alt="" id="p_image_preview" class="image">
                </label>
                <form action="" id="addProductForm">
                    <input type="file" name="p_image" id="p_image" accept="image/*" hidden>
                    <input type="text" name="p_name" id="p_name" placeholder="Enter Product Name" required>
                    <input type="text" name="p_price" id="p_price" placeholder="Enter Price" required>
                    <input type="number" name="stock" id="stock" value="0" min="0" required>
                    <select name="c_id" id="c_id"></select>
                    <textarea name="p_description" id="p_description"></textarea>
                    <button>Add</button>
                    <script>
                        async function getCategories() {
                            try {
                                let response = await fetch('productcategory/list');

                                if (!response.ok) {
                                    throw new Error(`Request failed with status ${response.status}`);
                                }

                                let data = await response.json();

                                if (data.success === true) {
                                    const form = document.getElementById('addProductForm');
                                    const categoryList = document.getElementById('c_id');
                                    const selectCategory = document.createElement('select');
                                    selectCategory.name = 'c_id'
                                    selectCategory.id = 'c_id'

                                    const initial = document.createElement('option');
                                    initial.value = null;
                                    initial.innerText = `--Select Category--`;
                                    selectCategory.appendChild(initial);

                                    if (data.categories.length > 0) {
                                        data.categories.forEach(category => {
                                            let categoryItem = document.createElement('option');
                                            categoryItem.value = category.id;
                                            categoryItem.innerText = category.p_category;

                                            selectCategory.appendChild(categoryItem)
                                        });

                                        form.replaceChild(selectCategory, categoryList);
                                    } else {
                                        console.log('No categories found');
                                    }
                                } else {
                                    console.error('Response success is false:', data);
                                }
                            } catch (error) {
                                console.error('Error:', error);
                            }
                        }

                        document.addEventListener('DOMContentLoaded', getCategories());
                    </script>
                </form>
            </div>
            <div class="popUp viewPopUp">
                <div class="image-container">
                    <img src="" alt="">
                    <h3></h3>
                    <p></p>
                    <p><strong></strong> Units remaining</p>
                </div>
                <div class="data">

                </div>
            </div>
        </div>
    </main>
    <script>
        function createProduct() {
            const form = document.getElementById('addProductForm'),
                button = form.querySelector('button');

            const errorText = document.querySelector('.errorText');

            form.onsubmit = (e) => {
                e.preventDefault();

                let xhr = new XMLHttpRequest();

                xhr.open('POST', 'products/createProduct', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);

                            const response = JSON.parse(xhr.responseText);

                            if (response.success == true) {
                                location.href = '../products'
                            } else {
                                errorText.innerHTML = response.message;
                            }
                        } else {
                            console.error('Request failed:', xhr.status);
                        }
                    }
                };

                let formData = new FormData(form);
                xhr.send(formData);
            };
        }

        createProduct();

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
                                        const productItem = document.createElement('div');
                                        productItem.classList.add('product');

                                        const imageContainer = document.createElement('div');
                                        imageContainer.classList.add('image-container');
                                        productItem.appendChild(imageContainer)

                                        const image = document.createElement('img');
                                        imageContainer.appendChild(image)
                                        image.src = `uploads/products/${product.p_image}`;

                                        const info = document.createElement('div');
                                        info.classList.add('info');

                                        const productName = document.createElement('p');
                                        productName.innerText = product.p_name;
                                        info.appendChild(productName);

                                        const price = document.createElement('p');

                                        const formatter = new Intl.NumberFormat('en-US');

                                        price.innerText = 'GH¢ ' + formatter.format(product.p_price);
                                        info.appendChild(price)

                                        const options = document.createElement('div')
                                        options.classList.add('options')
                                        info.appendChild(options)

                                        const editBtn = document.createElement('a');
                                        editBtn.innerText = 'Edit'
                                        editBtn.classList.add('edit-btn')
                                        editBtn.href = 'javascript: alert()'
                                        options.appendChild(editBtn)

                                        const delBtn = document.createElement('a');
                                        delBtn.innerText = 'Delete'
                                        delBtn.classList.add('delete-btn')
                                        delBtn.href = `javascript: deleteProduct(${product.id})`
                                        options.appendChild(delBtn)

                                        const viewBtn = document.createElement('a');
                                        viewBtn.innerText = 'View'
                                        viewBtn.classList.add('view-btn')
                                        viewBtn.href = `javascript: activateForm('view')`
                                        options.appendChild(viewBtn)

                                        productItem.appendChild(info);

                                        productsRecieved.appendChild(productItem)
                                    }
                                } else {
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

                                    const productItem = document.createElement('div');
                                    productItem.classList.add('product');

                                    const imageContainer = document.createElement('div');
                                    imageContainer.classList.add('image-container');
                                    productItem.appendChild(imageContainer)

                                    const image = document.createElement('img');
                                    imageContainer.appendChild(image)
                                    image.src = `uploads/products/${product.p_image}`;

                                    const info = document.createElement('div');
                                    info.classList.add('info');

                                    const productName = document.createElement('p');
                                    productName.innerText = product.p_name;
                                    info.appendChild(productName);

                                    const price = document.createElement('p');

                                    const formatter = new Intl.NumberFormat('en-US');

                                    price.innerText = 'GH¢ ' + formatter.format(product.p_price);
                                    info.appendChild(price)

                                    const options = document.createElement('div')
                                    options.classList.add('options')
                                    info.appendChild(options)

                                    const editBtn = document.createElement('a');
                                    editBtn.innerText = 'Edit'
                                    editBtn.classList.add('edit-btn')
                                    editBtn.href = 'javascript: alert()'
                                    options.appendChild(editBtn)

                                    const delBtn = document.createElement('a');
                                    delBtn.innerText = 'Delete'
                                    delBtn.classList.add('delete-btn')
                                    delBtn.href = 'javascript: alert()'
                                    options.appendChild(delBtn)

                                    const viewBtn = document.createElement('a');
                                    viewBtn.innerText = 'View'
                                    viewBtn.classList.add('view-btn')
                                    viewBtn.href = 'javascript: activateForm("view")'
                                    options.appendChild(viewBtn)

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

        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                console.log(true);
                let productId = id;

                let xhr = new XMLHttpRequest();

                xhr.open('GET', 'products/delete?product_id=' + productId, true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);

                            if (response.success == true) {
                                window.alert(response.message)
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
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
</body>

</html>

<script src="/clean_swim_admin/public/js/script.js"></script>