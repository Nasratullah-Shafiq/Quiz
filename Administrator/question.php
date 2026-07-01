
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
<!-- Add Question Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addQuestionModalLabel">
                    Add New Question
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- Form -->
            <form method="POST" action="">

                <div class="modal-body">

                    <!-- Question -->
                    <div class="mb-3">
                        <label for="Question" class="form-label">
                            Question
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Question"
                            name="Question"
                            placeholder="Enter Question"
                            required>
                    </div>

                    <!-- First Answer -->
                    <div class="mb-3">
                        <label for="Answer0" class="form-label">
                            First Answer
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Answer0"
                            name="Answer0"
                            placeholder="Enter First Answer"
                            required>
                    </div>

                    <!-- Second Answer -->
                    <div class="mb-3">
                        <label for="Answer1" class="form-label">
                            Second Answer
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Answer1"
                            name="Answer1"
                            placeholder="Enter Second Answer"
                            required>
                    </div>

                    <!-- Third Answer -->
                    <div class="mb-3">
                        <label for="Answer2" class="form-label">
                            Third Answer
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Answer2"
                            name="Answer2"
                            placeholder="Enter Third Answer"
                            required>
                    </div>

                    <!-- Fourth Answer -->
                    <div class="mb-3">
                        <label for="Answer3" class="form-label">
                            Fourth Answer
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="Answer3"
                            name="Answer3"
                            placeholder="Enter Fourth Answer"
                            required>
                    </div>

                    <div class="row">

                        <!-- Language -->
                        <div class="col-md-6 mb-3">
                            <label for="Language" class="form-label">
                                Language
                            </label>

                            <select
                                class="form-select"
                                id="Language"
                                name="Language">

                                <option value="English">English</option>
                                <option value="Dari">Dari</option>

                            </select>
                        </div>

                        <!-- Correct Answer -->
                        <div class="col-md-6 mb-3">
                            <label for="Right_Answer" class="form-label">
                                Correct Answer
                            </label>

                            <select
                                class="form-select"
                                id="Right_Answer"
                                name="Right_Answer">

                                <option value="0">First Answer</option>
                                <option value="1">Second Answer</option>
                                <option value="2">Third Answer</option>
                                <option value="3">Fourth Answer</option>

                            </select>
                        </div>

                    </div>

                    <!-- Subject -->
                    <div class="mb-3">
                        <label for="Subject_ID" class="form-label">
                            Subject
                        </label>

                        <select
                            class="form-select"
                            id="Subject_ID"
                            name="Subject_ID">

                            <?php
                            $Subject = $exm->getSubject();

                            if (!$Subject) {
                                echo "<option value=''>Subject table does not exist!</option>";
                            } else {

                                if ($Subject->num_rows > 0) {

                                    while ($result = $Subject->fetch_assoc()) {
                            ?>

                                        <option value="<?php echo $result['Subject_ID']; ?>">
                                            <?php echo $result['Subject']; ?>
                                        </option>

                            <?php
                                    }

                                } else {

                                    echo "<option value=''>Subject table is empty</option>";

                                }
                            }
                            ?>

                        </select>
                    </div>

                    <span id="span-valid" class="text-danger"></span>

                </div>

                <!-- Footer -->
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success"
                        id="btn-add-questions">
                        <i class="bi bi-check-circle"></i>
                        Add Question
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>




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
                    <li class = ""> <a href="#" data-bs-toggle="modal" data-bs-target="#addQuestionModal"> <i class="fa fa-question"></i> Add Questions</a></li>
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
                            <th> No </th>
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
                        <td> <a href="Edit-Questions.php?edit=<?php echo $row['Question_ID'];?>" style="color: #32C5D2;"  data-toggle="tooltip" data-placement="top" title="Edit Question"> <i class = "fa fa-pencil"></i></a></td>
                        <td> <a onclick="return confirm('are you sure you want to delete')" href="Delete/DeleteQuestion.php?del=<?php echo $row['Question_ID'];?>" style="color: #D05454;"  data-toggle="tooltip" data-placement="top" title="Delete Question"> <i class="fa fa-trash"></i></a> </td>
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