<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="icon" type="image/x-icon" href="img/logo.ico">


    <title><?php echo $title; ?></title>

    <style>
        body {
            position: relative;
            min-height: 100vh;
            padding-top: 100px;
            padding-bottom: 400px;
        }

        footer {
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        ul li a {
            color: white;
            text-decoration: none;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .cart-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .cart-icon a {
            width: 50px;
            height: 50px;
        }

        .position-relative:hover .cart-icon {
            opacity: 1;
        }

        .page-link-red {
            color: #ffffff;
            background-color: #ff0000;
            border-color: #ff0000;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid" style="height: 80px; max-width: 1200px">
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" style="max-height: 100px;" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">TRANG CHỦ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            CHỦ ĐỀ
                        </a>
                        <?php
                        if (!empty($topics)) {
                            echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                            foreach ($topics as $topic) {
                                $topicId = $topic->id;
                                $topicName = $topic->name;
                                echo '<li><a class="dropdown-item" href="product-topic.php?topicid=' . $topicId . '">' . $topicName . '</a></li>';
                            }
                            echo '</ul>';
                        } else {
                            echo 'Không có chủ đề sản phẩm.';
                        }
                        ?>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            LOẠI HOA
                        </a>
                        <?php
                        if (!empty($categories)) {
                            echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                            foreach ($categories as $category) {
                                $categoryId = $category->id;
                                $categoryName = $category->name;
                                echo '<li><a class="dropdown-item" href="product-category.php?catid=' . $categoryId . '">' . $categoryName . '</a></li>';
                            }
                            echo '</ul>';
                        } else {
                            echo 'Không có loại hoa.';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="contact.php">LIÊN HỆ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="about.php">VỀ CHÚNG TÔI</a>
                    </li>

                </ul>
                <div class="ms-auto d-flex">
                    <div class="input-group">
                        <input type="text" id="search_query" class="form-control" placeholder="Tìm kiếm...">
                        <div class="input-group-prepend">
                            <button id="search_button" class="btn btn-link" type="button"><i class="fas fa-search" style="color: black"></i></button>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-link position-relative" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user" style="color: black;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="userDropdown">
                            <?php if (!isset($_SESSION['log_detail'])) : ?>
                                <li><a class="dropdown-item" href="register.php">Đăng ký</a></li>
                                <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
                            <?php else : ?>
                                <?php if (isset($_SESSION['userid'])) : ?>
                                    <li><a class="dropdown-item" href="profile.php?userid=<?= $_SESSION['userid'] ?>">Xem profile</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['role'] == 'admin') : ?>
                                    <li><a class="dropdown-item" href="admin/index.php">Trang Admin</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <a class="btn btn-link position-relative" href="cart.php">
                        <i class="fas fa-shopping-cart" style="color: black;"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= isset($totalQty) ? $totalQty : 0 ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>