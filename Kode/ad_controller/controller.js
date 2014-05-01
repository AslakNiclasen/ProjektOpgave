$(document).ready(function() {
    $.ajax({
        url: "http://localhost/ProjektOpgave/Kode/ad_controller/request.php",
        //url: "http://www.namnam.fo/controller/request.php",
        type: "GET",
        success: function(response) {
            console.log(response);
        }
    });
});