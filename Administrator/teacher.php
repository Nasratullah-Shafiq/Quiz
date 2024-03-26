
<?php 

include('./_Partial Components/Header.php');

?>
    <div class="containe">
    	<div class="row" id="row">
            <div class="left-side-bar">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                 <?php include('./_Partial Components/Navigation.php');?>
                <!-- END SIDEBAR -->
            </div>
            <div class="right-side-bar">
            
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div class="row">
            <div calss = "col-md-9">
                <h1 style = "color: #2C3E50"> <i class = "fa fa-user"> </i> <small> View All Teacher </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Add-Teacher.php"> <i class = "fa fa-user-plus"></i> Add Teacher </a></li>
                </ol>
            </div>
            <div class = "col-sm-5 text-right pull-right">
                <form class=" "  method="POST">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name ="searchTeacher" id ="searchTeacher" autocomplete="off" placeholder="Search for Teachers ">
                            <span class="input-group-btn">
                                <button class="btn btn-green"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </form>
            </div>
            <div class="col-md-12" id = "resultTeacher">
                <form method = "POST" >
                    <?php 
                    $Teacher = $exm->getTeacher();
                    if(!$Teacher){
                        echo "<br>";
                        echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Teachers Found </div>';
                        echo "<br>";
                    }
                    else{

                    if($Teacher->num_rows>0){
                           
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
                            <th> Teacher_Name </th>
                            <th> Email </th>
                            <th> Gender </th>
                            <th> Mobile_No </th>
                            <th> Time </th>
                            <th> Edit </th>
                            <th> Del </th>
                        </tr>
                    </thead>
                <?php while($row = $Teacher->fetch_array()){ ?>
                    <tr>
                        <td> <?php echo $row['Teacher_ID'];?></td>
                        <td> <?php echo $row['Teacher_Name'];?> </td>
                        <td> <?php echo $row['Email'];?> </td>
                        <td> <?php echo $row['Gender'];?> </td>
                        <td> <?php echo $row['Mobile_No'];?> </td>
                        <td> <?php echo $row['Time'];?> </td>
                        <td> <a href="Edit-Teacher.php?edit=<?php echo $row['Teacher_ID'];?>" style="color: #32C5D2;"> <i class = "fa fa-pencil"></i> Edit</a></td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="Delete/DeleteTeacher.php?del=<?php echo $row['Teacher_ID'];?>" style="color: #D05454;"> <i class = "fa fa-times"></i> Delete </a> </td>
                    </tr>
                
                <?php }} 
                else{
                    echo "<br>";
                    echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Teachers Found </div>';
                    echo "<br>";
                    }
                    }
                  
                    ?>
                    </table>
                </form> 
            </div>
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