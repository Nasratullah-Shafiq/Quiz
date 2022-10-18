
<?php include('./_Partial Components/Header.php');

?>
<?php $Teacher = $exm->getTeacher();
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
                <h1 style = "color: #2C3E50"> <i class = "fa fa-home"> </i> <small> Add Faculty </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Manage-Faculty.php"> <i class = "fa fa-home"></i> Manage Faculty </a></li>
                </ol>
            </div>
            <div class="col-md-9">
    <!-- END CONTENT BODY -->

          <form class="form-horizontal" action = "" method = "POST">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2"> Faculty </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="Faculty" placeholder="Faculty">
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
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn button-start-the-quiz" id = "btn-add-faculty" style = "width: 200px;"> Add Faculty </button>
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