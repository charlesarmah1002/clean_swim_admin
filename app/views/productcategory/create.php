<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="../css/add_product_category.css">

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
            <h3 style="font-weight: 300;">Add Product Category</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <div class="form-container">
                <form action="" id="addCategoryForm">
                    <input type="text" name="p_category" id="p_category" placeholder="Category Name" required>
                    <button>Add</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function createCategory() {
            const form = document.getElementById('addCategoryForm'),
                button = form.querySelector('button');

                // button.onclick = (e) => {
                //     e.preventDefault();
                // }

            form.onsubmit = (e) => {
                e.preventDefault();

                // window.alert('this is from the form');

                let xhr = new XMLHttpRequest();

                xhr.open('POST', 'createCategory', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText); 

                            const response = JSON.parse(xhr.responseText);

                            if (response.success == true) {
                                location.href = '../productcategory';
                            } else {

                                console.log(response.message);
                                // Display error message
                                // errorText.innerHTML = response.message;
                            }
                        } else {
                            console.error('Request failed:', xhr.status);
                        }
                    }
                };

                let formData = new FormData(form);
                xhr.send(formData);
            };

            // form.onsubmit = (e) => {
            //     e.preventDefault();

            //     window.alert('this is the form');
            // }
        }

        createCategory();
    </script>
    <script src="/php_mvc_tutorial/public/js/menu.js"></script>
</body>


</html>