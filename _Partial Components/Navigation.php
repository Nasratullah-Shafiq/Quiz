<?php
//ob_start();
include('conn.php');
$profile = new User;
?>
<nav class="nav-left-side" id = "#nav-left-side">
    
<?php if(isset($_SESSION['Username'])){ 
    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $row = $UsersByUsername->fetch_assoc();
    if($row['Role_ID']=='1'){?>
        <a  href="Administrator/index.php"> <i class='fa fa-tachometer'></i> Manage Quizes </a>
   <?php }}?>

<?php
if(isset($_GET['id'])){ ?>
<a  href="index.php"> <i class='fa fa-home'></i> Home</a>

<?php }else{ ?>
  <a class = "active" href="index.php"> <i class='fa fa-home'></i> Home</a>
 
<?php }?>

<?php
    $allSubject = $exm->getSubjects();

    if($allSubject->num_rows>0){
        if($row['Status']=='1'){
        while($row = $allSubject->fetch_assoc()){
            if(isset($_GET['id']) && $row['Subject_ID']==$_GET['id']){
                $SubjectID = $row['Subject_ID'];
                $subject = $row['Subject'];
                echo "<a class = 'active' href = 'ExamDetails.php?id=".$SubjectID."'><i class='fa fa-list'></i> $subject Quiz </a>";
            }
            else{
                $SubjectID = $row['Subject_ID'];
                $subject = $row['Subject'];
                echo "<a  href = 'ExamDetails.php?id=".$SubjectID."'><i class='fa fa-list'></i> $subject Quiz </a>";
            }
        }
    }
}
    else{
        echo "<center> <h3><p> No Subjects Yet </p></h3> </center>";
    }

?>



</nav>


