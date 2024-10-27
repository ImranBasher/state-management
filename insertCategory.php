<?php
    $conn = mysqli_connect("localhost", "root", "", "boq");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_POST['type'] == 'category') {
        $categoryName = $_POST['category_name'];
        $sql = "INSERT INTO tblboqcategory (CategoryName) VALUES ('$categoryName')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['status' => 'success', 'category_id' => mysqli_insert_id($conn)]);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
?>

