<script>
var mins = 1;
var countDownTime = new Date();
countDownTime.setMinutes(countDownTime.getMinutes() + mins);
var distance = 0;
var time = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownTime - now;
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    if (hours < 10) {
        var hours = "0" + hours;
    }
    if (minutes < 10) {
        var minutes = "0" + minutes;
    }
    if (seconds < 10) {
        var seconds = "0" + seconds;
    }
    document.getElementById("test-time").innerHTML = hours + ":" + minutes + ":" + seconds;
    mins-=1;
    if (distance <= 0) {
    document.getElementById("test-time").innerHTML = '00:00:00';
    stopTimer();
    document.getElementById("test-time").style = 'color:red;';
  }
}, 300);
function stopTimer(){
    clearInterval(time);
    localStorage.timeResult = document.getElementById("test-time").innerHTML;
}
document.addEventListener('DOMContentLoaded', function(){
    var parsedTest = JSON.parse('<?php echo $test; ?>');
    if(parsedTest) {
        localStorage.setItem('parsedTest', parsedTest);
        var test = localStorage.getItem('parsedTest');
        console.log(test);
    }else {
        console.error('Cannot parse test data!');
    }
});
</script>
<main>
<div class="home">
    <div class="alert-wrap">
        <div class="alert-failure"><span><?php echo I18n::get('Test HTML/CSS damaged'); ?></span></div>
    </div>
    <h1>HTML/CSS</h1>
    <div class="test-wrap">
        <div class="test-info">
            <div class="question-number"><?php echo I18n::get('Question'); ?>: 1/20</div>
            <div class="test-time"><?php echo I18n::get('Time left'); ?>: <p id="test-time"></p></div>
        </div>
        <div class="question">
            <h3>You have to make a numbered list, which of the tags should you use?</h3>
        </div>
        <div class="test-block">
            <form>
            <label>
                <input class="radio" type="radio" name="question" value="var1">
                <span class="radio-custom"></span>
                <div class="label">&lt;ol&gt;</div>
            </label>
            <label>
                <input class="radio" type="radio" name="question" value="var2">
                <span class="radio-custom"></span>
                <div class="label">&lt;tr&gt;</div>
            </label>
            <label>        
                <input class="radio" type="radio" name="question" value="var3">
                <span class="radio-custom"></span>
                <div class="label">&lt;ul&gt;</div>
            </label>
            <label>        
                <input class="radio" type="radio" name="question" value="var4">
                <span class="radio-custom"></span>
                <div class="label">&lt;list&gt;</div>
                
            </label>    
            </form>
        </div>
        <div class="result-block">
            <button class="btn-test" id="prev-page" type="button"  disabled><?php echo I18n::get('Previous'); ?></button>
            <button class="btn-test btn-disabled" id="next-page" type="submit" disabled><?php echo I18n::get('Next'); ?></button>
        </div>
    </div>
</div>
</main>