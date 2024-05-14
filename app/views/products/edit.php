<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="../css/edit_products.css">

    <!-- remix icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- tiny mce -->
    <!-- <script src="https://cdn.tiny.cloud/1/2gb92cmuey7aj56lbxw66ksgxbg8md8itwthp9zutrc7u0ui/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> -->


    <script>
        tinymce.init({
            selector: '#p_description', // change this value according to your HTML
            menu: {
                file: {
                    title: 'File',
                    items: 'newdocument restoredraft | preview | importword exportpdf exportword | print | deleteallconversations'
                },
                edit: {
                    title: 'Edit',
                    items: 'undo redo | cut copy paste pastetext | selectall | searchreplace'
                },
                view: {
                    title: 'View',
                    items: 'code revisionhistory | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments'
                },
                insert: {
                    title: 'Insert',
                    items: 'image link media addcomment pageembed codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime'
                },
                format: {
                    title: 'Format',
                    items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat'
                },
                tools: {
                    title: 'Tools',
                    items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount'
                },
                table: {
                    title: 'Table',
                    items: 'inserttable | cell row column | advtablesort | tableprops deletetable'
                },
                help: {
                    title: 'Help',
                    items: 'help'
                }
            }
        });
    </script>
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
            <h3 style="font-weight: 300;">Edit Product</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <p class="errorText"></p>
            <div class="form-container">
                <form action="" id="updateImageForm">
                    <label for="p_image" class="p_image">
                        <img src="../uploads/<?= $data['product']['p_image'] ?>" alt="" id="p_image_preview" class="image">
                    </label>
                    <input type="number" name="id" id="id" accept="image/*" value="<?= $data['product']['id'] ?>" hidden>
                    <input type="file" name="p_image" id="p_image" accept="image/*" hidden>
                </form>
                <form action="" id="editProductForm">
                    <input type="number" name="id" id="id" accept="image/*" value="<?= $data['product']['id'] ?>" hidden>
                    <input type="file" name="p_image" id="p_image" accept="image/*" hidden>
                    <input type="text" name="p_name" id="p_name" placeholder="Enter Product Name" required value="<?= $data['product']['p_name'] ?>">
                    <input type="text" name="p_price" id="p_price" placeholder="Enter Price" required value="<?= $data['product']['p_price'] ?>">
                    <select name="c_id" id="c_id" required>
                        <option value="">--Select Category--</option>
                        <!-- i have to display all the categories and auto select the active category -->
                        <?php
                        foreach ($data['categories'] as $category) : ?>
                            <?php if ($category['id'] === $data['product']['c_id']) : ?>
                                <option value="<?= $category['id'] ?>" selected><?= $category['p_category'] ?></option>
                            <?php endif ?>
                            <option value="<?= $category['id'] ?>"><?= $category['p_category'] ?></option>
                        <?php endforeach   ?>
                    </select>
                    <textarea name="p_description" id="p_description" placeholder="Description">
                        <?= $data['product']['p_description'] ?>
                    </textarea>
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
        function updateProductInfo() {
            const form = document.getElementById('editProductForm'),
                button = form.querySelector('button');

            const errorText = document.querySelector('.errorText');

            form.onsubmit = (e) => {
                e.preventDefault();

                let xhr = new XMLHttpRequest();

                xhr.open('POST', 'updateProductInfo', true);
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

        updateProductInfo();
    </script>
    <script>
        function updateProductImage() {
            const form = document.getElementById('updateImageForm'),
                productImage = form.querySelector('#p_image');

            productImage.addEventListener('change', function() {
                console.log('something changed')
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "updateProductImage", true)

                xhr.onload = () => {

                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let data = xhr.response;

                            if (data === "success") {
                                location.reload();
                            } else {
                                window.alert(data);
                            }
                        }
                    }
                }

                xhr.onerror = () => {
                    window.alert("Request Failed")
                }

                let formData = new FormData(form);

                xhr.send(formData);
            })
        }

        updateProductImage();
    </script>
    <script src="/php_mvc_tutorial/public/js/menu.js"></script>
</body>


</html>