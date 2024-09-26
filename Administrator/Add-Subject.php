
<?php include('./_Partial Components/Header.php');

?>
<?php $Teacher = $exm->getTeacher();

 ?>
    <div class="container-fluid" style="margin-left: -20px;">
    	<div class="row" id="row">
            <div class="left-side-bar">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                 <?php include('./_Partial Components/Navigation.php');?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END PAGE BAR -->
            <div class="right-side-bar">
            <!-- BEGIN PAGE TITLE-->
            <div class="row">
            <div calss = "col-md-9">
                <h1 style = "color: #2C3E50"> <i class = "fa fa-book"> </i> <small> Add Subject </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Manage-Subject.php"> <i class = "fa fa-book"></i> Manage Subject </a></li>
                </ol>
            </div>
                <div class="col-md-9">
		<!-- END CONTENT BODY -->

					<form class="form-horizontal" action = "" method = "POST">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2">Subject</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="Subject" placeholder="Subject">
							</div>
						</div>
						<div class="form-group">
						  <label for="input Gender" class="col-sm-2"> Language </label>
							<div class="col-sm-10">
							  <select name="Gender" class="form-control" id = "Language">
								<option value="English"> English </option>
								<option value="Dari"> Dari </option>
							  </select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2">Credit Hours</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="Credit_Hours" placeholder="Credit Hours">
							</div>
						</div>
						<div class="form-group">
						  <label for="input Teacher" class="col-sm-2">Teacher</label>
							<div class="col-sm-10">
							  <select name="Teacher ID" class="form-control" id="Teacher_ID">
							  <?php $Teacher = $exm->getTeacher();
								  if(!$Teacher){
									  echo "<option value=''> Teacher table Not Exist! </option>";
									}
									else{
									  if($Teacher->num_rows>0){
										while ($result = $Teacher->fetch_assoc()) { ?>
											  
										<option value="<?php echo $result['Teacher_ID']; ?>"> <?php echo $result['Teacher_Name']; ?> </option>
								<?php }}
									  else{
										echo "<option value=''> Teacher Table is empty </option>"; 
										}} ?>
							  </select>
							</div>
						</div>
						<div class="form-group">
						  <label for="input Teacher" class="col-sm-2"> Faculty </label>
							<div class="col-sm-10">
							  <select name="Teacher_ID" class="form-control" id="Faculty_ID">
							  <?php $Faculty = $exm->getFaculty();
								  if(!$Faculty){
									  echo "<option value=''> Faculty table Not Exist! </option>";
									}
									else{
									  if($Faculty->num_rows>0){
										while ($result = $Faculty->fetch_assoc()) { ?>
											  
										<option value="<?php echo $result['Faculty_ID']; ?>"> <?php echo $result['Faculty']; ?> </option>
								<?php }}
									  else{
										echo "<option value=''> Faculty Table is empty </option>"; 
										}} ?>
							  </select>
							</div>
						</div>
						<div class="form-group">
						  <label for="input Gender" class="col-sm-2"> Status </label>
							<div class="col-sm-10">
							  <select name="Gender" class="form-control" id = "Status">
								<option value="0"> Deny </option>
								<option value="1"> Allow </option>
							  </select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2">Time allow</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="Time" placeholder="Time should givin in seconds">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="button-start-the-quiz" id = "btn-add-subject" style = "width: 200px;"> Add Subject</button>
								<span id="span-valid" class="span-validation"></span>
							</div>
						</div>
					</form>
				</div>
    <!-- END QUICK SIDEBAR -->
</div> 
                	   	  
    		</div>
    	</div>
    </div>

<?php 
include('./_Partial Components/Footer.php');
?>