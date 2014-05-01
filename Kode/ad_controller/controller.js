$(document).ready(function() {
    $.ajax({
        url: "http://localhost/ad_controller/request.php",
        cache: false,
        datatype: "json",
        type: "GET",
        success: function(response) {
            console.log(response);
        }
    });
});