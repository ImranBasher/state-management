<?php
    $conn = mysqli_connect("localhost", "root", "", "boq");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    include "ajax-load-data.php";

    $projectValue = $_POST['projectValue'] ?? null; // Ensure this is not null
    $columnName = $_POST['columnName'] ?? null; // Ensure this is not null
    $projectId = $_POST['projectId'] ?? null; // Default to null if not set

    $sql = '';

    $ProjectId = null;
    if (isset($projectId) &&  $projectId != null) {
        $sql = "UPDATE tblproject SET $columnName = '$projectValue' WHERE ProjectID = '$projectId'";
        $result = mysqli_query($conn, $sql);
        $ProjectId = $projectId;
    } else {
        $sql = "INSERT INTO tblproject ($columnName) VALUES ('$projectValue')";
        $result = mysqli_query($conn, $sql);
        $ProjectId = mysqli_insert_id($conn);
    }

    if ($ProjectId) {
        $sql = "SELECT * FROM tblproject WHERE ProjectID = '$ProjectId'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            $project = mysqli_fetch_assoc($result);
           // $loadDataAsHTML = loadData($conn, $ProjectId);

            $data = [
                "success" => true,
                "projectId" => $ProjectId,
                "projectName" => $project["ProjectName"] ?? null, // Use null coalescing to avoid warnings
                "BOQTitle" => $project["BOQTitle"] ?? null, // Use null coalescing to avoid warnings
                "DateInserted" => $project["DateInserted"] ?? null, // Use null coalescing to avoid warnings
               // "loadedHTML" => $loadDataAsHTML,
            ];
        } else {
            $data = [
                "success" => false,
                "message" => "No project found after insertion/update.",
            ];
        }
    } else {
        $data = ['status' => 'error', 'message' => 'Database query failed: ' . mysqli_error($conn)];
    }
    echo json_encode($data);
?>
