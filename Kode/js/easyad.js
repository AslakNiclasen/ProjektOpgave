function hideFeedback() {
    setTimeout(function() {
        $("#feedback_status").fadeOut("slow");
    }, 5000);
}

function showFeedback(status, msg) {
    if (status == "OK") {
        $("#feedback_status").removeClass().addClass("alert alert-success");
    } else if (status == "NOT_OK") {
        $("#feedback_status").removeClass().addClass("alert alert-danger");
    } else {
        if (status != "") {
            $("#feedback_status").removeClass().addClass("alert alert-warning");
        }
    }
    
    $("#feedback_msg").html(msg);
    $("#feedback_status").show().hide().fadeIn("fast");
    
    hideFeedback();
}

$(document).ready(function() {
    hideFeedback();
    
    $(".left-sidebar").css({
        "min-height": $(document).height()-72+"px"
    });
    
    $(".content-wrapper").css({
        "min-height": $(document).height()-72+"px"
    });
});