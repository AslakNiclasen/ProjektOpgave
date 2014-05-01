<!DOCTYPE html>
<html>
    <head>
        <title>Ulandsnyt.dk</title>
        <script src="//code.jquery.com/jquery-latest.min.js"></script>
        <script src="//localhost/ad_controller/controller.js"></script>
        <style type="text/css">
            body {
                background-color: #fff;
            }
        
            .wrapper {
                background: url('background.png') no-repeat;
                margin: 0px auto;
                height: 2050px;
                width: 950px;
                z-index: 10;
            }
            
            .reklame_container {
                position: absolute;
                top: 258px;
                height: 270px;
                width: 950px;
            }
            
            .reklame {
                background-color: red;
                width: 230px;
                height: 130px;
                margin-right: 10px;
                margin-bottom: 10px;
                float: left;
                cursor: pointer;
            }
            
            .no-margin {
                margin-right: 0px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="reklame_container">
                <div class="reklame">&nbsp;</div>
                <div class="reklame">&nbsp;</div>
                <div class="reklame">&nbsp;</div>
                <div class="reklame no-margin">&nbsp;</div>
                <div class="reklame">&nbsp;</div>
                <div class="reklame">&nbsp;</div>
                <div class="reklame">&nbsp;</div>
                <div class="reklame no-margin">&nbsp;</div>
            </div>
        </div>
    </body>
</html>