<script>
var mins = 1;
var countDownTime = new Date();
countDownTime.setMinutes(countDownTime.getMinutes() + mins);
var time = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownTime - now;
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
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
    var parsedTest = <?php echo str_replace(array('\n', '\t'), '', $test); ?>;
    if(null !== parsedTest && undefined !== parsedTest && 'object' === typeof(parsedTest)) {
        localStorage.setItem('parsedTest', JSON.stringify(parsedTest));
        var test = JSON.parse(localStorage.getItem('parsedTest'));
        var questions = test.questions;
        localStorage.setItem('testQuestions', JSON.stringify(questions));
        initTestProcess();
    }else {
        clearInterval(time);
        console.error('Cannot parse test data! Contents: ' + parsedTest);
        $('h1').html('');
        $('.question, .test-block, .result-block, .test-info').remove();
        $('.alert-wrap').html('<div class="alert-failure"><span>Неможливо продовжити тестування! Зверніться до адміністратора.</span></div>');
    }
});
</script>
<main>
<div class="home">
    <div class="alert-wrap">
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
            
        </div>
        <div class="result-block">
            <button class="btn-test" id="prev-page" type="button"  disabled><?php echo I18n::get('Previous'); ?></button>
            <button class="btn-test btn-disabled" id="next-page" type="submit" disabled><?php echo I18n::get('Next'); ?></button>
        </div>
        <div style="display:none;" id="template_answer_one">
            <label>
                <input class="radio" type="radio" name="answer" value="var1">
                <span class="radio-custom"></span>
                <div class="label">&lt;ol&gt;</div>
            </label>
        </div>
    </div>
</div>
</main>