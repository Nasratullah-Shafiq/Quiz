
<?php 

include('./_Partial Components/Header.php');

?>    <div class="containe">
    	<div class="row" id="row">
            <div class="left-side-bar">
                <!-- BEGIN SIDEBAR -->
                <?php include('./_Partial Components/Navigation.php');?>
                <!-- END SIDEBAR -->
            </div>
            <div class="right-side-bar">
            
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div class="row">
            <div calss = "col-md-9">
                <h1 style = "color: #2C3E50"> <i class = "fa fa-book"> </i> <small> View All Subjects </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Add-Subject.php"> <i class = "fa fa-book"></i> Add Subject </a></li>
                </ol>
            </div>
            <div class = "col-sm-5 text-right pull-right">
                <form class=" "  method="POST">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name ="searchSubject" id ="searchSubject" autocomplete="off" placeholder="Search for Subjects ">
                            <span class="input-group-btn">
                                <button class="btn btn-green"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </form>
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
                        <td> <a href="Edit-Subject.php?edit=<?php echo $row['Subject_ID'];?>" style="color: #32C5D2;"  data-toggle="tooltip" data-placement="top" title="Edit Subject"> <i class = "fa fa-pencil"></i> Edit</a></td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="Delete/DeleteSubject.php?del=<?php echo $row['Subject_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Subject"> <i class = "fa fa-times"></i> Delete </a> </td>
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