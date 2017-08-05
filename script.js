$("#submitBtn").click(function () {
    $.ajax({
        method: "POST",
        url: "actions.php?action=checkAnswer",
        data: "answer=" + $("#userAnswer").val(),
        success: function(result) {
            alert(result);
        }
    })      
});