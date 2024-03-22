<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link rel="stylesheet" href="c.css">
    <link rel="stylesheet" href="update.css">
</head>

<body>
    <?php
    @include 'config1.php';

    if (isset($_GET['Ma_NV']) && !empty($_GET['Ma_NV'])) {
        $Ma_NV = $_GET['Ma_NV'];

        $sqlSelect = "SELECT * FROM nhanvien WHERE Ma_NV = '$Ma_NV'";
        $resultSelect = $conn->query($sqlSelect);

        if ($resultSelect->num_rows > 0) {
            $row = $resultSelect->fetch_assoc();
            $Ten_NV = $row['Ten_NV'];
            $Phai = $row['Phai'];
            $Noi_Sinh = $row['Noi_Sinh'];
            $Ma_Phong = $row['Ma_Phong'];
            $Luong = $row['Luong'];

            echo '<div class="update-form">';
            echo '<form action="process_update.php" method="POST" enctype="multipart/form-data">';
            echo '<input type="hidden" name="Ma_NV" value="' . $Ma_NV . '">';
            echo 'Tên nhân viên: <input type="text" name="Ten_NV" value="' . $Ten_NV . '"><br>';
            echo 'Hình ảnh hiện tại: <img src="' . $Phai . '" alt="' . $Ten_NV . '" width="100"><br>';
            echo 'Hình ảnh mới: <input type="file" name="Phai" id="Phai" onchange="previewImage(event)"><br>'; // Input để chọn hình ảnh mới
            echo '<div id="imagePreview"></div>'; // Div để hiển thị hình ảnh mới trước khi upload
            echo 'Nơi sinh: <input type="text" name="Noi_Sinh" value="' . $Noi_Sinh . '"><br>';
            echo 'Mã phòng: <input type="text" name="Ma_Phong" value="' . $Ma_Phong . '"><br>';
            echo 'Lương: <input type="text" name="Luong" value="' . $Luong . '"><br>';
            echo '<input type="submit" name="update_employee" value="Update">';
            echo '</form>';
            echo '</div>';
        } else {
            echo "Employee not found";
        }
    } else {
        echo "Invalid employee ID";
    }


    $conn->close();
    ?>

    
</body>

</html>
