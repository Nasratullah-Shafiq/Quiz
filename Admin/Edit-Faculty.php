
<?php 
include('./_Partial Components/Header.php');

if(isset($_GET['edit'])){
   $Faculty_ID = $_GET['edit'];
   $FacultyByID = $exm->getFacultyByID($Faculty_ID);
}
else{
   header('Location: ../sign in.php');
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
                <h1 style = "color: #2C3E50"> <i class = "fa fa-home"> </i> <small> Edit Faculty </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Manage-Faculty.php"> <i class = "fa fa-home"></i> Manage Faculty </a></li>
                </ol>
            </div>
            <div class="col-md-9">
             <!-- END CONTENT BODY -->
                    
                    <?php 
                        $FacultyByID = $exm->getFacultyByID($Faculty_ID);
                        $result = $FacultyByID->fetch_assoc();
                    ?>
                    <form class="form-horizontal" method="POST" action="">
                        <div class="form-group" style="display: none;">
                            <label for="Faculty_ID" class="col-sm-2">Faculty_ID</label>
                            <div class="col-sm-10">
                              <input type="text" value="<?php echo $result['Faculty_ID']; ?>" name = "Faculty_ID" class="form-control" id="Faculty_ID" placeholder="Teacher">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Faculty" class="col-sm-2"> Faculty </label>
                            <div class="col-sm-10">
                              <input type="text" value="<?php echo $result['Faculty']; ?>" name = "Faculty" class="form-control" id="Faculty" placeholder="Faculty">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="input language" class="col-sm-2"> Language </label>
                            <div class="col-sm-10">
                              <select name="Language" class="form-control"  name = "Language" id = "Language">
                                <option value="English" <?php if($result['Language']=='English'){echo "selected"; }?> > English </option>
                                <option value="Dari" <?php if($result['Language']=='Dari'){echo "selected"; }?> >  Dari </option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="button-start-the-quiz" name = "submit" id = "btn-edit-faculties" style = "width: 200px;"> Update Faculty </button>
                                <span id="span-valid" style = "padding-left: 3%;" class="span-validation"></span>  
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