
<?php 

include('./_Partial Components/Header.php');

if(isset($_GET['del'])){
   $Facutly_ID = $_GET['del'];
   $deleteFaculty = $exm->delFaculty($Facutly_ID);
   if($deleteFaculty){
        $msg = "Faculty has deleted Successfully";
   }
   else{
        $error = "Faculty Not Deleted!";
   }
}

?>
    <div class="containe">
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
                <h1 style = "color: #2C3E50"> <i class = "fa fa-home"> </i> <small> View All Faculties </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Add-Faculty.php"> <i class = "fa fa-home"></i> Add Faculty </a></li>
                </ol>
            </div>
            <div class = "col-sm-9">
                     
            </div>
            <div class="col-md-12">
                <form method = "POST" action = "">
                    <?php 
                    $Faculty = $exm->getFaculty();
                    if(!$Faculty){
                        echo "<br>";
                        echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Faculty Found </div>';
                        echo "<br>";
                    }
                    else{

                    if($Faculty->num_rows>0){
                           
                    ?>
                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Faculty </th>
                            <th> Language </th>
                            <th> Edit </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                <?php while($row = $Faculty->fetch_array()){ ?>
                    <tr>
                        <td> <?php echo $row['Faculty_ID'];?></td>
                        <td> <?php echo $row['Faculty'];?> </td>
                        <td> <?php echo $row['Language'];?> </td>
                        <td> <a href="Edit-Faculty.php?edit=<?php echo $row['Faculty_ID'];?>" style="color: #32C5D2;"> <i class = "fa fa-pencil"></i> Edit</a></td>
                        <td> <a onclick="return confirm('are you sure you want to delete Faculty')" href="Delete/DeleteFaculty.php?del=<?php echo $row['Faculty_ID'];?>" style="color: #D05454;"> <i class = "fa fa-times"></i> Delete </a> </td>
                    </tr>
                
                <?php }} 
                else{
                    echo "<br>";
                    echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Faculty Found </div>';
                    echo "<br>";
                    }
                    }
                  
                    ?>
                    </table>
              </form> 
            <!-- END CONTENT BODY -->
            </div>
    <!-- END QUICK SIDEBAR -->
</div> 
                	   	  
    		</div>
    	</div>
    </div>

<?php 
include('./_Partial Components/Footer.php');
?>