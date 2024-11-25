<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

        /* Make columns stack vertically on smaller screens */
        /* For smaller screens (mobile devices) */
        /*@media (max-width: 576px) {*/
        /*    .card-head .col-12 {*/
        /*        padding-left: 1rem;*/
        /*        padding-right: 1rem;*/
        /*    }*/

        /*    .card-head .col-md-4 {*/
        /*        padding-left: 0;*/
        /*        padding-right: 0;*/
        /*        margin-bottom: 1rem;*/
        /*    }*/

        /*    .card-head .col-md-4 input {*/
        /*        width: 100%;*/
        /*    }*/

        /*    .card-head .col-md-4 label {*/
        /*        font-size: 14px;*/
        /*        margin-bottom: 5px;*/
        /*    }*/
        /*}*/

        /* For larger screens (tablets and above) */
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
        @media (max-width: 576px) {
            hr{
                width: 93.2%;
                margin-left: 12px;
            }
        }


    </style>
</head>
<body>



<div class="container">
    <div class="card mb-3">
        <div class="card-head row responsive">
            <div  class="text-center">
                <h3 style='margin: auto; background-color: #037837; margin-bottom: -2px; color:white;'>Project, Construction Of Residential Building</h3>
                <h3 style='margin: auto; background-color :#037837; margin-bottom: -2px; color:white;'>Quantity and Cost Estimate</h3>

                <!--                <hr style="margin: auto; color: inherit; border-top: var(--bs-border-width) solid; position: relative; left: -24px;">-->
            </div>
            <hr style="margin: 20px;  margin-bottom: 20px; width: 98.2%;  margin-left: 12px; ">
            <div class="col-12 col-md-4 d-flex align-items-center mb-3 margin:auto form-group" style="padding-left: 2rem; font-weight: bold;">
                <label class="me-2">Project</label>
                <input type="text"
                       class="form-control projectInput ProjectName"
                       data-project_id=""
                       data-columnName="ProjectName"
                       placeholder="Project Name"
                       value=""
                       style="border: 2px solid  #AC87C5" />
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center mb-3 form-group" style="padding-left: 2rem; font-weight: bold;">
                <label class="me-2 ">BOQ</label>
                <input type="text"
                       class="form-control projectInput BOQTitle"
                       data-project_id=""
                       data-columnName="BOQTitle"
                       placeholder="BOQ Title"
                       value=""
                       style="border: 2px solid #AC87C5" />
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center mb-3 form-group" style="padding-left: 2rem; font-weight: bold;">
                <label class="me-2 ">Date</label>
                <input type="date"
                       class="form-control projectInput DateInserted"
                       data-project_id=""
                       data-columnName="DateInserted"
                       placeholder="Date"
                       value=""
                       style="border: 2px solid #AC87C5" />
            </div>
        </div>
    </div>



        <div class="table-responsive ">
            <table class="table table-bordered">
                <thead >
                    <tr >
                        <td>No</td>
                        <td scope="col" style="padding: 10px 150px; text-align: center;" >Description </td>
                        <td scope="col" style="padding: 10px 60px; text-align: center;" >Unit</td>
                        <td scope="col" style="padding: 10px 60px; text-align: center;" >Quantity</td>
                        <td scope="col" style="padding: 10px 60px; text-align: center;" >Rate</td>
                        <td scope="col" style="padding: 10px 60px; text-align: center;" >Cost</td>
                        <td ><button type="button" class="material-icons addNewCategory" value="" >add_circle</button></td>
        <!--                <td style="border-radius:5px; border: none; text-align: center; background-color: snow !important;" >-->
        <!--                    <button type="button" class="btn btn-primary addNewCategory" style="display: flex; align-items: center; padding: 5px 10px; border: none; border-radius: 5px; background-color: #90A4AE; color: white; cursor: pointer;">-->
        <!--                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i>-->
        <!--                    </button>-->
        <!--                </td>-->
                    </tr>
                </thead>
        <tbody id="tableBody">
<!--        code goes here-->
        </tbody>
    </table>
  </div>
    </div>
</div>


<!--/*-->
<!--*  Declare a TBODY_TRS-->
<!--* 1. Make a category tr-->
<!--* 2. Check the category sub_categories data-->
<!--*   2.1 If the sub_categories data found-->
<!--*   2.2 Run a loop to read sub_categories-->
<!--*   2.3 Declare a sub_category_tr_based_on_category_1 (Here 1 is a loop index or categories.id)-->
<!--* 3. Make another TR as category_cost_tr-->
<!--* */-->

<script src="jsfile.js"></script>


</body>
</html>