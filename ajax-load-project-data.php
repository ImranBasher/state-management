
<?php
    function loadProjectData($conn) {
    $sql = "SELECT * FROM tblproject";
    $result = mysqli_query($conn, $sql);
    $projectTbleBody = "";

    while ($project = mysqli_fetch_assoc($result)) {
    $projectTbleBody .= "
    <tr>
        <td>{$project['ProjectName']}</td>
        <td>{$project['BOQTitle']}</td>
        <td>{$project['DateInserted']}</td>
        <td>
            <a href='editProject.php?projectID={$project['ProjectID']}' id = 'edit'  class='btn btn-warning'>Edit</a>
            <a href='#' data-project_id={$project['ProjectID']} id = 'copy' class='btn btn-info copyProject'>Copy</a>
            <a href='#' data-project_id={$project['ProjectID']} id ='delete' class='btn btn-info deleteProject'>Delete</a>
            
        </td>
    </tr>
    ";
    }
    return $projectTbleBody;
    }

//            <a href='deleteProject.php?projectID={$project['ProjectID']}' data-project_id={$project['ProjectID']} class='btn btn-info deleteProject'>Delete</a>
