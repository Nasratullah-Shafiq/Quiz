
<?php 

include('./_Partial Components/Header.php');
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'./_Partial Components/Users.php');
$usr = new Users();


if(isset($_GET['del'])){
   $Question_ID = $_GET['del'];
   $deleteQuestion = $exm->delQuestions($Question_ID);
   if($deleteQuestion){
        $msg = "Question has deleted Successfully";
   }
   else{
        $error = "Questions Not Deleted!";
   }
}

if(isset($_GET['dsbl'])){
   $Question_ID = $_GET['dsbl'];
   $dsblQuestion = $usr->disableQuestion($Question_ID);
}

if(isset($_GET['enbl'])){
   $Question_ID = $_GET['enbl'];
   $enblQuestion = $usr->enableQuestion($Question_ID);
}

?>

<?php 

if(isset($_GET['sb'])){
   $Subject = $_GET['sb'];
}
else{
    header('Location: index.php');
}
?>
    <div class="containe">
    	<div class="row" id="row">
            <!-- BEGIN SIDEBAR -->
            <div class="left-side-bar">
                
                 <?php include('./_Partial Components/Navigation.php');?>
    
            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN DIV CONTENT -->
            <div class="right-side-bar">

            <div class="row">
            <div calss = "col-md-9">
                <h1> <i class = "fa fa-question"> </i> <small> <?php echo $Subject;?> Questions </small></h1><hr>
                <ol class="breadcrumb">
                    <li ><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Manage-Subject.php"> <i class = "fa fa-book"></i> Manage Subject </a></li>
                </ol>
            </div>
                <div class="col-md-12">
                  <form method = "POST" action = "QuizAnswer.php">
                    <?php 
                    $Question = $exm->getQuestions($Subject);
                    if(!$Question){
                        echo "<br>";
                        echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... No Questions Available for ' . $Subject. ' Subject. </div>';
                        echo "<br>";
                        // echo "<h2> </h2>";
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
                            <th> Status </th>
                            <th> Action </th>
                            <th> Edt </th>
                            <th> Dlt </th>
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
                        <td> 
                            <?php 
                                if($row['Status']==0){
                                    echo '<div style = "color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This Question is Locked">'.$row['Subject'].'</div>';
                                }
                                else{
                                    echo $row['Subject'];
                                }
                            ?>
                        </td>
                        <?php if($row['Status']=='0'){ ?>
                        <td style = "color: #D05454;"> Lock </td>
                        <?php } else{?>
                        <td style="color: #32C5D2;"> Unlock </td>
                        <?php }?>                     
                        <?php if($row['Status']=='0'){ ?>
                        <td> <a onclick="return confirm('Are you sure you want to unlock this Question')" href="?sb=<?php echo $Subject ?> & enbl=<?php echo $row['Question_ID'];?>" style="color: #32C5D2;"  data-toggle="tooltip" data-placement="top" title="This question has blocked Do you want to unblock?"> Unlock </a> </td>
                        <?php } else{?>
                        <td> <a onclick="return confirm('Are you sure you want to Lock This Question')" href="?sb=<?php echo $Subject ?> & dsbl=<?php echo $row['Question_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="This question has unblocked Do you want to block?"> lock </a> </td>
                        <?php }?>
                        <td> <a href="Edit-Questions.php?edit=<?php echo $row['Question_ID'];?>" style="color: #32C5D2;"  data-toggle="tooltip" data-placement="top" title="Edit Question"> <i class = "fa fa-pencil"></i> </a></td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="Manage-Questions.php?del=<?php echo $row['Question_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Question"> <i class = "fa fa-times"></i> </a> </td>
                    </tr>
                
                <?php $i++; }} 
                else{
                    echo "<h2> No Questions Available ! </h2> ";
                    echo "<br>";
                    }
                    }
                  
                    ?>
                    </table>
                    </form>
            <!-- END CONTENT BODY -->
            </div>
            </div> 
            	   	  
		</div>
        <!-- END OF DIV CONTENT -->
	</div>
    <!-- END OF DIV ROW -->
</div>
<!-- END OF DIV CONTAINE -->
<?php 
include('./_Partial Components/Footer.php');
?>