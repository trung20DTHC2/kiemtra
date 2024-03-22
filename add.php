<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./c.css">
    <link rel="stylesheet" href="add.css">
</head>

<body>
    <?php
    @include 'config1.php';
    if (isset($_POST['add_product'])) {

        $Ma_NV = $_POST['Ma_NV'];
        $Ten_NV = $_POST['Ten_NV'];
        $Phai = $_FILES['Phai']['name'];
        $Noi_Sinh = $_POST['Noi_Sinh'];
        $Ma_Phong = $_POST['Ma_Phong'];
        $Luong = $_POST['Luong'];
  
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Phai"]["name"]);
        if (move_uploaded_file($_FILES["Phai"]["tmp_name"], $target_file)) {

            $image_path = $target_dir . $Phai;
    
   
            $stmt = $conn->prepare("INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $Ma_NV, $Ten_NV, $image_path, $Noi_Sinh, $Ma_Phong, $Luong);
    
            if ($stmt->execute()) {
                echo "Dữ liệu đã được thêm vào cơ sở dữ liệu thành công!";
                $new_location = 'http://localhost:8080/LOGIN_CSDL/admin_page.php';
                header('Location: ' . $new_location);
                exit();
            } else {
                echo "Lỗi khi thêm dữ liệu: " . $stmt->error;
            }
    

            $stmt->close();
            $conn->close();
        } else {
            echo "Lỗi khi di chuyển file ảnh.";
        }
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="product-form">
            <div class="form-field">
                <label for="Ma_NV">ma :</label>
                <input type="text" name="Ma_NV" id="Ma_NV" required>
            </div>
            <div class="form-field">
                <label for="Ten_NV">ten :</label>
                <input type="text" name="Ten_NV" id="Ten_NV" required>
            </div>
            <div class="form-field">
                <label for="Phai">phai :</label>
                <input type="file" name="Phai" id="Phai" required>
                <img id="previewImage" src="#" alt="Preview" style="max-width: 200px; margin-top: 10px; display: none;">
            </div>
            <div class="form-field">
                <label for="Noi_Sinh">noi sinh : </label>
                <input type="text" name="Noi_Sinh" id="Noi_Sinh" required>
            </div>
            <div class="form-field">
                <label for="Ma_Phong">ma phong :</label>
                <input type="text" name="Ma_Phong" id="Ma_Phong" required>
            </div>
            <div class="form-field">
                <label for="Luong">luong :</label>
                <textarea name="Luong" id="Luong" required></textarea>
            </div>
            <div class="form-field">
                <button type="submit" name="add_product">Add Product</button>
            </div>
        </div>
    </form>

    

</body>

</html>
