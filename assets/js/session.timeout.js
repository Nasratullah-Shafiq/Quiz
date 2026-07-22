let timeout = 15 * 60 * 1000; // 15 minutes

let timer;

function resetTimer() {

    clearTimeout(timer);

    timer = setTimeout(function () {

        window.location.href = "../Logout.php?reason=timeout";

    }, timeout);

}

[
'load',
'mousemove',
'mousedown',
'click',
'scroll',
'keypress',
'touchstart'
].forEach(function(event){

    window.addEventListener(event, resetTimer, true);

});

resetTimer();