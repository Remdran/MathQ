var score = 0;

$("#submitBtn").click(function () {
    $.ajax({
        method: "POST",
        url: "actions.php?action=checkAnswer",
        data: "answer=" + $("#userAnswer").val() + "&Qid=" + $(".questionP").attr("data-id"),
        success: function(result) {
            if (result == 1) {
                score++;
                $(".score").html("Score: " + score);
                $(".qWrong").hide();
                newQuestion();
            } else if (result == 0) {
                $(".qWrong").show();
            } else {
                $(".qWrong").html("An error has occured").show();
            }
        }
    })      
});

$(".nextQ").click(function () {
    newQuestion();
});

function newQuestion() {
    $.ajax({
        method: "POST",
        url: "actions.php?action=newQ",
        data: "",
        success: function(result) {
            $(".question").html(result);
        }
    })     
}

$("#reset").click(function () {
    $.ajax({
        method: "POST",
        url: "actions.php?action=logout",
        data: "",
        success: function(result) {
            score = 0;
            location.reload();
        }
    })      
}); 