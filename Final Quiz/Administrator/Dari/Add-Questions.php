
<?php include('./_Partial Components/Header.php');

?>
<div class="container-fluid" style="margin-left: 0px; padding-left: 0px;">
    <div class="row" id="row">
            <div class="left-side-bar">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                 <?php include('./_Partial Components/Navigation.php');?>
                <!-- END SIDEBAR -->
            </div>
            <div class="col-sm-9">
            
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div class="row">
            <div calss = "right-side-bar" style="padding-left: 15px;">
                <h1 style = "color: #2C3E50 "> <i class = "fa fa-question"> </i> <small> Add Questions </small></h1><hr>
                <ol class="breadcrumb">
                    <li style="color: #5C9BD1"><a href="index.php"> <i class = "fa fa-tachometer"></i> Dashboard </a></li>
                    <li class = ""> <a href="Manage-Questions.php"> <i class = "fa fa-question"></i> Manage Questions </a></li>
                </ol>
            </div>
            <div class="col-md-9">

                      <form class="form-horizontal" method="POST" action="">
                      
                      <div class="form-group">
                        <label for="inputEmail3" style="text-align: left;" class="col-sm-3 control-label"> Question </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="Question" placeholder="Question">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" style="text-align: left;" class="col-sm-3 control-label">1st Answer</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="Answer0" placeholder="1stAnswer">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label">2nd Answer</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="Answer1" placeholder="2nd Answer">
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label">3rd Answer</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="Answer2" placeholder="3rd Answer">
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label">4th Answer</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="Answer3" placeholder="4th Answer">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="input Gender" class="col-sm-3"> Language </label>
                        <div class="col-sm-9">
                          <select name="Gender" class="form-control" id = "Language">
                          <option value="English"> English </option>
                          <option value="Dari"> Dari </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                          <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label">Correct Answer</label>
                            <div class="col-sm-9">
                              <select name="country" id = "Right_Answer" class="form-control">
                                <option value="0"> First Answer </option>
                                <option value="1"> Second Answer</option>
                                <option value="2"> Third Answer</option>
                                <option value="3"> Fourth Answer</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword3" style="text-align: left;" class="col-sm-3 control-label"> Subject </label>
                            <div class="col-sm-9">
                              <select name="countr" id = "Subject_ID" class="form-control">
                              <?php $Subject = $exm->getSubject();
                                  if(!$Subject){
                                      echo "<option value=''> Subject table Not Exist! </option>";
                                    }
                                    else{
                                      if($Subject->num_rows>0){
                                        while ($result = $Subject->fetch_assoc()) { ?>
                                              
                                        <option value="<?php echo $result['Subject_ID']; ?>"> <?php echo $result['Subject']; ?> </option>
                                <?php }}
                                      else{
                                        echo "<option value=''> Subject Table is empty </option>"; 
                                        }} ?>
                              </select>
                            </div>
                        </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="button-start-the-quiz" id = "btn-add-questions" >Add Questions</button>
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