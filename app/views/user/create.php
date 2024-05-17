<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="../css/create_user.css">

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
                <form action="" id="createUserForm" autocomplete="false">
                    <input type="file" name="p_image" id="p_image" accept="image/*" hidden>
                        <input type="text" name="fname" id="fname" placeholder="First Name" required>
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                        <input type="text" name="country-code" id="country-code" placeholder="eg +233" value="+" required>
                        <input type="tel" name="phone" id="phone" placeholder="Phone Number" required>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                        <input type="text" name="address_line_1" id="address_line_1" placeholder="Address Line 1" required>
                        <input type="text" name="address_line_2" id="address_line_2" placeholder="Address Line 2" required>
                        <button>Create User Account</button>
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
        function createCategory() {
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

        createCategory();
    </script>
    <script src="/php_mvc_tutorial/public/js/menu.js"></script>
</body>


</html>