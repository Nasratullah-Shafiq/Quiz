
<?php
include('./../_Partial Components/Header.php');

if(isset($_GET['del'])){
   $Result_ID = $_GET['del'];
   $deleteResult = $exm->delQuizResult($Result_ID);
   if($deleteResult){
        $msg = "Quiz Result has deleted Successfully";
   }
   else{
        $error = "Quiz Result Not Deleted!";
   }
}


?>
 <script type="text/javascript">
     window.location = "QuizHistory.php";
 </script>
  