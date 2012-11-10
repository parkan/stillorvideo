<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Real music video or static cover shot?</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>

        <script src="js/vendor/modernizr-2.6.1.min.js"></script>
    </head>
    <body>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
        <script src="js/okvideo/src/okvideo.js"></script>
        <script type="text/javascript">  
        /*
            var video='AuG9i5cwGW0';
            var still='bteY_fs3Y18';
            $(function(){
                $.okvideo({ video: video });
            });
         */
        function shift_halves(percent_video){
            // hide text
            if(percent_video > 50){
                $("#text-still").fadeOut(200);
            } else {
                $("#text-video").fadeOut(200);
            }
            
            // shift centerline 
            var percent_still = 100 - percent_video;
            $('#half-video').animate({ width : percent_video + '%' });
            $('#half-still').animate({ left: percent_video + '%', width : percent_still + '%' });

            // show text if previously hidden
            if(percent_video > 50){
                $("#text-video").fadeIn(900);
            } else {
                $("#text-still").fadeIn(900);
            }
        }
        </script>
        <div id="box-or" style="position:fixed; top:50%; left:50%; width:100px; height=20px;">
        OR
        </div>
        <div style="position:fixed;left:0;top:0;overflow:hidden;z-index:-998;height:100%;width:100%;"></div>
        <div id="half-video" style="position:fixed;left:0;top:0;overflow:hidden;z-index:-98;height:100%;width:50%;">
            <div id="text-video-container" style="position:fixed;left:0;top:0;overflow:hidden;height:100%;width:50%;">
                <span id='text-video' class='text-which'>Real music video</span>
            </div>
            <iframe frameborder="0" allowfullscreen="" id="okplayer" style="position:fixed;left:-50%;top:0;overflow:hidden;z-index:-999;height:200%;width:200%;" title="YouTube video player" height="390" width="640" src="http://www.youtube.com/embed/AuG9i5cwGW0?autohide=1&amp;autoplay=1&amp;cc_load_policy=0&amp;controls=0&amp;enablejsapi=1&amp;fs=0&amp;iv_load_policy=1&amp;loop=1&amp;showinfo=0&amp;rel=0&amp;wmode=opaque&amp;hd=1&amp;origin=http%3A%2F%2Fark.dev.hypem.com"></iframe>
        </div>
        <div id="half-still" style="position:fixed;left:50%;top:0;overflow:hidden;z-index:-98;height:100%;width:50%; border-left: 1px solid white;">
            <div id="text-still-container" style="position:fixed;left:50%;top:0;overflow:hidden;height:100%;width:50%;">
                <span id='text-still' class='text-which'>Static album art</span>
            </div>
            <iframe frameborder="0" allowfullscreen="" id="okplayer" style="position:fixed;left:-50%;top:0;overflow:hidden;z-index:-999;height:200%;width:200%;" title="YouTube video player" height="390" width="640" src="http://www.youtube.com/embed/bteY_fs3Y18?autohide=1&amp;autoplay=1&amp;cc_load_policy=0&amp;controls=0&amp;enablejsapi=1&amp;fs=0&amp;iv_load_policy=1&amp;loop=1&amp;showinfo=0&amp;rel=0&amp;wmode=opaque&amp;hd=1&amp;origin=http%3A%2F%2Fark.dev.hypem.com"></iframe>
        </div>
    </body>
</html>
