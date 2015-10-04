<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery Theme - Jssor Slider, Carousel, Slideshow with Javascript Source Code</title>
</head>
<style>
/*Jssor*/
*{margin:0;padding:0;outline:0}html,body{height:100%;background:#fff}body,a{font:normal 16px Helvetica,Verdana,Geneva,sans-serif;color:#3f3f3f}.headercontainer{display:block;margin:0 auto;margin:0 auto;background:#fff;z-index:1000;position:relative;width:100%;top:0;left:0;border-bottom:1px solid #51c1f1}.headercontainer:after{content:'';display:block;clear:both}.headerspace{height:1px}.footer{margin:0 auto;height:60px;padding:0 0;background:#bbbfbf;font-size:12px;width:100%;border-top:1px solid #51c1f1}@media only screen and (max-width:480px){.copyright{display:none}}@media only screen and (min-width:769px){.headercontainer{position:fixed}.headerspace{height:41px}}body{-webkit-animation:bugfix infinite 1s;-webkit-font-smoothing:antialiased}@-webkit-keyframes bugfix{from{padding:0;}to{padding:0;}}.header{position:relative;top:0;left:0;margin:0 auto}#toggle,.toggle{display:none}.menu>li{list-style:none;float:left}.clearfix:before,.clearfix:after{display:table;content:""}.clearfix:after{clear:both}@media only screen and (max-width:768px){.menu{display:none;opacity:0;width:100%;position:absolute;right:0}.menu>li{display:block;width:100%;margin:0}.menu>li>a{display:block;width:100%;text-decoration:none;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.toggle{display:block;position:relative;cursor:pointer;-webkit-touch-callout:none;-webkit-user-select:none;user-select:none;margin-top:5px}#toggle:checked~.menu{display:block;opacity:1}}.header{min-height:40px;max-width:940px;height:100%;padding:0 20px;background:#f0f0f0}.header>.logo{float:left;padding:0 0 0 5px;font-style:italic;font-size:28px;line-height:40px}.nav{display:block;float:right;text-align:right}.nav,.menu,.menu>li,.menu>li>a{height:100%}.menu>li>a{display:block;padding:12px 20px;text-decoration:none;font-weight:normal;font-size:16px;line-height:1;color:#3f3f3f;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-transition:all .25s linear;-moz-transition:all .25s linear;-o-transition:all .25s linear;transition:all .25s linear}.menu>li>a:hover,.menu>li>a:focus{background:#f2f2f2;box-shadow:inset 0 5px #51c1f1;color:#51c1f1;background-color:#fff}.menu>li>a.current{color:#51c1f1}.toggle{z-index:2}@media only screen and (max-width:820px){.menu{background:#f0f0f0;border-top:1px solid #51c1f1}.menu,.menu>li,.menu>li>a{height:auto}.menu>li>a{padding:15px 15px;text-align:center;background-color:#f9f9f9;border-bottom:1px solid #51c1f1}.menu>li>a:hover,.menu>li>a:focus{background:#f2f2f2;box-shadow:inset 5px 0 #51c1f1;padding:15px 15px 15px 25px}.toggle:after{content:'';display:block;width:36px;height:30px;margin:0 0;padding:0 0;background:#222;-webkit-border-radius:2px;border-radius:2px;text-align:center;font-size:13px;color:#fff;-webkit-transition:all .5s linear;-moz-transition:all .5s linear;-o-transition:all .5s linear;transition:all .5s linear;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.toggle:hover:after{background:#45abd6}#toggle:checked+.toggle:after{content:''}.toggle .icon-bar{display:block;position:absolute;top:0;left:7px;width:22px;height:2px;background-color:#fff}}.share-icon{display:inline-block;float:left;margin:4px;width:32px;height:32px;cursor:pointer;vertical-align:middle;background-image:url(../img/share/share-icons.png)}.share-facebook{background-position:0 0}.share-facebook:hover{background-position:0 -40px}.share-twitter{background-position:-40px 0}.share-twitter:hover{background-position:-40px -40px}.share-pinterest{background-position:-80px 0}.share-pinterest:hover{background-position:-80px -40px}.share-linkedin{background-position:-240px 0}.share-linkedin:hover{background-position:-240px -40px}.share-googleplus{background-position:-120px 0}.share-googleplus:hover{background-position:-120px -40px}.share-stumbleupon{background-position:-360px 0}.share-stumbleupon:hover{background-position:-360px -40px}.share-email{background-position:-320px 0}.share-email:hover{background-position:-320px -40px}.ad_title_share{position:relative;top:5px;width:160px;height:80px;margin-left:22px}.share-icons-sidebar{position:fixed;display:block;top:110px;left:0;width:40px;height:240px}@media only screen and (max-width:1080px){.ad_title_share{display:none}.share-icons-sidebar{display:none}}.ad_top,.ad_bill{position:relative;margin:0 auto;top:0;left:0;padding:0;width:320px;height:50px;overflow:hidden}.ad_title_banner{width:320px;height:50px;position:relative;top:0;padding:0;overflow:hidden;margin:0 auto}.ad_space{height:0}.ad_title{position:relative;margin:0 auto;padding:0;width:100%;max-width:980px;height:50px;background-color:#f0f0f0}.ad_title_caption{display:none}.ad_rect{position:absolute;padding:10px;top:-10px;left:-10px;width:300px;height:250px}.ad_rect:hover{}.ad_hint{position:absolute;left:-10px;top:-10px;width:22px;height:15px;color:#fff;background-color:#edb802;font-size:13px;text-align:center;border-radius:2px;z-index:1}@media only screen and (min-width:727px){.ad_top,.ad_title_banner{width:728px;max-width:100%;height:90px}.ad_bill{width:970px;max-width:100%;height:250px}.ad_space{height:20px}.ad_title{height:90px}}@media only screen and (min-width:980px){.ad_title_banner{position:absolute;right:20px}.ad_title_caption{display:block}}.sidebar_1{position:relative;display:block;float:left;top:0;margin:15px 10px 10px -10px;padding:0;width:320px;overflow:hidden}@media only screen and (max-width:979px){.sidebar_1{width:640px;margin:10px auto;float:none}}@media only screen and (max-width:639px){.sidebar_1{width:320px;float:none}}a:link{color:#fff;text-decoration:none}a:visited{color:#ff8400;text-decoration:none}a:hover{color:#fff;text-decoration:underline}a:active{color:#fff;text-decoration:underline}a:visited.nav{color:#ff8400}a:link.nav{color:#fff}a:hover.nav,a:active.nav{color:#fff}a:link.featurenav,a:visited.featurenav{color:#fff}a:hover.featurenav,a:active.featurenav{color:#0080ff}.backGreen{background-image:url(../img/site/back-green.png)}.backBlackGreen{background-image:url(../img/site/back-blackgreen.png)}.backBlack{background-image:url(../img/site/back-black.png)}.backWhite{background-image:url(../img/site/back-white.png)}.backBlue{background-image:url(../img/site/back-blue.png)}.thumb{position:relative;top:0;left:0;float:left;display:inline;margin:10px;width:300px;height:250px;-webkit-box-shadow:1px 1px 5px 0 rgba(109,109,109,.3);-moz-box-shadow:1px 1px 5px 0 rgba(109,109,109,.3);box-shadow:1px 1px 5px 0 rgba(109,109,109,.3)}.thumbb,a.thumbb{position:absolute;left:-1px;top:-1px;width:302px;height:252px;color:#000;background-color:#ccc}a.thumbb:visited{color:#ff8400}.thumbb:hover,a.thumbb:hover{color:#fff;background-color:#ff8400}.thumbi{position:absolute;left:1px;top:36px;width:300px;height:215px;line-height:211px;text-align:center;background-color:#f6f6f6;background-position:center center;background-repeat:no-repeat}.thumbi img{vertical-align:middle;border:none}.thumbc{position:absolute;left:1px;top:1px;width:300px;height:35px;background-color:#eaeaea}a.thumbb:hover .thumbc{background-color:#ff8400}.thumbc{font-size:18px;line-height:35px;text-align:center}.thumb_wrapper{position:relative;margin:10px auto;padding:0;width:100%;max-width:960px;overflow:hidden}.reserve_sidebar_space{float:none}@media only screen and (min-width:960px){.reserve_sidebar_space{max-width:640px;float:left;margin:10px}}@media only screen and (max-width:959px){.thumb_wrapper{max-width:640px}}@media only screen and (max-width:639px){.thumb_wrapper{max-width:320px}}A.effectButton,A.effectButton:active,A.effectButton:visited,A.navDev,A.navDev:active,A.navDev:visited{display:block;font-size:13px;line-height:26px;text-align:center;background-color:#dadada;color:#eb5100;text-decoration:none;padding:3px 10px 3px 10px;display:inline;white-space:nowrap}A.effectButton:hover,A.navDev:hover{color:#eaeaea;background-color:#eb5100}A.navDev,A.navDev:active,A.navDev:visited,A.navDev:hover{left:0;width:255px;line-height:26px;padding:0 5px 0 5px;display:inline-block;text-align:left}.captionOrange,.captionBlue,.captionBlack,.captionSymbol{display:block;color:#fff;font-size:20px;line-height:30px;text-align:center;border-radius:4px}.captionOrange{background:#eb5100;background-color:rgba(235,81,0,.6)}.captionBlue{background:#746fbd;background-color:rgba(21,21,120,.6)}.captionBlack{background:#000;background-color:rgba(0,0,0,.4)}.captionSymbol{border-radius:100px!important;font-weight:400!important;font-size:26px!important;background:#000;background-color:rgba(0,0,0,.4)}.captionTextBlack{display:block;color:#000;font-size:20px;line-height:30px}.captionTextWhite{display:block;color:#fff;font-size:20px;line-height:30px}a.captionOrange,a.captionOrange:active,a.captionOrange:visited,a.captionTextWhite,a.captionTextWhite:active,a.captionTextWhite:visited{color:#fff;text-decoration:none}a.captionOrange:hover{color:#eb5100;text-decoration:underline;background-color:#eee;background-color:rgba(238,238,238,.7)}a.captionTextBlack,a.captionTextBlack:active,a.captionTextBlack:visited{color:#000;text-decoration:none}a.captionTextWhite:hover{color:#eb5100;text-decoration:underline}a.captionTextBlack:hover{color:#eb5100;text-decoration:underline}.bricon{background:url(../img/browser-icons.png)}@media only screen and (max-width:980px){.qr_code{display:none}}.feature{position:relative;float:left;display:table;margin:20px;width:280px;height:180px;background-image:url(../img/site/back-blue.png)}.featurec{position:relative;width:100%;text-align:center;font-size:18px;line-height:30px;color:#fff;background-image:url(../img/site/back-black.png)}.featuret{position:relative;height:100%;margin:10px;color:#fff;font-size:13px;line-height:26px}.description{position:relative;margin:0 auto;margin:5px;top:0;left:0;width:690px}.descriptiont{position:relative;width:670px;color:#000;font-size:13px;line-height:20px;overflow:auto;padding:5px}.optiontable{position:relative;color:#000;font-size:13px;background-color:#f0f0f0;table-layout:fixed;word-wrap:break-word}.optiontable td,.optiontable tr{height:24px;line-height:21px;vertical-align:top;border-bottom:1px dashed #888}.optiontable td{padding-left:2px}body{-webkit-font-smoothing:antialiased}.jssora05l,.jssora05r{display:block;position:absolute;width:40px;height:40px;cursor:pointer;background:url(../img/a17.png) no-repeat;overflow:hidden}.jssora05l{background-position:-10px -40px}.jssora05r{background-position:-70px -40px}.jssora05l:hover{background-position:-130px -40px}.jssora05r:hover{background-position:-190px -40px}.jssora05l.jssora05ldn{background-position:-250px -40px}.jssora05r.jssora05rdn{background-position:-310px -40px}.jssort02{position:absolute;width:240px;height:480px}.jssort02 .p{position:absolute;top:0;left:0;width:99px;height:66px}.jssort02 .t{position:absolute;top:0;left:0;width:100%;height:100%;border:none}.jssort02 .w{position:absolute;top:0;left:0;width:100%;height:100%}.jssort02 .c{position:absolute;top:0;left:0;width:95px;height:62px;border:#000 2px solid;box-sizing:content-box;background:url(../img/t01.png) -800px -800px no-repeat;_background:none}.jssort02 .pav .c{top:2px;_top:0;left:2px;_left:0;width:95px;height:62px;border:#000 0 solid;_border:#fff 2px solid;background-position:50% 50%}.jssort02 .p:hover .c{top:0;left:0;width:97px;height:64px;border:#fff 1px solid;background-position:50% 50%}.jssort02 .p.pdn .c{background-position:50% 50%;width:95px;height:62px;border:#000 2px solid}* html .jssort02 .c,* html .jssort02 .pdn .c,* html .jssort02 .pav .c{width:99px;height:66px}
</style>

<body>
    <!-- it works the same with all jquery version from 1.x to 2.x -->
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <!-- use jssor.slider.mini.js (40KB) instead for release -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="js/jssor.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>
    <script>

        jQuery(document).ready(function ($) {

            var _SlideshowTransitions = [
            //Fade in L
                {$Duration: 1200, x: 0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out R
                , { $Duration: 1200, x: -0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade in R
                , { $Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out L
                , { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in T
                , { $Duration: 1200, y: 0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out B
                , { $Duration: 1200, y: -0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade in B
                , { $Duration: 1200, y: -0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out T
                , { $Duration: 1200, y: 0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade in TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in LR Chess
                , { $Duration: 1200, y: 0.3, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out LR Chess
                , { $Duration: 1200, y: -0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade in TB Chess
                , { $Duration: 1200, x: 0.3, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out TB Chess
                , { $Duration: 1200, x: -0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

            //Fade in Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
            //Fade out Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }

            //Fade Clip in H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip in V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>
    <div class="headercontainer" style="z-index:1000;">
<div class="header clearfix">
<span class="logo">Jssor Slider</span>
<div class="nav">
<input type="checkbox" id="toggle">
<label for="toggle" class="toggle" onclick="">
<span class="icon-bar" style="top:7px;"></span>
<span class="icon-bar" style="top:14px;"></span>
<span class="icon-bar" style="top:21px;"></span>
</label>
<ul class="menu">
<li><a href="./">Home</a></li>
<li><a class="current" href="">Photp</a></li>
<li><a href="resume.php">Resume</a></li>
<li><a href="#">Development</a></li>
<li><a href="#">Download</a></li>
<li><a href="#">Support</a></li>
</ul>
</div>
</div>
</div>
<div class="headerspace"></div>
<div style="height:20px;"></div> 
    <!-- Jssor Slider Begin -->
    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 800px;
        height: 456px; background: #191919; overflow: hidden; margin:0 auto;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 356px; overflow: hidden;">
            <?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include("lib/xmllib.php");

if (file_exists(DATABASE)) {
    $mySimpleXml = new MySimpleXml(DATABASE,0);
    $xmlTreeHead = $mySimpleXml->MySimpleXml_load_file();
    $xmlTreeArray = $mySimpleXml->MySimpleXml_generate_xml_array();
    //print_r($xmlTreeArray["root"]);
    if (!empty($xmlTreeArray["root"]["photo"])) {
        if(isset($xmlTreeArray["root"]["photo"][0])){
            foreach($xmlTreeArray["root"]["photo"] as $key => $value){?>
                <div>
                    <img u="image" src="upload/<? echo $value["name"]; ?>" />
                    <img u="thumb" src="upload/<? echo $value["name"]; ?>" />
                </div>
            <?}
        }else{?>
            <div>
                <img u="image" src="upload/<? echo $xmlTreeArray["root"]["photo"]["name"]; ?>" />
                <img u="thumb" src="upload/<? echo $xmlTreeArray["root"]["photo"]["name"]; ?>" />
            </div>
        <?}
    }
} else {
    echo ERROR_DATABASE_NOT_FOUND;
}

?>
        </div>
        <!--#region Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 05 css */
            /*
            .jssora05l                  (normal)
            .jssora05r                  (normal)
            .jssora05l:hover            (normal mouseover)
            .jssora05r:hover            (normal mouseover)
            .jssora05l.jssora05ldn      (mousedown)
            .jssora05r.jssora05rdn      (mousedown)
            */
            .jssora05l, .jssora05r {
                display: block;
                position: absolute;
                /* size of arrow element */
                width: 40px;
                height: 40px;
                cursor: pointer;
                background: url(../img/a17.png) no-repeat;
                overflow: hidden;
            }
            .jssora05l { background-position: -10px -40px; }
            .jssora05r { background-position: -70px -40px; }
            .jssora05l:hover { background-position: -130px -40px; }
            .jssora05r:hover { background-position: -190px -40px; }
            .jssora05l.jssora05ldn { background-position: -250px -40px; }
            .jssora05r.jssora05rdn { background-position: -310px -40px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="top: 158px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="top: 158px; right: 8px">
        </span>
        <!--#endregion Arrow Navigator Skin End -->
        <!--#region Thumbnail Navigator Skin Begin -->
        <!-- Help: http://www.jssor.com/development/slider-with-thumbnail-navigator-jquery.html -->
        <style>
            /* jssor slider thumbnail navigator skin 01 css */
            /*
            .jssort01 .p            (normal)
            .jssort01 .p:hover      (normal mouseover)
            .jssort01 .p.pav        (active)
            .jssort01 .p.pdn        (mousedown)
            */

            .jssort01 {
                position: absolute;
                /* size of thumbnail navigator container */
                width: 800px;
                height: 100px;
            }

                .jssort01 .p {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 72px;
                    height: 72px;
                }

                .jssort01 .t {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border: none;
                }

                .jssort01 .w {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                }

                .jssort01 .c {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 68px;
                    height: 68px;
                    border: #000 2px solid;
                    box-sizing: content-box;
                    background: url(../img/t01.png) -800px -800px no-repeat;
                    _background: none;
                }

                .jssort01 .pav .c {
                    top: 2px;
                    _top: 0px;
                    left: 2px;
                    _left: 0px;
                    width: 68px;
                    height: 68px;
                    border: #000 0px solid;
                    _border: #fff 2px solid;
                    background-position: 50% 50%;
                }

                .jssort01 .p:hover .c {
                    top: 0px;
                    left: 0px;
                    width: 70px;
                    height: 70px;
                    border: #fff 1px solid;
                    background-position: 50% 50%;
                }

                .jssort01 .p.pdn .c {
                    background-position: 50% 50%;
                    width: 68px;
                    height: 68px;
                    border: #000 2px solid;
                }

                * html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {
                    /* ie quirks mode adjust */
                    width /**/: 72px;
                    height /**/: 72px;
                }
        </style>

        <!-- thumbnail navigator container -->
        <div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            <div u="slides" style="cursor: default;">
                <div u="prototype" class="p">
                    <div class=w><div u="thumbnailtemplate" class="t"></div></div>
                    <div class=c></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!--#endregion Thumbnail Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">Bootstrap Slider</a>
    </div>
    <!-- Jssor Slider End -->
</body>
</html>