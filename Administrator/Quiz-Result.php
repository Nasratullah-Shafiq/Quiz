
<?php 

include('./_Partial Components/Header.php');
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'./_Partial Components/Users.php');
$usr = new Users();


if(isset($_GET['id'])){
   $User_ID = $_GET['id'];
   $QuizResult = $exm->getQuizResultByID($User_ID);

}
else{
    $QuizResult = $exm->getQuizResult();
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
                <h1> <i class = "fa fa-list"> </i> <small> View Quiz Result </small></h1><hr>
                <ol class="breadcrumb">
                    <li ><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Quiz-Result.php"> <i class = "fa fa-list"></i> Quiz Result </a></li>
                </ol>
            </div>
            <div class = "col-sm-5 text-right pull-right">
                <form class=" "  method="POST">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name ="searchQuizResult" id ="searchQuizResult" autocomplete="off" placeholder="Search for Quiz Result ">
                            <span class="input-group-btn">
                                <button class="btn btn-green"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </form>
            </div>
                <div class="col-md-12" id = "QuizResult">
                 
                  <form method = "POST">
                    <?php 

                    if(!$QuizResult){
                        echo "<br>";
                        echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... This user has not participated in any quiz </div>';
                        echo "<br>";
                    }
                    else{

                    if($QuizResult->num_rows>0){
                           
                    ?>
                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th> Total </th>
                            <th> Username </th>
                            <th> Teacher </th>
                            <th> Subject </th>
                            <th> Attempt </th>
                            <th> Correct </th>
                            <th> Wrong  </th>
                            <th> No Answer </th>
                            <th> Result </th>
                            <th> Date </th>
                            <th> View Result </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                <?php 
                $i=0;
                while($row = $QuizResult->fetch_array()){ ?>
                    <tr>
                        <td> <?php echo $row['TotalNumberOfQuestion'];?> </td>
                        <td> <?php echo $row['Username'];?> </td>
                        <td> <?php echo $row['Teacher'];?> </td>
                        <td> <?php echo $row['Subject'];?> </td>
                        <td> <?php echo $row['Attempted_Answer'];?> </td>
                        <td> <?php echo $row['Correct_Answer']?> </td>
                        <td> <?php echo $row['Wrong_Answer'];?> </td>
                        <td> <?php echo $row['No_Answer'];?> </td>
                        <td> <?php echo $row['Result'].' %';?> </td>
                        <td> <?php echo $row['Submit_Date'];?> </td>
                        <td> <a href = "ViewResult.php?id=<?php echo $row['Result_ID'];?>" style="color: #32C5D2;"> View Result </td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="Delete/DeleteResult.php?del=<?php echo $row['Result_ID'];?>&id=<?php echo $row['User_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Quiz Result"> <i class = "fa fa-times"></i> Delete</a> </td>
                    </tr>
                
                <?php $i++; }} 
                else{
                    echo "<br>";
                    echo '<div class="alert alert-danger" role="alert" style = "font-size: 16px;"> Opps!... This user has not participated in any quiz </div>';
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