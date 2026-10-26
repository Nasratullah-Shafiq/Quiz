
<?php include('./_Partial Components/Header.php');

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
                <h1 style = "color: #2C3E50"> <i class = "fa fa-user-plus"> </i> <small> Add Teacher </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Manage-Teacher.php"> <i class = "fa fa-user"></i> Manage Teacher </a></li>
                </ol>
            </div>
            
            <div class="col-md-9">
       <!-- END CONTENT BODY -->

          <form class="form-horizontal" method="POST" action="">
            <div class="form-group">
              <label for="Teacher" class="col-sm-2">Teacher</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="Teacher_Name" placeholder="Teacher">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="Email" placeholder="Email">
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
              <label for="input Gender" class="col-sm-2"> Gender </label>
              <div class="col-sm-10">
                <select name="Gender" class="form-control" id = "Gender">
                <option value="Male"> Male </option>
                <option value="Female"> Female </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="input Phone No" class="col-sm-2"> Phone No </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="Mobile_No" placeholder="Phone No">
              </div>
            </div>
            <div class="form-group">
              <label for="input Time" class="col-sm-2"> Time </label>
              <div class="col-sm-10">
                <select name="Time" class="form-control" id = "Time">
                <option value="Morning"> Morning </option>
                <option value="Evining"> Evining </option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="button-start-the-quiz" id = "btn-add-teacher" style = "width: 200px;"> Add Teacher </button>
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