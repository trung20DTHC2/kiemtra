<?php
@include 'config1.php';

if (isset($_POST['update_employee'])) {
    $Ma_NV = $_POST['Ma_NV'];
    $Ten_NV = $_POST['Ten_NV'];
    $Noi_Sinh = $_POST['Noi_Sinh'];
    $Ma_Phong = $_POST['Ma_Phong'];
    $Luong = $_POST['Luong'];


    if ($_FILES['Phai']['name'] != '') {
        $Phai = $_FILES['Phai']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Phai"]["name"]);
        

        if (move_uploaded_file($_FILES["Phai"]["tmp_name"], $target_file)) {
            $image_path = $target_dir . $Phai;
        } else {
            echo "Lỗi khi upload file ảnh.";
            exit();
        }
    }

    $sqlUpdate = "UPDATE nhanvien SET Ten_NV=?, Phai=?, Noi_Sinh=?, Ma_Phong=?, Luong=? WHERE Ma_NV=?";
    $stmt = $conn->prepare($sqlUpdate);

    if ($_FILES['Phai']['name'] != '') {
        $stmt->bind_param("ssssss", $Ten_NV, $image_path, $Noi_Sinh, $Ma_Phong, $Luong, $Ma_NV);
    } else {
        $stmt->bind_param("sssss", $Ten_NV, $Phai, $Noi_Sinh, $Ma_Phong, $Luong, $Ma_NV);
    }

    if ($stmt->execute()) {
        echo "Thông tin nhân viên đã được cập nhật thành công!";
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin nhân viên: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
