<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Swim Admin Panel</title>

    <!-- css -->
    <link rel="stylesheet" href="css/users.css">

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
            <h3 style="font-weight: 300;">Users</h3>
            <ul class="actions">
                <li><a href="#"><i class="ri-search-line"></i></a></li>
                <li><a href="#"><i class="ri-notification-line"></i></a></li>
                <li class="add-btn"><a href="users/create"><i class="ri-add-line"></i><span>Add User</span></a></li>
                <li class="user-btn"><a href="#"><i class="ri-user-fill"></i></a></li>
            </ul>
        </div>
        <div id="content">
            <table>
                <thead>
                    <tr>
                        <th style="max-width: 70px;">Image</th>
                        <th style="text-align: center;">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th style="text-align: center;">Role</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <?php foreach ($data as $userInfo) : ?>
                    <tr>
                        <td style="max-width: 70px; overflow: hidden;">
                            <?php if ($userInfo['profile_image'] === null) : ?>
                                <img style="width: 50px; aspect-ratio: 1; overflow: hidden; margin-inline: auto; display: flex; align-items: center; justify-content: center; background: black; color: white; border-radius: 50%;" src="images/logo" alt="<?= $userInfo['fname'] . ' ' . $userInfo['lname'] ?>">
                            <?php else: ?>
                                <img style="width: 50px; aspect-ratio: 1; overflow: hidden; margin-inline: auto; display: flex; align-items: center; justify-content: center; background: black; color: white; border-radius: 50%;" src="uploads/user_images/<?= $userInfo['profile_image'] ?>" alt="<?= $userInfo['fname'] . ' ' . $userInfo['lname'] ?>">
                            <?php endif;?>
                        </td>
                        <td style="text-align: center;">#<?= $userInfo['user_id'] ?></td>
                        <td><?= $userInfo['fname'] . ' ' . $userInfo['lname'] ?></td>
                        <td><?= $userInfo['email'] ?></td>
                        <td style="text-align: center;"><?php 
                            if ($userInfo['role'] == true) {
                                echo 'admin';
                            }elseif ($userInfo['role'] == false) {
                                echo 'user';
                            }else{
                                echo 'inactive';
                            }
                        ?></td>
                        <td class="actions">
                            <a href="users/edit?user_id=<?= $userInfo['user_id'] ?>" class="edit-btn">
                                <i class="ri-edit-line"></i>
                                <span>Edit</span>
                            </a>
                            <a href="users/delete?user_id=<?= $userInfo['user_id'] ?>" class="delete-btn">
                                <i class="ri-delete-bin-line"></i>
                                <span>Delete</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
</body>

</html>

<script src="/php_mvc_tutorial/public/js/menu.js"></script>