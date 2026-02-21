<?php

include('./_Partial Components/Header.php');
?>
  <div id="myModal" class="modal Myfade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close "style="float: left;" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-right" id="myModalLabel"> امتحانات موجود </h4>
        </div>
        <div class="modal-body">
            <?php 
            $Subject = $exm->getSubjects();
            $rows = $Subject->fetch_assoc();
            $SubjectID = $rows['Subject_ID'];
            ?>
            
            <nav class="nav-index-side">  
                <?php 
                    if(isset($_SESSION['Username'])){ 
                        $Username = $_SESSION['Username'];
                        $UsersByUsername = $exm->getUsersByUsername($Username);
                        $rows = $UsersByUsername->fetch_assoc();
                    }

                    $allSubject = $exm->getDariSubjects();

                    if($allSubject->num_rows>0){
                      if($rows['Status']=='1'){
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
                }
                else{
                    echo "<center> <h3><p> مضمون وجود ندارد</p></h3> </center>";
                }
                ?>
            </nav>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> بسته شود </button>
        </div>
        </form>
        </div>
    </div>
    
    </div>
  <div class="slideshow-container">
    <div class="myslides Myfade">
      <img src="../img/aof-sinav-sonuclari-aciklandi-mi-sinav-sonuclari-nasil-ogrenilir-aof-3-ders-sinavi-ne-zaman_c0c95fce-4ff6-418f-b0ab-59bb7475f7f8.jpg" alt="Shs_Tech_Solutions" id = "slider">
      <div class="text">
        <h1 style="font-family: Calibri;"> سیستم امتحان دهی آنلاین </h1>
        <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> امتحان آغاز شود </button>
      </div>
    </div>
    <div class="myslides Myfade">
      <img src="../img/banner.png" alt="Shs_Tech_Solutions" id = "slider">
      <div class="text">
        <h1 style="font-family: Calibri;"> سیستم امتحان دهی آنلاین </h1>
        <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> امتحان آغاز شود </button>
      </div>
    </div>
    <div class="myslides Myfade">
      <img src="../img/eLearning-banner-.jpeg" alt="Shs_Tech_Solutions" id = "slider">
      <div class="text">
        <h1 style="font-family: Calibri;"> سیستم امتحان دهی آنلاین </h1>
        <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> امتحان آغاز شود </button>
      </div>
    </div>
    <div class="myslides Myfade">
      <img src="../img/IMG_8177.jpg" alt="Shs_Tech_Solutions" id = "slider">
      <div class="text">
        <h1 style="font-family: Calibri;"> سیستم امتحان دهی آنلاین </h1>
        <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> امتحان آغاز شود </button>
      </div>
    </div>
    <div class="myslides Myfade">
      <img src="../img/aof-sinav-sonuclari-aciklandi-mi-sinav-sonuclari-nasil-ogrenilir-aof-3-ders-sinavi-ne-zaman_c0c95fce-4ff6-418f-b0ab-59bb7475f7f8.jpg" alt="Shs_Tech_Solutions" id = "slider">
      <div class="text">
        <h1 style="font-family: Calibri;"> سیستم امتحان دهی آنلاین </h1>
        <button type="buttom" class="btn-send" data-toggle="modal" data-target="#myModal"> امتحان آغاز شود </button>
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
           <div class="col-sm-12 text-center"style = "flaot: right;">
           <h1> در مورد امتحان آنلاین </h1>
            <p class="paragraphDr">
                سیستم امتحان دهی آنلاین توسط نصرت الله شفیق و مصطفی کمال طراحی و دیزاین شده است.
                این سیستم در مجموع در دو قمست طراحی شده که یک قسمت آن مربوط محصلین و قسمت دوم آن مربوط مدیر این ویبسایت می باشد.
                <br> قسمت اول: در این قسمت محصلین می تواند در امتحان که توسط استاد مربوط برایش اجازه داده می شود اشتراک نماید.
                <br> قسمت دوم: مدیر این ویب سایت صلاحیت صد فیصد کنترول امتحانات را دارد که قرار ذیل می باشد.
                <br>
                  درج کردن سوالات
                <br>
                  درج کردن پوهنځی ها 
                <br>
                 درج کردن معلمین
                <br>
                  درج کردن سوالات
                <br>
                  درج کردن یوزر ها
                <br>
                  حذف کردن مضامین
                <br>
                  حذف کردن پوهنځی ها
                <br>
                  حذف کردن معلمین
                <br>
                  حذف کردن سوالات
                <br>
            </p>
           </div>
           <div class="col-sm-3" style="float: left;">
               
           </div>
           </div>
        </div>
        <!-- </div> -->
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
                                        <img alt="First slide" src="../img/images-39.jpg" id = "img-carousel">
                                        
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="../img/proyectos-de-e-learning.jpg" id = "img-carousel">
                                       
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="../img/online-exam.jpg" id = "img-carousel" >
                                       
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
                                        <img alt="First slide" src="../img/images-20.jpg" id = "img-carousel">
                                        
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="../img/images-25.jpg" id = "img-carousel">
                                        
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="../img/online-examination-system.jpg" id = "img-carousel" >
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
                                        <img alt="First slide" src="../img/1.jpg" id = "img-carousel">
                                        <div class="carousel-caption">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="../img/images-31.jpg" id = "img-carousel">
                                        <div class="carousel-caption">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img alt="Second slide" src="../img/images-12.jpg" id = "img-carousel" >
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
    </div><script type="text/javascript">
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
