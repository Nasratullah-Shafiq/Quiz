<?php

include('./_Partial Components/Header.php');

?>


<div id="myModal" class="modal Myfade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Available Quizez</h4>
        </div>
        <div class="modal-body">
            <?php 
            $Subject = $exm->getSubjects();
            $rows = $Subject->fetch_assoc();
            $SubjectID = $rows['Subject_ID'];
            ?>
            
             <nav class="nav-index-side">
            <?php if(isset($_SESSION['Username'])){ 
                $Username = $_SESSION['Username'];
                $UsersByUsername = $exm->getUsersByUsername($Username);
                $row = $UsersByUsername->fetch_assoc();
                } ?>
                
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
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
        </div>
    </div>
    
    </div>

    <div class="slideshow-container">
    <div class="myslides Myfade">
        <img src="./img/proyectos-de-e-learning.jpg" alt="Shs_Tech_Solutions" id = "slider">
        <div class="text">
            <h1> Online Quiz System </h1>
            <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> Start Quiz Now </button>
        </div>
        
    </div>
    <div class="myslides Myfade">
        <img src="./img/IMG_8177.jpg" alt="Shs_Tech_Solutions" id = "slider">
        <div class="text">
            <h1> Online Quiz System </h1>
            <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> Start Quiz Now </button>
            
        </div>
    </div>
    <div class="myslides Myfade">
        <img src="./img/banner.png" alt="Shs_Tech_Solutions" id = "slider"/>
        <div class="text">
            <h1> Online Quiz System </h1>
             <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> Start Quiz Now </button>
            
        </div>
    </div>
    <div class="myslides Myfade">
      <img src="./img/eLearning-banner-.jpeg" alt="Shs_Tech_Solutions" id = "slider">
        <div class="text">
            <h1> Online Quiz System </h1>
            <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> Start Quiz Now </button>
        </div>
    </div>
    <div class="myslides Myfade">
      <img src="./img/aof-sinav-sonuclari-aciklandi-mi-sinav-sonuclari-nasil-ogrenilir-aof-3-ders-sinavi-ne-zaman_c0c95fce-4ff6-418f-b0ab-59bb7475f7f8.jpg" alt="Shs_Tech_Solutions" id = "slider">
      <div class="text">
        <h1> Online Quiz System </h1>
        <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> Start Quiz Now </button>
      </div>
    </div>
    <br>
    <a class="previous" onclick="pullslides(-1);">&#10094; </a>
    <a class="nextsld" onclick="pushslides(1);">&#10095; </a>
    <div class="dot-symbols">
        <span class = "dots" onclick = "currentslide(1);"></span>
        <span class = "dots" onclick = "currentslide(2);"></span>
        <span class = "dots" onclick = "currentslide(3);"></span>
        <span class = "dots" onclick = "currentslide(4);"></span>
        <span class = "dots" onclick = "currentslide(5);"></span>
    </div>
</div>
    <br>
        <div class = "div-text-about-online">
            <div class = "container">
               <div class="col-md-12">
               <h1 class="text-center" id="text-index-page"> About Online Quiz</h1>
                Online Quiz Portal os the best mode to track the students' capabilities
                and test them in high levels to act their best in the next attack. ONLINE
                QUIZ portal not only looking into the down marks of students. 
                but also assisting the students and educational institute transcend 
                geographical boundries and time restrains in the chore of constant
                evaluation of pupil of functioning. The online Quiz Provides intensive 
                tools to administrator. monitor and grade Quizez online. ONLINE QUIZ is
                primary want for college, Universities, Teachers, Professors, Employess       
                or any one you want to allow to secure content.
               </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div id="imageCarousel" class="carousel Fade" data-ride="carousel" data-interval = "9000">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img alt="First slide" src="img/images-39.jpg" id = "img-carousel">
                                        
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="img/proyectos-de-e-learning.jpg" id = "img-carousel">
                                        
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="img/online-exam.jpg" id = "img-carousel" >
                                        
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                            $(document).ready(function(){
                                $('#imageCarousel1').carousel();
                            });
                            </script>     
                        </div>           
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div id="imageCarousel" class="carousel slideDown" data-ride="carousel" data-interval = "6000">
                                <ol class="carousel-indicators">
                                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img alt="First slide" src="img/images-20.jpg" id = "img-carousel">
                                        
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="img/images-25.jpg" id = "img-carousel">
                                        
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="img/online-examination-system.jpg" id = "img-carousel" >
                                        <!-- <div class="carousel-caption">
                                            <h3> Here you can test yourself skills</h3>
                                            <p> Hello Nasratullah Shafiq how you</p>
                                        </div>
                                          -->
                                    </div>
                                </div>
                            </div>     
                        </div>                  
                    </div>

                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div id="imageCarousel" class="carousel slideDown" data-ride="carousel">
                                <ol class="carousel-indicators">
                                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img alt="First slide" src="img/1.jpg" id = "img-carousel">
                                        <div class="carousel-caption">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="img/images-31.jpg" id = "img-carousel">
                                        <div class="carousel-caption">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="img/images-12.jpg" id = "img-carousel" >
                                        <div class="carousel-caption">
                                        </div>
                                    </div>

                                </div>
                            </div>     
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> 
</div>
             
</div>
    <div id = "topBtn"><i class = "fa fa-arrow-up" ></i></div>

    <script>
var firefoxTestDone = false
function reportFirefoxTestResult(result) {
  if (!firefoxTestDone) {
    $('#ff-bug-test-result')
      .addClass(result ? 'text-success' : 'text-danger')
      .text(result ? 'PASS' : 'FAIL')  
  }
  firefoxTestDone = true
}

$(function () {
  $('.js-popover').popover()
  $('.js-tooltip').tooltip()
  $('#tall-toggle').click(function () {
    $('#tall').toggle()
  })
  $('#ff-bug-input').one('focus', function () {
    $('#myModal2').on('focus', function () {
      reportFirefoxTestResult(false)
    })
    $('#ff-bug-input').on('focus', function () {
      reportFirefoxTestResult(true)
    })
  })
})
</script>

<script type="text/javascript">
  var slideIndex = 1;
  showslides(slideIndex);
  function pushslides(n){
    showslides(slideIndex +=n);
  }
  function pullslides(n){
    showslides(slideIndex -=n);
  }
  function currentslide(n){
    showslides(slideIndex = n);
  }
  function showslides(n){
    var i;
    var slides = document.getElementsByClassName("myslides");
    var dot = document.getElementsByClassName("dots");
    if(n>slides.length){
      slideIndex = 1;
    }
    if(n<1){
      slideIndex = slides.length;
    }
    for(i=0; i<slides.length; i++){
      slides[i].style.display = "none";
    }
    slideIndex++;
    if(slideIndex>slides.length){slideIndex=1};
    for(i=0; i<dot.length; i++){
      dot[i].className = dot[i].className.replace(" active","");
    }
    slides[slideIndex - 1].style.display="block";
    dot[slideIndex - 1].className+=" active";
    setTimeout(showslides,10000);
  }
</script>

<?php
include('./_Partial Components/Footer.php');
?>
