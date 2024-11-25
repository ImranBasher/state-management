<?php
    $conn = mysqli_connect("localhost", "root", "", "boq");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    include "ajax-load-project-data.php";

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $data['success'] = true;
        $data['loadedHTML'] = loadProjectData($conn);

        echo json_encode($data);
    }

