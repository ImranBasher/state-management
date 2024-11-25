<?php
    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost", "root", "", "boq");

    if (!$conn) {
        echo json_encode(["success" => false, "message" => "Connection failed: " . mysqli_connect_error()]);
        exit;
    }
    include "ajax-load-data.php";

    if (isset($_POST['BoqSubcategoryID'])) {
        $ProjectId = $_POST['ProjectID'];
        $BoqSubcategoryID = $_POST['BoqSubcategoryID'];
        $BoqCategoryID = $_POST['BoqCategoryID'];

//        print_r($_POST);

        $sql = "DELETE FROM tblboqsubcategory WHERE BoqSubcategoryID = $BoqSubcategoryID and BoqCategoryID = $BoqCategoryID";

        if (mysqli_query($conn, $sql)) {

            $loadDataAsHTML = loadData($conn,$ProjectId,$BoqCategoryID);
            $data["success"] = true;
            $data["loadedHTML"] = $loadDataAsHTML;
            echo json_encode($data);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
        }
    }
    mysqli_close($conn);
?>
