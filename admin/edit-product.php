<?php
$title = 'Sửa sản phẩm';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Product.php';
require '../class/Category.php';
require '../class/Topic.php';
require '../class/Auth.php';

$error = Auth::requireLogin();

$id = $_GET["id"];

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$pdo = $db->getConn();

$product = Product::getOneByID($pdo, $id);

$categoryList = Category::getAll($pdo);
$topicList = Topic::getAll($pdo);

$priceErrors = '';

$name = $product->name;
$desc = $product->description;
$price = $product->price;
$image = '';
$isTrending = $product->trending;
$selectedTopic = $product->topic_id;
$selectedCategory = $product->category_id;

$categoryOptions = '';
foreach ($categoryList as $category) {
    $selected = ($category->id == $selectedCategory) ? 'selected' : '';
    $categoryOptions .= "<option value='{$category->id}' {$selected}>{$category->name}</option>";
}

$topicOptions = '';
foreach ($topicList as $topic) {
    $selected = ($topic->id == $selectedTopic) ? 'selected' : '';
    $topicOptions .= "<option value='{$topic->id}' {$selected}>{$topic->name}</option>";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $image = null;
    $isTrending = isset($_POST['isTrending']);
    $selectedTopic = $_POST['topic'];
    $selectedCategory = $_POST['category'];

    if ($price % 1000 != 0) {
        $priceErrors = 'Giá phải chia hết cho 1000';
    }

    try {
        // Xóa hình cũ nếu có
        if (!empty($_FILES['file'])) {
            // Kiểm tra xem sản phẩm hiện tại có ảnh hay không
            if (!empty($product->image)) {
                $oldImagePath = 'uploads/' . $product->image;

                // Xóa file ảnh cũ
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        if (empty($_FILES['file'])) {
            throw new Exception('Invalid upload');
        }

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
            default:
                throw new Exception('An error occurred');
        }

        if ($_FILES['file']['size'] > 1000000) {
            throw new Exception('File too large');
        }

        $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES['file']['tmp_name']);
        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }

        $pathinfo = pathinfo($_FILES['file']['name']);
        $fname = 'image';
        $extension = $pathinfo['extension'];

        $dest = 'uploads/' . $fname . '.' . $extension;
        $image = $fname . '.' . $extension;
        $i = 1;
        while (file_exists($dest)) {
            $dest = 'uploads/' . $fname . "-$i." . $extension;
            $image = $fname . "-$i." . $extension;
            $i++;
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
            // Thực hiện cập nhật thông tin sản phẩm
        } else {
            throw new Exception('Unable to move file.');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    // No errors???????
    if (!$priceErrors) {
        $product->id = $id;
        $product->name = $name;
        $product->description = $desc;
        $product->price = $price;
        $product->image = $image;
        $product->trending = $isTrending;
        $product->topic_id = $selectedTopic ?: null;
        $product->category_id = $selectedCategory ?: null;

        if ($product->update($pdo)) {
            header("Location: product.php?id={$product->id}");
            exit;
        }
    }
}
?>

<?php
require 'inc/header.php';
?>

<div class="content">
    <?php if ($error) : ?>
        <h1 style="text-align: center; margin-top: 30vh; transform: translateY(-50%); color: red"><?= $error . "sửa sản phẩm" ?></h1>
    <?php else : ?>
        <h2 style="text-align: center;">SỬA SẢN PHẨM</h2>
        <form method="post" class="w-50 m-auto" enctype='multipart/form-data'>
            <div class="mb-3">
                <label for="name">Tên sản phẩm:</label> <span class='text-danger fw-bold'>*</span>
                <input class="form-control" id="name" name="name" value="<?= $name ?>" required>
            </div>
            <div class="mb-3">
                <label for="desc">Mô tả:</label> <span class='text-danger fw-bold'>*</span>
                <textarea class="form-control" id="desc" name="desc" rows="4" required><?= $desc ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price">Giá:</label> <span class='text-danger fw-bold'>*</span>
                <input type="number" class="form-control" id="price" name="price" value="<?= $price ?>" required> <span class='text-danger fw-bold'><?= $priceErrors ?></span>
            </div>
            <div>
                <label for="file">File ảnh</label>
                <input type="file" name="file" />
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="isTrending" name="isTrending" <?= $isTrending ? 'checked' : '' ?>>
                <label class="form-check-label" for="isTrending">Nổi bật</label>
            </div>
            <div class="mb-3">
                <label for="topic">Chủ đề:</label>
                <select class="form-select" id="topic" name="topic">
                    <option value="">Chọn một chủ đề</option>
                    <?= $topicOptions ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="category">Thể loại:</label>
                <select class="form-select" id="category" name="category">
                    <option value="">Chọn một thể loại</option>
                    <?= $categoryOptions ?>
                </select>
            </div>
            <div class="d-flex">
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php'; ?>