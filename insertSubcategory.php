<?php
$conn = mysqli_connect("localhost", "root", "", "boq");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['categoryId'];

    // Insert a new subcategory into the tblboqsubcategory table
    $insertQuery = "INSERT INTO tblboqsubcategory (BoqCategoryID) VALUES ('$categoryId')";

    if (mysqli_query($conn, $insertQuery)) {
        // Get the new subcategory ID
        $newSubcategoryID = mysqli_insert_id($conn);

        // Return success response with the new subcategory ID
        echo json_encode(['success' => true, 'newSubcategoryID' => $newSubcategoryID]);
    } else {
        // Return error response
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>

