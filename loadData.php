<?php

$conn = mysqli_connect("localhost", "root", "", "boq");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Make sure to include your database connection file

$sql = "SELECT * FROM tblboqcategory ORDER BY BoqCategoryID ASC";
$result = mysqli_query($conn, $sql);
$categories = [];

while ($category = mysqli_fetch_assoc($result)) {
    $subcategory_sql = "SELECT * FROM tblboqsubcategory WHERE BoqCategoryID = " . $category['BoqCategoryID'] ." ORDER BY BoqSubcategoryID ASC ";
    $subcategory_result = mysqli_query($conn, $subcategory_sql);
    $subcategories = [];

    while ($subcategory = mysqli_fetch_assoc($subcategory_result)) {
        $subcategories[] = $subcategory;
    }

    $categories[] = [
        'category' => $category,
        'subcategories' => $subcategories
    ];
}

echo json_encode($categories);
?>
