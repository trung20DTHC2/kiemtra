<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>


</head>

<body>

   <div class="container">

      <div class="content">
         <h3>hi, <span>user</span></h3>
         <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
         <p>this is an user page</p>
         <a href="login_form.php" class="btn">login</a>
         <a href="register_form.php" class="btn">register</a>
         <a href="logout.php" class="btn">logout</a>
      </div>

   </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="c.css">
</head>

<body>
   <?php
   @include 'config1.php';
   $sql = "SELECT * FROM nhanvien";
   $result = $conn->query($sql);

   echo '<div class="nhanvien-table">';
   echo '<table>';
   echo '<thead>';
   echo '<tr>';
   echo '<th>MA_NV</th>';
   echo '<th>Tennv</th>';
   echo '<th>Image</th>';
   echo '<th>noi_sinh</th>';
   echo '<th>maphong</th>';
   echo '<th>luong</th>';
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';

   while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["Ma_NV"] . "</td>";
      echo "<td>" . $row["Ten_NV"] . "</td>";
      echo "<td>" . $row["Noi_Sinh"] . "</td>";
      echo "<td>" . $row["Ma_Phong"] . "</td>";
      echo "<td>" . $row["Luong"] . "</td>";
      echo "</tr>";
   }
   echo '</tbody>';
   echo '</table>';
   echo '</div>';

   // Đóng kết nối
   $conn->close();
   ?>

</body>

</html>