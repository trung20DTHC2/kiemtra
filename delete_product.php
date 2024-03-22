<?php
include 'config1.php';


if (isset($_GET['Ma_NV']) && !empty($_GET['Ma_NV'])) {
    $Ma_NV = $_GET['Ma_NV'];


    $sqlDelete = "DELETE FROM nhanvien WHERE Ma_NV = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("s", $Ma_NV);

    if ($stmt->execute()) {
        echo "Product deleted successfully";
        

        header("Location: admin_page.php");
        exit();
    } else {
        die("Error deleting product: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Product ID not specified";
}
?>
