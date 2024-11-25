<?php
$conn = mysqli_connect("localhost", "root", "", "boq");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

include "ajax-load-data.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectId = $_POST['projectId'];
    $categoryId =  $_POST['categoryId'];

    // Insert a new subcategory into the tblboqsubcategory table
    $insertQuery = "INSERT INTO tblboqsubcategory (BoqCategoryID) VALUES ('$categoryId')";
//    print_r($insertQuery);
    if (mysqli_query($conn, $insertQuery)) {
        // Get the new subcategory ID
        $newSubcategoryID = mysqli_insert_id($conn);

        $loadDataAsHTML = loadData($conn,$projectId,$categoryId,$newSubcategoryID);

        $data["success"]          = true;
        $data["newSubcategoryID"] = $newSubcategoryID;
        $data["loadedHTML"]       = $loadDataAsHTML;

        // Return success response with the new subcategory ID
        echo json_encode($data);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>

