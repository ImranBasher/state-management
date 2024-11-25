<?php
    $conn = mysqli_connect("localhost", "root", "", "boq");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    include "ajax-load-data.php";




    if ($_POST['type'] == 'category') {
      //  $categoryName = "Cat ".random_int(11,99); //$_POST['category_name'];
        $projectId = $_POST['ProjectID'];

        // $categoryName = "Your Random value";

        $sql = "INSERT INTO tblboqcategory (ProjectID) VALUES ('$projectId')";

        if (mysqli_query($conn, $sql)) {
            $insertedCategoryId = mysqli_insert_id($conn);
           // print_r($insertedCategoryId);
            //echo json_encode(['status' => 'success', 'category_id' => mysqli_insert_id($conn)]);
           // $loadDataAsHTML = loadData($conn, $projectId, $insertedCategoryId);
            $data["success"]        = true;
            $data["projectId"]      = $projectId;
            $data["category_id"]    = $insertedCategoryId;
          //  $data["loadedHTML"]   = $loadDataAsHTML;
            echo json_encode($data);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    /*Category Update */
    if ($_POST['type'] == 'category_update') {

        $categoryName  = $_POST['CategoryName'];
        $BoqCategoryId = $_POST['BoqCategoryID'];

        // $categoryName = "Your Random value";

        $sql = "UPDATE tblboqcategory SET CategoryName = '$categoryName' WHERE BoqCategoryId = $BoqCategoryId";
        if (mysqli_query($conn, $sql)) {
            $data['message1'] = "Category updated successfully.";

            $category_sql = "SELECT CategoryName FROM tblboqcategory WHERE BoqCategoryID = " . $BoqCategoryId;
            $result = mysqli_query($conn, $category_sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $data['message2'] = "Category fetch successfully.";
                $data["success"] = true;
                $data["CategoryName"] = $row["CategoryName"];
                echo json_encode($data);
            } else {
                $data["success"] = false;
                $data["message"] = "No category found.";
                echo json_encode($data);
            }
            echo json_encode($data);

        } else {
            echo json_encode(['status' => 'error']);
        }
    }
?>

