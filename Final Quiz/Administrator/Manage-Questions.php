
<?php 

include('./_Partial Components/Header.php');

if(isset($_GET['dsbl'])){
   $Question_ID = $_GET['dsbl'];
   $dsblQuestion = $usr->disableQuestion($Question_ID);
}

if(isset($_GET['enbl'])){
   $Question_ID = $_GET['enbl'];
   $enblQuestion = $usr->enableQuestion($Question_ID);
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
                <h1 style = "color: #2C3E50"> <i class = "fa fa-question"> </i> <small> View All Questions </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Add-Questions.php"> <i class = "fa fa-question"></i> Add Questions </a></li>
                </ol>
            </div>
            <div class = "col-sm-5 text-right pull-right">
                <form class=" "  method="POST">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name ="searchQuestion" id ="searchQuestion" autocomplete="off" placeholder="Search for Questions">
                            <span class="input-group-btn">
                                <button class="btn btn-green"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </form>
            </div>
            <div class="col-md-12" id = "resultQuestion">
                  <form method = "POST">
                    <?php 
                    $Question = $exm->getQuestion();
                    if(!$Question){
                        echo "<br>";
                        echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Questions Found </div>';
                        echo "<br>";
                    }
                    else{

                    if($Question->num_rows>0){
                           
                    ?>

                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th> ID_No </th>
                            <th> Question </th>
                            <th> Answer 1 </th>
                            <th> Answer 2 </th>
                            <th> Answer 3 </th>
                            <th> Answer 4 </th>
                            <th> Subject </th>
                            <th> Edit </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                <?php 
                $i=0;
                while($row = $Question->fetch_array()){ ?>
                    <tr>
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Question is Locked">'.' <i class = "fa fa-lock"></i> '.$i.'</div>';
                                }
                                else{
                                    echo $i;
                                }
                            ?>
                        </td>
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Question is Locked">'.$row['Question'].'</div>';
                                }
                                else{
                                    echo $row['Question'];
                                }
                            ?>
                        </td>
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Question is Locked">'.$row['Answer0'].'</div>';
                                }
                                else{
                                    echo $row['Answer0'];
                                }
                            ?>
                        </td>
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Question is Locked">'.$row['Answer1'].'</div>';
                                }
                                else{
                                    echo $row['Answer1'];
                                }
                            ?>
                        </td>
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Question is Locked">'.$row['Answer2'].'</div>';
                                }
                                else{
                                    echo $row['Answer2'];
                                }
                            ?>
                        </td>
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Question is Locked">'.$row['Answer3'].'</div>';
                                }
                                else{
                                    echo $row['Answer3'];
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
                        <td> <a href="Edit-Questions.php?edit=<?php echo $row['Question_ID'];?>" style="color: #32C5D2;"  data-toggle="tooltip" data-placement="top" title="Edit Question"> <i class = "fa fa-pencil"></i>edt</a></td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="Delete/DeleteQuestion.php?del=<?php echo $row['Question_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Question"> <i class = "fa fa-times"></i> dlt</a> </td>
                    </tr>
                
                <?php $i++; }} 
                else{
                    echo "<br>";
                    echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Questions Found </div>';
                    echo "<br>";
                    }
                    }
                  
                    ?>
                    </table>
                    </form>
            <!-- END CONTENT BODY -->
            </div>
    <!-- END CONTENT -->
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