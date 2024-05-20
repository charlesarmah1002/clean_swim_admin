<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="../css/add_product.css">

    <!-- remix icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- froala css -->
    <link href="/php_mvc_tutorial/public/node_modules/froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
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
                <a href="../chats">
                    <i class="ri-chat-1-line"></i>
                    <span>Chats</span>
                </a>
            </li>
            <li>
                <a href="../feedback">
                    <i class="ri-feedback-line"></i>
                    <span>Feedback</span>
                </a>
            </li>
        </ul>
        <ul class="buttons">
            <li>
                <a href="../auth/logout">
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
            <h3 style="font-weight: 300;">Add Product</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <p class="errorText"></p>
            <div class="form-container">
                <label for="p_image" class="p_image">
                    <img src="../images/image.png" alt="" id="p_image_preview" class="image">
                </label>
                <form action="" id="addProductForm">
                    <input type="file" name="p_image" id="p_image" accept="image/*" hidden>
                    <input type="text" name="p_name" id="p_name" placeholder="Enter Product Name" required>
                    <input type="text" name="p_price" id="p_price" placeholder="Enter Price" required>
                    <input type="number" name="stock" id="stock" value="0" min="0" required>
                    <select name="c_id" id="c_id" required>
                        <option value="">--Select Category--</option>
                        <?php foreach ($data as $category) : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['p_category'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <textarea name="p_description" id="p_description" placeholder="Description"></textarea>
                    <button>Add</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        const form = document.querySelector('form'),
            imageInput = form.querySelector('#p_image');
        imageTarget = document.querySelector('#p_image_preview');

        imageInput.addEventListener('change', (event) => {
            let image = event.target.files[event.target.files.length - 1]

            let reader = new FileReader();

            reader.onload = (e) => {
                let iamgeUrl = e.target.result;

                imageTarget.src = iamgeUrl;
            }

            reader.readAsDataURL(image);
        })
    </script>
    <script>
        function createProduct() {
            const form = document.getElementById('addProductForm'),
                button = form.querySelector('button');

            const errorText = document.querySelector('.errorText');

            form.onsubmit = (e) => {
                e.preventDefault();

                let xhr = new XMLHttpRequest();

                xhr.open('POST', 'createProduct', true);
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
    </script>
    <script type="text/javascript" src="/php_mvc_tutorial/public/node_modules/froala-editor/js/froala_editor.pkgd.min.js"></script>
    <script>
        var editor = new FroalaEditor('textarea', {
            documentReady: true
        });
    </script>
    <script src="/php_mvc_tutorial/public/js/menu.js"></script>
</body>


</html>