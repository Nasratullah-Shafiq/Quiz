
<?php 

include('./_Partial Components/Header.php');

?>    
<div class="main">

        <!-- your page content -->

    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-book"></i> Add Subject
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Paste your entire form here -->

                    <form action="" method="POST">

                        <!-- Subject -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="subject">
                            </div>
                        </div>

                        <!-- Language -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Language</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="language">
                                    <option>English</option>
                                    <option>Dari</option>
                                </select>
                            </div>
                        </div>

                        <!-- Continue pasting the rest of your fields here -->

                        <div class="text-end">

                            <button class="btn btn-primary" name="btn-add-subject">

                                <i class="fa fa-save"></i>
                                Add Subject

                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>





    	<div class="row" style="margin-left: 10px;">
             <div>
                <?php include('./_Partial Components/Navigation.php');?>
            </div>
           
            <div class="col-12">
            
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div class="row">
                <div class="row align-items-center mb-3">

    <!-- Page Title -->
    <div class="col-lg-5">
        <h2 class="text-dark mb-0">
            <small class="text-muted">
                Home
                <i class="fa fa-chevron-right px-2" style="font-size:14px;"></i>
                Subject
            </small>
        </h2>
    </div>

    <!-- Search -->
    <div class="col-lg-7">
        <form method="POST">
            <div class="mb-0">
                <label for="searchUser" class="form-label">
                    Search Subjects Here
                </label>

                <div class="input-group input-group-sm">
                    <input
                        type="text"
                        class="form-control"
                        id="searchUser"
                        name="searchUser"
                        placeholder="Search for Subjects...">

                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-search"></i> Search
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

<hr>

<!-- Breadcrumb + Actions -->
<div class="row mb-3">

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">

                    <li class="breadcrumb-item">
                        <a href="index">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#User_Data_Modal">
                            <i class="fa fa-plus"></i> Add Subject
                        </a>
                    </li>

                </ol>
            </nav>

            <!-- Right Buttons -->
            <div class="d-flex gap-2">

                <!-- Action Dropdown -->
                <div class="dropdown">
                    <button
                        class="btn btn-secondary btn-sm dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-cogs"></i> Action
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-file-excel-o text-success"></i>
                                Export to Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-file-pdf-o text-danger"></i>
                                Export to PDF
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-print text-secondary"></i>
                                Print
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-archive text-primary"></i>
                                Archive Selected
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="#">
                                <i class="fa fa-trash"></i>
                                Delete Selected
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Filter -->
                <button
                    class="btn btn-outline-secondary btn-sm"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#News_Data_Modal">

                    <i class="fa fa-filter"></i> Filter
                </button>

                <!-- Group By -->
                <button
                    class="btn btn-outline-secondary btn-sm"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#News_Data_Modal">

                    <i class="fa fa-layer-group"></i> Group By
                </button>

                <!-- Favorite -->
                <button
                    class="btn btn-outline-warning btn-sm"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#News_Data_Modal">

                    <i class="fa fa-star"></i> Favorite
                </button>

            </div>

        </div>

    </div>

</div>

<div class="row">
    <div class="col-12">

    </div>
</div>
                





            <div class="col-md-12" id = "resultSubject">
                <form method = "POST">
                    <?php 
                    $Subject = $exm->getSubject();
                    if(!$Subject){
                        echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Subjects Found </div>';
                    }
                    else{

                    if($Subject->num_rows>0){
                           
                    ?>
                    <?php 
                        if (isset($error)) {
                            echo "<span style = 'color: red;' class = 'pull-right'> $error </span>";
                        }
                        else if (isset($msg)) {
                            echo "<span style = 'color: green;' class = 'pull-right'> $msg </span>";
                        }
                    ?>
                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th> <input type="checkbox" id="allselect"> </th>
                            <th> ID </th>
                            <th> Subject </th>
                            <th> Credit Hours </th>
                            <th> Time </th>
                            <th> Teacher </th>
                            <th> Faculty </th>
                            <th> Status </th>
                            <th> Action </th>
                            <th> Edit </th>
                            <th> Del </th>
                        </tr>
                    </thead>
                <?php 
                    $i=1;
                    while($row = $Subject->fetch_array()){ ?>
                        <tr>
                            <td> <input type="checkbox" class="row-checkbox"> </td>
                            <td> 
                                <?php 
                                    if($row['Status']==0){
                                        echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Subject is Locked">'.' <i class = "fa fa-lock"></i> '.$i.'</div>';
                                    }
                                    else{
                                        echo $i;
                                    }
                                ?>
                            </td>
                        
                            <td class = "subject">
                            <a href="View-Questions.php?sb=<?php echo $row['Subject']?>" data-toggle="tooltip" data-placement="top" title="View all Questions for this subject?"  style="color: black;"> 
                                <?php 
                                    if($row['Status']==0){
                                        echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Subject is Locked">'.$row['Subject'].'</div>';
                                    }
                                    else{
                                        echo $row['Subject'];
                                    }
                                ?>
                                </a>
                            </td>
                       
                        <!-- <td> <?php //echo $row['Subject'];?> </td>  -->
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Subject is Locked">'.$row['Credit_Hours'].'</div>';
                                }
                                else{
                                    echo $row['Credit_Hours'];
                                }
                            ?>
                        </td>
                        <!-- <td> <?php //echo $row['Credit_Hours'];?> </td> -->
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Subject is Locked">'.$row['Time'].' Min'.'</div>';
                                }
                                else{
                                    echo $row['Time'].' Min';
                                }
                            ?>
                        </td>
                        <!-- <td> <?php //echo $row['Time'].' Sec';?> </td> -->
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Subject is locked">'.$row['Teacher_Name'].'</div>';
                                }
                                else{
                                    echo $row['Teacher_Name'];
                                }
                            ?>
                        </td>
                        <!-- <td> <?php //echo $row['Teacher_Name'];?> </td> -->
                        <!-- <td> <?php //echo $row['Faculty'];?> </td> -->
                                                <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Subject is Locked">'.$row['Faculty'].'</div>';
                                }
                                else{
                                    echo $row['Faculty'];
                                }
                            ?>
                        </td>
                        <?php if($row['Status']=='0'){ ?>
                        <td style = "color: #D05454;"> Lock </td>
                        <?php } else{?>
                        <td style="color: #32C5D2;"> Unlock </td>
                        <?php }?>
                        <?php if($row['Status']=='0'){ ?>
                        <td> <a onclick="return confirm('Are you sure you want to Allow Subject')" href="Enable/EnableSubject.php?enbl=<?php echo $row['Subject_ID'];?>" style="color: #32C5D2;"  data-toggle="tooltip" data-placement="top" title="Subject is Locked You wnat to Unlock?"><i class = "fa fa-check"></i>  Unlock </a> </td>
                        <?php } else{?>
                        <td> <a onclick="return confirm('Are you sure you want to Deny Subject')" href="Enable/DisableSubject.php?dsbl=<?php echo $row['Subject_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Subject is Unlock you want to Lock This?"> <i class = "fa fa-lock"></i>  Lock </a> </td>
                        <?php }?>
                        <td> <a href="Edit-Subject.php?edit=<?php echo $row['Subject_ID'];?>" style="color: #32C5D2;"  data-toggle="tooltip" data-placement="top" title="Edit Subject"> <i class = "fa fa-pencil"></i></a></td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="Delete/DeleteSubject.php?del=<?php echo $row['Subject_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Subject"> <i class="fa fa-trash"></i> </td>
                    </tr>
                
                <?php $i++; }} 
                else{
                    echo "<br>";
                    echo "<br>";
                    echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Subjects Available ! </div>';
                    echo "<br>";
                    }
                    }
                  
                    ?>
                    </table>
              </form> 
            <!-- END CONTENT BODY -->
            </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
  
    <script type="text/javascript">
    // Your jQuery code goes here
   document.addEventListener("DOMContentLoaded", function () {

    const allSelect = document.getElementById("allselect");
    const checkboxes = document.querySelectorAll(".row-checkbox");

    // Select/Deselect All
    allSelect.addEventListener("change", function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = allSelect.checked;
        });
    });

    // Update Select All when individual checkbox changes
    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener("change", function () {

            const checkedCount = document.querySelectorAll(".row-checkbox:checked").length;

            if (checkedCount === checkboxes.length) {
                allSelect.checked = true;
            } else {
                allSelect.checked = false;
            }

        });

    });

});

</script>

    <!-- END QUICK SIDEBAR -->
                </div>    	  
    		</div>
    	</div>
    </div>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<?php 
include('./_Partial Components/Footer.php');
?>