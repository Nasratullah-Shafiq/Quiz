var width = 100;
        var diference = 2;
        function timeout(){
            var minute = Math.floor(timeLeft/60);
            var second = timeLeft%60;
            if(timeLeft<=0){
            clearTimeout(tm);
            document.getElementById("QuizAnswer").submit();
        }
        else{
            if(second<10){
                second="0"+second;
            }
            if(minute<=0 && second<10){
                
                document.getElementById("msg").innerHTML=('وقت شما در حال تمام شدن است عجله نمایید.');
            }
            if(minute<=0 && second<2){
                alert('شما در زمان داده شده نتوانستید امتحان را مکمل نمایید');
            }
            if(minute<10){
                minute="0"+minute;
            }
            document.getElementById("Time").innerHTML=minute+":"+second;
         }
         timeLeft--;
         var tm = setTimeout(function(){timeout()},1000);
      }
       