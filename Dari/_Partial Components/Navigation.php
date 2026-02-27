<?php
//ob_start();
include('conn.php');
$profile = new User;
?>
<nav class="nav-right-side">	
<?php
if(isset($_GET['id'])){ ?>
<a style = "text-align: right;" href="index.php">  صفحه اصلی <i class='fa fa-home'></i></a>

<?php }else{ ?>
  <a style='text-align: right;' class = "active" href="index.php">  صفحه اصلی <i class='fa fa-home'></i></a>
 
<?php }?>

<?php
    $allSubject = $exm->getDariSubjects();

    if($allSubject->num_rows>0){

        while($sub = $allSubject->fetch_assoc()){
            if(isset($_GET['id']) && $sub['Subject_ID']==$_GET['id']){
                $SubjectID = $sub['Subject_ID'];
                $subject = $sub['Subject'];
                echo "<a style='text-align: right;' class = 'active' href = 'ExamDetails.php?id=".$SubjectID."'>  امتحان $subject  <i class='fa fa-list-alt'></i></a>";
            }
            else{
                $SubjectID = $sub['Subject_ID'];
                $subject = $sub['Subject'];
                echo "<a style='text-align: right;'  href = 'ExamDetails.php?id=".$SubjectID."'> امتحان $subject   <i class='fa fa-list-alt'></i></a>";
            }
        }
    }
    else{
        echo "<center> <h3><p> مضمون وجود ندارد</p></h3> </center>";
    }
?>
</nav>


