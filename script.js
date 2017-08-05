$("#submitBtn").click(function () {
    $.ajax({
        method: "POST",
        url: "actions.php?action=checkAnswer",
        data: "answer=" + $("#userAnswer").val() + "&Qid=" + $("#questionP").attr("data-id"),
        success: function(result) {
            alert(result);
        }
    })      
});