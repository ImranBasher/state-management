<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "boq");
if (!$conn) {
echo json_encode(["success" => false, "message" => "Connection failed: " . mysqli_connect_error()]);
exit;
}

if (isset($_POST['BoqSubcategoryID'])) {
$BoqSubcategoryID = $_POST['BoqSubcategoryID'];
$BoqCategoryID = $_POST['BoqCategoryID'];
$sql = "DELETE FROM tblboqsubcategory WHERE BoqSubcategoryID = $BoqSubcategoryID and BoqCategoryID = '$BoqCategoryID'";

if (mysqli_query($conn, $sql)) {
echo json_encode(["success" => true, "message" => "Subcategory deleted successfully."]);
} else {
echo json_encode(["success" => false, "message" => "Error deleting subcategory: " . mysqli_error($conn)]);
}
} else {
echo json_encode(["success" => false, "message" => "BoqSubcategoryID not provided."]);
}

mysqli_close($conn);
?>