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
            <h3 style="font-weight: 300;">Create New User Profile</h3>
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
                    <label for="profile_image" class="profile_image">
                        <img src="../uploads/user_images/<?= $data['profile_image'] ?>" alt="<?= $data['fname'] . ' ' . $data['lname'] ?>" id="p_image_preview" class="image">
                    </label>
                    <input type="number" name="user_id" id="user_id" value="<?= $data['id'] ?>" hidden>
                    <input type="file" name="profile_image" id="profile_image" accept="image/*" hidden>
                </form>
                <form action="" id="editUserForm" autocomplete="off">
                    <input type="file" name="profile_image" id="profile_image" accept="image/*" hidden>
                    <input type="text" name="user_id" id="user_id" value="<?= $data['id'] ?>" hidden>
                    <input type="text" autocomplete="off" name="fname" id="fname" placeholder="First Name" value="<?= $data['fname'] ?>" required>
                    <input type="text" autocomplete="off" name="lname" id="lname" placeholder="Last Name" value="<?= $data['lname'] ?>" required>
                    <input type="email" name="email" autocomplete="off" id="email" placeholder="Email" value="<?= $data['email'] ?>" required>
                    <input type="text" name="country-code" id="country-code" placeholder="eg +233" value="<?= $data['country_code'] ?>" required>
                    <input type="tel" name="phone" autocomplete="off" id="phone" placeholder="Phone Number" value="<?= $data['phone'] ?>" required>
                    <?php if ($_SESSION['role'] == true) : ?>
                        <select name="user_role" id="user_role">
                            <option value="null">--Select User Role--</option>
                            <option value="1" <?php if ($data['role'] == true) {
                                                    echo 'selected';
                                                } ?>>Admin</option>
                            <option value="0" <?php if ($data['role'] == false) {
                                                    echo 'selected';
                                                } ?>>User</option>
                        </select>
                    <?php endif; ?>
                    <button>Update User Profile</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        const form = document.querySelector('form'),
            imageInput = form.querySelector('#profile_image');
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
        function editUserProfile() {
            const form = document.getElementById('editUserForm'),
                button = form.querySelector('button');

            const errorText = document.querySelector('.errorText');

            form.onsubmit = (e) => {
                e.preventDefault();

                let xhr = new XMLHttpRequest();

                xhr.open('POST', 'editUserProfile', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);

                            const response = JSON.parse(xhr.responseText);

                            if (response.success == true) {
                                location.href = '../users'
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

        editUserProfile();
    </script>

    <script>
        function updateUserProfileImage() {
            const form = document.getElementById('updateImageForm'),
                userProfileImage = form.querySelector('#profile_image');

            userProfileImage.addEventListener('change', function() {
                console.log('something changed')
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "updateUserProfileImage", true)

                xhr.onload = () => {

                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let data = xhr.response;

                            if (data === "success") {
                                // location.href =  ;
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

        updateUserProfileImage();
    </script>
    <script src="/php_mvc_tutorial/public/js/menu.js"></script>
</body>


</html>