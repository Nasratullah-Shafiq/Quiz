
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

					<form action="" method="POST">

					<!-- Subject -->
					<div class="mb-3 d-flex align-items-center">

						<label for="subject" class="form-label me-3 mb-0" style="min-width: 120px;">
						Subject:
						</label>

						<input
						type="text"
						class="form-control"
						id="subject"
						name="subject"
						placeholder="Enter Subject">

					</div>

					<!-- Language -->
					<div class="mb-3 d-flex align-items-center">

						<label for="language" class="form-label me-3 mb-0" style="min-width: 120px;">
						Language:
						</label>

						<select
						class="form-select"
						id="language"
						name="language">

						<option value="English">English</option>
						<option value="Dari">Dari</option>

						</select>

					</div>

					<!-- Credit Hours -->
					<div class="mb-3 d-flex align-items-center">

						<label for="credit_hours" class="form-label me-3 mb-0" style="min-width: 120px;">
						Credit Hours:
						</label>

						<input
						type="text"
						class="form-control"
						id="credit_hours"
						name="credit_hours"
						placeholder="Enter Credit Hours">

					</div>

					<!-- Teacher -->
					<div class="mb-3 d-flex align-items-center">

						<label for="teacher_id" class="form-label me-3 mb-0" style="min-width: 120px;">
						Teacher:
						</label>

						<select class="form-select" id="teacher_id" name="teacher_id">

						<?php 
						$Teacher = $exm->getTeacher();

						if(!$Teacher){
							echo "<option value=''>Teacher table Not Exist!</option>";
						}
						else{
							if($Teacher->num_rows > 0){
								while ($result = $Teacher->fetch_assoc()) {
						?>

							<option value="<?php echo $result['Teacher_ID']; ?>">
							<?php echo $result['Teacher_Name']; ?>
							</option>

						<?php 
								}
							} else {
								echo "<option value=''>Teacher Table is empty</option>";
							}
						}
						?>

						</select>

					</div>

					<!-- Faculty -->
					<div class="mb-3 d-flex align-items-center">

						<label for="faculty_id" class="form-label me-3 mb-0" style="min-width: 120px;">
						Faculty:
						</label>

						<select class="form-select" id="faculty_id" name="faculty_id">

						<?php 
						$Faculty = $exm->getFaculty();

						if(!$Faculty){
							echo "<option value=''>Faculty table Not Exist!</option>";
						}
						else{
							if($Faculty->num_rows > 0){
								while ($result = $Faculty->fetch_assoc()) {
						?>

							<option value="<?php echo $result['Faculty_ID']; ?>">
							<?php echo $result['Faculty']; ?>
							</option>

						<?php 
								}
							} else {
								echo "<option value=''>Faculty Table is empty</option>";
							}
						}
						?>

						</select>

					</div>

					<!-- Status -->
					<div class="mb-3 d-flex align-items-center">

						<label for="status" class="form-label me-3 mb-0" style="min-width: 120px;">
						Status:
						</label>

						<select class="form-select" id="status" name="status">

						<option value="0">Deny</option>
						<option value="1">Allow</option>

						</select>

					</div>

					<!-- Time -->
					<div class="mb-3 d-flex align-items-center">

						<label for="time" class="form-label me-3 mb-0" style="min-width: 120px;">
						Time (sec):
						</label>

						<input
						type="text"
						class="form-control"
						id="time"
						name="time"
						placeholder="Time in seconds">

					</div>

					<!-- Button -->
					<div class="mb-3 d-flex align-items-center">

						<div style="min-width: 120px;"></div>

						<button
						type="submit"
						class="btn btn-primary"
						id="btn-add-subject"
						style="width: 200px;">

						Add Subject

						</button>

						<span id="span-valid" class="text-danger ms-3"></span>

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