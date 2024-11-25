
    $(document).ready(function () {
        let scrollPosition = window.scrollY;

        $(document).on("change", ".projectInput", function () {
          //  console.log("enter into project insertion.");
            let projectId = $(this).attr("data-project_id") || null;
            let projectValue = $(this).val();
            let columnName = $(this).attr("data-columnName");

            const payload = {
                projectId: projectId,
                projectValue: projectValue,
                columnName: columnName,
            };

         //   console.log("project payload :", payload);
            insertProjectAjax(payload);
        });
        function insertProjectAjax(payload) {
            $.ajax({
                type: "POST",
                url: "projectInclution.php", // PHP script to insert category
                data: payload,
                dataType: "JSON",
                success: function (response) {
                 //   console.log("project Insert Server Response", response);


                    if (response.success) { // Check if the response indicates success
                        const Date = response.DateInserted.substring(0, 10);

                        $(".projectInput").attr('data-project_id', response.projectId);
                        $(".ProjectName").val(response.projectName);
                        $(".BOQTitle").val(response.BOQTitle);
                        $(".DateInserted").val(Date);
                        $(".addNewCategory").attr('value', response.projectId);
                        // $("#tableBody").html(response.loadedHTML);
                    } else {
                        console.error('Insert/update failed', response);
                    }
                },
                error: function (XHR, status, error) {
                    console.log("Errors", XHR.responseText);
                }
            });
        }
        $(document).on("click", ".addNewCategory", function (){
          //  console.log("clicked");
            let projectId = $(this).attr("value");
         //   console.log("Project Id :", projectId);
            const payload = {
                type : "category",
                ProjectID: projectId
            }
            console.log("click on add category button :", payload);
            insertCategoryAjax(payload);
        });
        // Category Update and insert
        function insertCategoryAjax(data = null){
          //  console.log(" after clicked for add new come in insertCategoryAjax, and there data is : ", data);
            // $("#tableBody").html(null);
            $.ajax({
                type: "POST",
                url: "insertCategory.php", // PHP script to insert category
                data: data,
                dataType:"JSON",
                success: function (response) {
                    console.log("Category Insert Server Response", response);
                    // $("#tableBody").html(response.loadedHTML);
                    console.log('categoryID, after add a category : ',response.category_id);
                    addSubCategory(response.projectId, response.category_id);
                },
                error:function (XHR,status,error){
                    console.log("Errors", XHR.responseText);
                }
            });
        }

        $(document).on("change",".categoryInput", function (e){
            let projectId = $(this).attr("data-project_id");
            let categoryId = $(this).attr("data-category_id");
            let categoryValue = $(this).val();
            let categoryrowId = $(this).attr("data-category_row_id");
            const payload = {
                projectId : projectId,
                BoqCategoryID : categoryId,
                CategoryName  : categoryValue,
                type          :"category_update"
            }
            updateCategoryAjax(payload, categoryrowId);
            console.log("Category Title : ", categoryValue,"Category ID ", categoryId);
        });
        function updateCategoryAjax(data = null, categoryrowId){
        // $("#tableBody").html(null);
            $.ajax({
                type: "POST",
                url: "insertCategory.php", // PHP script to insert category
                data: data,
                dataType:"JSON",
                success: function (response) {
                console.log("Category Insert Server Response", response);
                $(`#${categoryrowId}.categoryInput`).val(response.CategoryName);
                },
                    error:function (XHR,status,error){
                    console.log("Errors", XHR.responseText);
                }
            });
        }
        // Sub Category input update
        $(document).on("change",".subcategoryInput", function (e){
            e.preventDefault();
            let projectId = $(this).attr("data-project_id");
            let subCostRow               =  $(this).attr("data-subCostRow");
            let BoqSubCategoryID         = $(this).attr("data-sub_category_id");
            let BoqCategoryID            = $(this).attr("data-category_id");
            let SubCategoryColumnName    = $(this).attr("data-columnName");
            let SubCategoryInputValue    = $(this).val(); // rate,

            let CategoryRowID         = $(this).attr("data-category_row_id");
            let SubCategoryRowID         = $(this).attr("data-sub_category_row_id");

            const payload = {
                projectId : projectId,
                BoqSubCategoryID      : BoqSubCategoryID,
                BoqCategoryID         : BoqCategoryID,
                SubCategoryColumnName : SubCategoryColumnName,
                SubCategoryInputValue : SubCategoryInputValue,
            }

            console.log('subcategoryInput Value : ',payload);
            console.log('CategoryRowID :',CategoryRowID);
            console.log('SubCategoryRowID :',SubCategoryRowID);

            updateSubCategoryAjax(payload, BoqSubCategoryID, SubCategoryRowID, subCostRow );
          //  updateGrandTotal(projectId);
        });
        function updateSubCategoryAjax(data, BoqSubCategoryID, SubCategoryRowID, subCostRow) {
          // console.log('subCostRow :', subCostRow);
            const focusedElement = document.activeElement;

            const columnName = $(focusedElement).data('columnname');
            const subCategoryRowId = $(focusedElement).data('sub_category_row_id');

            $.ajax({
                type: "POST",
                url: "updateSubcategory.php",
                data: data,
                dataType: "JSON",
                success: function (response) {
                     console.log("Server Response................................................", response);
                    //   console.log("Row Selector000000000000000000000:", SubCategoryRowID);

                    if (response) {
                        if (response.SubcategoryName !== undefined) {
                            $(`#${SubCategoryRowID}`).find('.SubcategoryName').val(response.SubcategoryName);
                        }

                        if (response.SubcategoryUnit !== undefined) {
                            // Check if the value contains 'm3' and modify it if needed
                            let unitValue = response.SubcategoryUnit;
                            if (unitValue === 'm3' || unitValue === 'M3' || unitValue === 'm^3' || unitValue === 'M^3') {
                                unitValue = 'm&#179;'; // Unicode for superscript 3 (³)
                            }
                            // Set the value of the input field
                            $(`#${SubCategoryRowID}`).find('.SubcategoryUnit').val(unitValue);
                        }


                        if (response.SubcategoryQty !== undefined) {
                            $(`#${SubCategoryRowID}`).find('.SubcategoryQty').val(response.SubcategoryQty);
                        }

                        if (response.SubcategoryRate !== undefined) {
                            $(`#${SubCategoryRowID}`).find('.SubcategoryRate').val(response.SubcategoryRate);
                        }
                        if (response.SubcategoryCost !== undefined) {
                            $(`#${SubCategoryRowID}`).find('.subcategoryCost').val(response.SubcategoryCost);
                        }
                        if (response.TotalCosts !== undefined) {
                            $(`#${subCostRow}`).find('.subcategoryTotal').text(response.TotalCosts);
                        }
                        if (response.GrandTotalCost !== undefined) {
                            $(`#grandTotalRow`).find('#grandTotal').text(response.GrandTotalCost);
                        }
                    }

                    //
                    // if (columnName && subCategoryRowId) {
                    //     $(`${rowSelector} [data-columnname="${columnName}"][data-sub_category_row_id="${subCategoryRowId}"]`)
                    //         .focus();
                    // }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                }
            });

        }

        window.insertCategoryField = function (input, rowId, fieldType) {
            let projectId = $(this).attr("data-project_id");
            let categoryName = $(input).val();
            let data = {
                projectId : projectId,
                type: 'category',
                category_name: categoryName,
                field_type: fieldType
            };
            insertCategoryAjax(data);
        }
        function emptyTableKeepLast() {
            var tableBody = document.querySelector("#tableBody");
            var rows = tableBody.querySelectorAll("tr");

            // Loop through all rows except the last one and remove them
            for (var i = 0; i < rows.length - 1; i++) {
                tableBody.removeChild(rows[i]);
            }
        }
        $(document).on("click",".addSubcategoryRow", function (e){
            e.preventDefault();
            //scrollPosition = window.scrollY;
            let projectId = $(this).attr("data-project_id");
            let addSubcategoryRowID    = $(this).attr("data-sub_category_row_id");
            let BoqCategoryID          = $(this).attr("data-category_id");
            addSubCategory(projectId, BoqCategoryID, addSubcategoryRowID);

        });
        function addSubCategory(projectId, categoryId, categoryRowId = null){
            console.log('categoryId : ', categoryId);
            $.ajax({
                type: "POST",
                url: "insertSubcategory.php", // PHP file to handle the insertion of subcategory
                data: {
                    projectId:projectId,
                    categoryId: categoryId
                }, // Send the categoryId to associate with the new subcategory
                dataType:"JSON",
                success: function (response) {
                    // console.log("Server Response", response.loadedHTML);
                   // updateGrandTotal(projectId);
                    $("#tableBody").html(response.loadedHTML);
                },
                error: function (xhr, status, error) {
                    console.error('Failed to insert subcategory:', error);
                }
            });
        }

        // window.addSubcategoryRow = function (categoryId, categoryRowId) {
        //     scrollPosition = window.scrollY;
        //     addSubCategory(categoryId, categoryRowId);
        // }

        $(document).on("click",".deleteSubcategoryRow", function (e){
            e.preventDefault();
            console.log('Hellooooooooooooooo');

            //scrollPosition = window.scrollY;
            let ProjectId = $(this).attr("data-project_id");
            let addSubcategoryRowID    = $(this).attr("data-subcategory_id");
            let BoqCategoryID          = $(this).attr("data-category_id");

            console.log( ProjectId );
            deleteSubcategory(ProjectId, BoqCategoryID, addSubcategoryRowID);

        });

        // window.deleteSubcategoryRow = function(ProjectId,BoqSubcategoryID,BoqCategoryID){
        //     scrollPosition = window.scrollY;
        //
        //
        //     console.log( ProjectId );
        //     console.log(BoqSubcategoryID);
        //     console.log(BoqCategoryID);
        //     deleteSubcategory(ProjectId,BoqSubcategoryID, BoqCategoryID)
        // };
        function deleteSubcategory(ProjectId,BoqCategoryID,BoqSubcategoryID ){
            $.ajax({
                type: "POST",
                url: "deleteSubcategory.php",
                data: {
                    ProjectID : ProjectId,
                    BoqSubcategoryID: BoqSubcategoryID,
                    BoqCategoryID: BoqCategoryID
                },
                dataType:"JSON",
                success: function (response) {
                    console.log("Delete Server Response :", response.loadedHTML);
                    $("#tableBody").html(response.loadedHTML);
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }

        $(document).on("click",".deleteProject", function (e){
            e.preventDefault();
            //scrollPosition = window.scrollY;
         //   console.log("click on deleteProject.");
            let projectId = $(this).attr("data-project_id");
            deleteProject(projectId);
        });
        function deleteProject(projectId) {
            $.ajax({
                type: "POST",
                url: "deleteProject.php",
                data: {
                    projectId : projectId,
                },
                dataType:"JSON",
                success: function (response) {
                    if(response.success){
                        console.log("Delete Server Response :", response.message);
                        $("#projectTableBody").html(response.loadedHTML);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }


        $(document).on("click",".copyProject", function (e){
            e.preventDefault();
            //scrollPosition = window.scrollY;
          //  console.log("click on copyProject.");
            let projectId = $(this).attr("data-project_id");
          //  console.log("copyProjectId : ", projectId);

            copyProject(projectId);
        });
        function copyProject(projectId) {
            $.ajax({
                type: "POST",
                url: "copyProject.php",
                data: {
                    projectId : projectId,
                },
                dataType:"JSON",
                success: function (response) {
                    if(response.success){
                        console.log("Copy Server Response :", response.message);
                        $("#projectTableBody").html(response.loadedHTML);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }








        // GRAND TOTAL


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






    //
    // // Add Sub-categories for the category
    // $(document).on("click",".categorySpan",function (){
    //     let categoryId = $(this).attr("data-category_id");
    //
    //     addSubCategory(categoryId);
    // });
    // Delete subcategory for category



    // function insertCategoryAjax(data = null){
    //     // $("#tableBody").html(null);
    //
    //     $.ajax({
    //         type: "POST",
    //         url: "insertCategory.php", // PHP script to insert category
    //         data: data,
    //         dataType:"JSON",
    //         success: function (response) {
    //             console.log("Category Insert Server Response", response.loadedHTML);
    //             // $("#tableBody").html(response.loadedHTML);
    //             addSubCategory(response.category_id);
    //         },
    //         error:function (XHR,status,error){
    //             console.log("Errors", XHR.responseText);
    //
    //         }
    //     });
    // }



