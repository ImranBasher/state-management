<?php

//function loadProject($conn, $projectID = null) {
//
//
//    // Check if $projectID is provided and build the SQL query accordingly
//    if (isset($projectID)) {
//        $sql = "SELECT * FROM tblproject WHERE ProjectID = '$projectID'";
//        $result = mysqli_query($conn, $sql);
//        $project = mysqli_fetch_assoc($result);
//    }
//
//    // Initialize an empty string for the project body
//    $project_body = '';
//
//    // Generate HTML for project input fields with data if available, or empty otherwise
//    $project_body .= '<div class="col-md-4 d-flex align-items-center" style="padding-left: 2rem; font-weight:bold">
//                        <label>Project Name: </label>
//                        <input type="text"
//                               class="form-control projectInput ProjectName"
//                               data-project_id="' . ($projectID ?? '') . '"
//                               data-columnName="ProjectName"
//                               placeholder="ProjectName"
//                               value="' . (isset($project['ProjectName']) ? $project['ProjectName'] : '') . '"
//                               style="border: none; outline: none;"
//                        />
//                    </div>
//                    <div class="col-md-4 d-flex align-items-center" style="padding-left: 4rem; font-weight:bold">
//                        <label>BOQ Title: </label>
//                        <input type="text"
//                               class="form-control projectInput BOQTitle"
//                               data-project_id="' . ($projectID ?? '') . '"
//                               data-columnName="BOQTitle"
//                               placeholder="BOQTitle"
//                               value="' . (isset($project['BOQTitle']) ? $project['BOQTitle'] : '') . '"
//                               style="border: none; outline: none;"
//                        />
//                    </div>
//                    <div class="col-md-4 d-flex align-items-center" style="padding-left: 4rem; font-weight:bold">
//                        <label>Date: </label>
//                        <input type="date"
//                               class="form-control projectInput DateInserted"
//                               data-project_id="' . ($projectID ?? '') . '"
//                               data-columnName="DateInserted"
//                               placeholder="Date"
//                               value="' . (isset($project['DateInserted']) ? date('Y-m-d', strtotime($project['DateInserted'])) : '') . '"
//                               style="border: none; outline: none;"
//                        />
//                    </div>';
//
//    return $project_body;
//}

include "grandTotal1.php";
function loadData($conn, $insertedProjectId=null, $insertCategoryId=null, $insertSubcategoryId=null){

    $tbodyTR    = "";

    $categoryId = '';

    if(is_null($insertedProjectId)){
       $tbodyTR .= "Empty Project Id";
        return $tbodyTR;
    }else{
        $sql = "SELECT BoqCategoryID FROM tblboqcategory WHERE   ProjectID='$insertedProjectId'";
        $result = mysqli_query($conn, $sql);
       if( $category = mysqli_fetch_assoc($result)){
           $categoryId = $category['BoqCategoryID'];
       }
    }

    if(is_null($insertCategoryId) && is_null($categoryId)){
        $tbodyTR .= "Empty Category";
        return $tbodyTR;
    }else{

//        $sql = "SELECT * FROM tblboqcategory WHERE   BoqCategoryID='$categoryId' ORDER BY BoqCategoryID ASC";

        $sql = "SELECT * FROM tblboqcategory WHERE ProjectID='$insertedProjectId' ORDER BY BoqCategoryID ASC";
        $result = mysqli_query($conn, $sql);

      //  $grandTotal = 0;

        $romanNumerals = [
            "I", "II", "III", "IV", "V",
            "VI", "VII", "VIII", "IX", "X",
            "XI", "XII", "XIII", "XIV", "XV",
            "XVI", "XVII", "XVIII", "XIX", "XX",
            "XXI", "XXII", "XXIII", "XXIV", "XXV",
            "XXVI", "XXVII", "XXVIII", "XXIX", "XXX",
            "XXXI", "XXXII", "XXXIII", "XXXIV", "XXXV",
            "XXXVI", "XXXVII", "XXXVIII", "XXXIX", "XL",
            "XLI", "XLII", "XLIII", "XLIV", "XLV",
            "XLVI", "XLVII", "XLVIII", "XLIX", "L"
        ];
        $categories = [];
        $categoryLoop = 1;

        while ($category = mysqli_fetch_assoc($result)) {
            $categories[] = $category;
            // Category TR
            $subCostRow = 'subcategory-cost-row-' . $categoryLoop;

            $categoryId = $category["BoqCategoryID"];

            $romanCount = $romanNumerals[$categoryLoop - 1];

            $categoryRowId = 'category-row-' . $categoryLoop;

            $tbodyTR .= "<tr id='category-row-{$categoryLoop}' style='background-color: cadetblue' class='category-tr'>
                                 <td style='background-color: #5FB786; font-weight: bold !important;'>    
                                    $romanCount 
                                    </td>
                                <td style='background-color: #5FB786; font-weight: bold !important;'>
                                   <input  
                                        style='background-color: #92F6BE; width: 100%; font-weight: bold; border: 2px solid  #90A4AE !important;'
                                        type='text'
                                        
                                        class='form-control categoryInput'
                                        data-project_id='".$insertedProjectId."'
                                        data-category_id='" . $categoryId . "'
                                        data-category_row_id='" . $categoryRowId . "'
                                        placeholder='Category'
                                        value='{$category['CategoryName']}'
                                    /> 
                                </td>
                                <td colspan='5' style='background-color: #5FB786'>
                                
                                </td>
                     </tr>";

//        <td colspan='5' style='background-color: cadetblue'>
//                                     <span class='material-icons categorySpan' data-category_id='{$categoryId}' >add_circle</span>
//                                </td>

            $subcategory_sql = "SELECT * FROM tblboqsubcategory WHERE BoqCategoryID = " . $category['BoqCategoryID'] . " ORDER BY BoqSubcategoryID ASC ";

            $subcategory_result = mysqli_query($conn, $subcategory_sql);

            $subcategories = [];

            $subcategoryLoop = 1;

            $subCategoryTotalCost = 0;


            while ($subcategory = mysqli_fetch_assoc($subcategory_result)) {
                $subcategories[] = $subcategory;
                $subcategoryId = $subcategory["BoqSubcategoryID"];

                $rowId = 'subcategory-row-' . $subcategoryId;

                $rate = $subcategory["SubcategoryRate"];
                $qty = $subcategory["SubcategoryQty"];

                $subcategoryQty = $qty;
                $subcategoryRate = $rate;

                if ($rate <= 0) {
                    $subcategoryRate = 0;
                }

                if ($qty <= 0) {
                    $subcategoryQty = 0;
                }


                $cost = $subcategoryRate * $subcategoryQty;
                $subcategoryCost = number_format($cost, 2, '.', ''); // Changed to format as a string

                $subCategoryTotalCost += $cost;
                $unit = '';
                if(isset($subcategory['SubcategoryUnit']) ){

                    if($subcategory['SubcategoryUnit'] === 'm3' || $subcategory['SubcategoryUnit'] === 'M3' || $subcategory['SubcategoryUnit'] === 'm^3' || $subcategory['SubcategoryUnit'] === 'M^3'){
                        $unit = "m&#179;";
                    }else{
                        $unit = $subcategory['SubcategoryUnit'];
                    }
                }


              //  $grandTotal +=$subCategoryTotalCost;

                $tbodyTR .= "<tr id='{$rowId}' class='subcategory-tr'>
                        <td>" . ($subcategoryLoop) . ".</td>
                        <td>
                            <input type='text' 
                                   class='form-control subcategoryInput SubcategoryName'
                                    data-project_id='".$insertedProjectId."'
                                    data-category_id='{$categoryId}'
                                   data-sub_category_id='{$subcategoryId}'  
                                   data-columnName='SubcategoryName' 
                                   data-category_row_id='{$categoryRowId}'
                                   data-subCostRow ='{$subCostRow}'
                                   data-sub_category_row_id='{$rowId}'                 
                                   placeholder='Sub Name'
                                   value='" . (isset($subcategory['SubcategoryName']) ? $subcategory['SubcategoryName'] : '') . "' 
                                   style='border: 2px solid  #90A4AE'
                            />
                        </td>
                        
                        <td>
                            <input type='text' 
                                       class='form-control subcategoryInput SubcategoryUnit'
                                        data-project_id='".$insertedProjectId."'
                                        data-category_id='{$categoryId}'
                                       data-sub_category_id='{$subcategoryId}' 
                                       data-columnName='SubcategoryUnit' 
                                   data-category_row_id='{$categoryRowId}'
                                   data-subCostRow ='{$subCostRow}'
                                   data-sub_category_row_id='{$rowId}'                   
                                       placeholder='Unit'
                                       value='" . (isset($subcategory['SubcategoryUnit']) ? $unit : '') . "' 
                                        style='border: 2px solid  #90A4AE'
                            />
                        </td>
                        <td>
                            <input type='text' 
                                   class='form-control subcategoryInput SubcategoryQty'
                                    data-project_id='".$insertedProjectId."'
                                    data-category_id='{$categoryId}'
                                   data-sub_category_id='{$subcategoryId}' 
                                   data-columnName='SubcategoryQty'                     data-category_row_id='{$categoryRowId}' 
                                   data-subCostRow ='{$subCostRow}'
                                   data-sub_category_row_id='{$rowId}'
                                   placeholder='Number'
                                    value='" . (isset($subcategory["SubcategoryQty"]) ? $subcategory["SubcategoryQty"] : '') . "' 
                                    style='border: 2px solid  #90A4AE'
                            />
                        </td>
                        <td>
                            <input type='text' 
                                   class='form-control subcategoryInput SubcategoryRate'
                                    data-project_id='".$insertedProjectId."'
                                    data-category_id='{$categoryId}'
                                   data-sub_category_id='{$subcategoryId}' 
                                   data-subCostRow ='{$subCostRow}'
                                   data-columnName='SubcategoryRate' 
                                   data-category_row_id='{$categoryRowId}'
                                   data-sub_category_row_id='{$rowId}'
                                   placeholder='Number'
                                   value='" . (isset($subcategory['SubcategoryRate']) ? $subcategory['SubcategoryRate'] : '') . "' 
                                   style='border: 2px solid  #90A4AE'
                            />
                        </td>
                        <td>
                            <input type='text' 
                                   class='form-control subcategoryCost' 
                                    data-project_id='".$insertedProjectId."'
                                    data-category_id='{$categoryId}'
                                    data-subCostRow ='{$subCostRow}'
                                   data-category_row_id='{$categoryRowId}'
                                   data-sub_category_row_id='{$rowId}'
                                   value='" . $subcategoryCost . "'
                                   style='border: 2px solid  #90A4AE'
                                   readonly
                                   />
                        </td>
                        <td>
                        <div style='display: flex; align-items: center; gap: 10px;'>
                        <div>
                            <span class='material-icons addSubcategoryRow'
                                    data-project_id='".$insertedProjectId."'
                                    data-sub_category_row_id='{$rowId}'
                                    data-category_id='{$categoryId}'
                            >
                                  add_circle
                            </span> 
                        </div>
                        <div style='float:left; text-align: center;'>
                            <span   style='text-align: center;'
                                    class='material-icons deleteSubcategoryRow' 
                                    data-project_id='".$insertedProjectId."'
                                    data-sub_category_row_id='{$rowId}'
                                    data-category_id='{$category["BoqCategoryID"]}'
                                    data-subcategory_id='{$subcategory['BoqSubcategoryID']}'
                                    
                            >
                                remove_circle
                            </span>
                        </div>
                        </div>
                        </td>
                    </tr>";
                $subcategoryLoop++;
            }

          //  onclick=\"deleteSubcategoryRow('{$insertedProjectId}','{$subcategory['BoqSubcategoryID']}', '{$category['BoqCategoryID']}', '{$subCostRow}')\"

            // Category Cost TR Here
            $tbodyTR .= "<tr id='{$subCostRow}'>
                    <td colspan='5' align='right'><b>Total Cost: </b></td>
                    <td style='text-align: center;'><span class='subcategoryTotal '   data-project_id='".$insertedProjectId."'>" . number_format($subCategoryTotalCost, 2) . " /=</span></td>
                </tr>";

            $categoryLoop++;

        }
        // Add Grand Total TR
        $tbodyTR .= "<tr id='grandTotalRow'>
                <td colspan='5' align='right' style='background-color:#17C664'><b>Grand Total Cost: </b></td>
                <td style='background-color: #17C664; text-align: center;'><span id='grandTotal' data-project_id='".$insertedProjectId."'>".grandTotal($conn,$insertedProjectId)." /=</span></td>
            </tr>";

        return $tbodyTR;
    }

}
