<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "boq");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
include "ajax-load-data.php";
// Check if 'projectID' parameter is in the URL
if(isset($_GET['projectID'])) {
    $ProjectID = intval($_GET['projectID']); // Convert to integer for security
    $project_sql = "SELECT * FROM tblproject WHERE ProjectID = $ProjectID";
    $result = mysqli_query($conn, $project_sql);

    // Check if the query succeeded and if there are any results
    if ($result && mysqli_num_rows($result) > 0) {
        $project = mysqli_fetch_assoc($result);
        $data = [
            'success' => true,
            'ProjectID' => $project['ProjectID'],
            'ProjectName' => $project['ProjectName'],
            'BOQTitle' => $project['BOQTitle'],
            'DateInserted' => $project['DateInserted']
        ];

        // Call loadData function and capture its HTML output
        $loadHTML = loadData($conn, $ProjectID);
        $data['LoadHTML'] = $loadHTML;

        echo json_encode($data);
    } else {
        // Handle no results found
        $data = [
            'error' => true,
            'message' => 'No project found with the specified ID.'
        ];
        echo json_encode($data);
    }
} else {
    // Handle missing projectID parameter
    $data = [
        'error' => true,
        'message' => 'Project ID is required.'
    ];
    echo json_encode($data);
}

