

<?php
$conn = mysqli_connect("localhost", "root", "", "boq");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            max-width: 1500px;
            margin: auto;
            padding: 20px;
        }

        /* Make the table scrollable on smaller screens */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        /* Apply styling to table headers */
        thead tr td {
            background-color: #17C664 !important;
            color: black;
            text-align: center;
            font-weight: bold;
        }

        /* Responsive adjustments for table elements */
        .table td, .table th {
            padding: 8px;
            white-space: nowrap;
        }
        .material-icons { cursor: pointer; color:#17C664; }
        .total-cost {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }


        @media (max-width: 768px) {
            .card-head .col-md-4 {
                font-size: 14px;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .card-head .col-md-4 input {
                width: 100%;
            }
        }

        /* For screens with max-width: 576px */
        @media (max-width: 576px) {
            .form-group {
                display: flex;
                align-items: center;  /* Vertically center the label and input */
                margin-bottom: 15px; /* Add some margin between fields */
            }

            .form-group label {
                margin-bottom: 0;  /* Remove default margin from the bottom */
                margin-right: 10px;  /* Space between label and input */
                width: 30%;  /* Make the label take up 30% of the container */
                font-weight: bold;  /* Make label bold */
            }

            .form-group input {
                width: 65%;  /* Make the input field take up the remaining 65% of the container */
                padding: 8px;  /* Add padding for the input */
            }

            /* Adjusting padding for smaller screens */
            .col-12 {
                padding-left: 0;
                padding-right: 0;
            }
        }

        /* For larger screens, ensure proper spacing and alignment */
        @media (min-width: 576px) {
            .form-group {
                display: flex;
                justify-content: space-between;  /* Distribute space evenly between label and input */
                align-items: center;
                margin-bottom: 15px;
            }

            .form-group label {
                width: 25%;  /* Label takes up 25% of the container */
                font-weight: bold;
            }

            .form-group input {
                width: 70%;  /* Input takes up 70% of the container */
            }
        }
        @media (max-width: 767px) {
            .card-head {
                text-align: center;
            }
            .form-group {
                padding-left: 0 !important;
            }
            .table th, .table td {
                font-size: 12px;
            }
            .material-icons {
                font-size: 18px;
            }
        }

        @media (max-width: 576px) {
            hr{
                width: 93.2%;
                margin-left: 12px;
            }
        }
    </style>
    <title>BOQ Table</title>
</head>
<body>
<div class="container">
    <div class="card mb-3">
        <div class="card-head row responsive">
            <div  class="text-center">
                <h3 style='margin: auto; background-color: #037837; margin-bottom: -2px; color:white;' >Project, Construction Of Residential Building</h3>
                <h3 style='margin: auto; background-color: #037837; margin-bottom: -2px; color:white;'>Quantity and Cost Estimate</h3>

<!--                <hr style="margin: auto; color: inherit; border-top: var(--bs-border-width) solid; position: relative; left: -24px;">-->
            </div>
            <hr style="margin: 20px;  margin-bottom: 20px; width: 98.2%;  margin-left: 12px; ">
            <div class="col-12 col-md-4 d-flex align-items-center mb-3 margin:auto form-group" style="padding-left: 2rem; font-weight:bold">
                <label class="me-2">Project </label>
                <input type="text"
                       class="form-control projectInput ProjectName"
                       data-project_id=''
                       data-columnName="ProjectName"
                       placeholder="Project Name"
                       value=''
                       style="border: 2px solid  #90A4AE"
                />
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center mb-3 form-group" style="padding-left: 2rem; font-weight:bold">
                <label class="me-2">BOQ </label>
                <input type="text"
                       class="form-control projectInput BOQTitle"
                       data-project_id=''
                       data-columnName="BOQTitle"
                       placeholder="BOQ Title"
                       value=''
                       style="border: 2px solid #90A4AE"
                />
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center mb-3 form-group" style="padding-left: 2rem; font-weight:bold">
                <label class="me-2">Date </label>
                <input type="date"
                       class="form-control projectInput DateInserted"
                       data-project_id=''
                       data-columnName="DateInserted"
                       placeholder="Date"
                       value=''
                       style="border: 2px solid #90A4AE"
                />
            </div>

        </div>


        <div class="card-body table-responsive">
            <table class="table table-bordered " style="width: 100%">
                <thead style="background-color: green">
                <tr>
                    <td scope="col">SL</td>
                    <td scope="col" style="padding: 10px 150px; text-align: center;" >Description </td>
                    <td scope="col" style="padding: 10px 60px; text-align: center;" >Unit</td>
                    <td scope="col" style="padding: 10px 60px; text-align: center;" >Quantity</td>
                    <td scope="col" style="padding: 10px 60px; text-align: center;" >Rate</td>
                    <td scope="col" style="padding: 10px 60px; text-align: center;" >Cost</td>
                    <td style="border-radius:5px; border: none; font-weight: normal; background-color: #17C664 !important;"><button style='background-color: #17C664; color:white; border:none' type="button" class="material-icons addNewCategory" value="" >add_circle</button></td>
                </tr>
                </thead>
                <tbody id="tableBody">
                <!--        code goes here-->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="jsfile.js"></script>
<script>
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const projectID = urlParams.get('projectID'); // Adjust 'projectId' to match your query parameter name

        loadExistingData(projectID);

    function loadExistingData(projectID) {
        // scrollPosition = window.scrollY;
        $.ajax({
            type: "GET",
            url: "editloadData.php", // Fetch existing categories and subcategories from the database
            data: {
                projectID:projectID
            },
            dataType:"JSON",
            success: function (response) {
                const formattedDate = response.DateInserted.split(" ")[0];
                $(".ProjectName").val(response.ProjectName);
                $(".BOQTitle").val(response.BOQTitle);
                $(".DateInserted").val(formattedDate);
                $(".addNewCategory").attr('value', response.ProjectID);
                $("#tableBody").html(response.LoadHTML);
                $(".projectInput").attr('data-project_id', response.ProjectID);
                //updateGrandTotal(projectID);
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    }
        function updateGrandTotal(productId) {
            let productID = productId;
            $.ajax({
                type: "POST",
                url: "grandTotal.php",
                data: {
                    projectId : productID,
                },
                dataType:"JSON",

                success: function (response) {
                    if(response.success){
                        console.log("Copy Server Response :", response.message);
                        $('#grandTotal').text(response.TotalCost.toFixed(2));
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });

        }
    });
</script>



</body>
</html>