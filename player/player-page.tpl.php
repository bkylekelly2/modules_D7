<?php
$src = 'http://apollo.collectiveradio.com:8000/live_audio';
$detect = mobile_detect_get_object();
$is_mobile = $detect->isMobile();
$is_tablet = $detect->isTablet();

?>

<style>
.page-title{

	display:none;

}
@import url(http://fonts.googleapis.com/css?family=Raleway:100,400,300,600,500);

html, body
{
    color: #F3F4F5;
    background-color: #181f24;
    font-family: 'Raleway', sans-serif;
    width: 100%;
    height: 100%;
    margin: 0px;
    border: 0;
    overflow: hidden;
}

.container
{
    width: 100%;
}

/* Vertical centering */

.vertical-center
{
    height: 100%;
    width: 100%;
    text-align: center;
    font: 0/0 a;
}

.vertical-center:before
{
    content: ' ';
    display: inline-block;
    padding-top: 0px;
    margin-top: 0px;
    vertical-align: middle;
    height: 100%;
}

.vertical-center > .container
{
    max-width: 100%;
    display: inline-block;
    vertical-align: middle;
    font: 16px/1 "Raleway", Helvetica, Arial, sans-serif;
}

@media (max-width: 768px)
{
    .vertical-center > .container
    {
        max-width: 45%;
        display: inline-block;
        vertical-align: middle;
        font: 16px/1 "Raleway", Helvetica, Arial, sans-serif;
    }
}


.ExpandLibrary
{
    display: inline;
    padding: 5px;
}

/* Main Window Panels */

.leftPanel
{
    text-align: center;
    padding-top: 60px;
    opacity: 0.4;
    margin-left: 5%;
    margin-right: -5%;
}

.rightPanel
{
    text-align: center;
    padding-top: 60px;
    opacity: 0.6;
    margin-left: -5%;
}

.centerPanel
{
    font-size: 18px;
    padding-left: 0px;
    padding-right: 0px;
}

/* font styles */

.trackTitle
{
    color: white;
    font-weight: 600;
    padding-top: 10px;
    padding-bottom: null;
}

.trackDetails
{
    margin-top: -2px;
    color: #a5a5a5;
    font-weight: 600;
}

.trackLight
{
    color: #a5a5a5;
    font-weight: 300;
}

.smallText
{
    font-size: 14px;
}

/* Track Elements */

.row
{
    padding: 10px 0px 0px;
    min-height: 450px;
}

.container
{
    padding: 0px;
}

.trackProgress
{
    width: 94%;
    margin: auto;
    padding-top: 0px;
}

.trackProgressGrad
{
    width: 100%;
    height: 2px;
    border-radius: 5px;
    background-color: red;
    position: relative;
    background-image: linear-gradient(to left, #FFFFFF 0%, #FF0303 100%);
    margin-top: 5px;
}

.trackProgressLabels
{
    margin-top: 0px;
}

.trackTransport
{
    padding: 20px 0px 36px;
    text-align: center;
}

.trackTransport a
{
    padding: 5px 15px;
    color: white;
    font-size: 1.1em;
}
</style>


    <div class="vertical-center">
        <div class="container text-center">
            <div class="row">


                <div class="col-sm-3 hidden-xs leftPanel">
                    <img src="http://ecx.images-amazon.com/images/I/51NaC-g7LuL.jpg" class="img-responsive center-block" width="85%">
                    <p class="trackTitle">Previous Track</p>
                    <p class="trackDetails">Switchfoot</p>
                    <p class="trackDetails">Fading West</p>
                </div>
                <div class="col-sm-1 hidden-xs"></div>
                <div class="col-sm-4 centerPanel">
                    <img src="http://ecx.images-amazon.com/images/I/51NaC-g7LuL.jpg" class="img-responsive center-block" width="92%">
                    <p class="trackTitle">BA55</p>
                    <p class="trackDetails">Switchfoot</p>
                    <p class="trackDetails">Fading West (2014)</p>

                    <div class="trackProgress">
                        <div class="trackProgressLabels trackLight smallText">
                            <span class="pull-left">0:00</span>
                            <span>Track 1 of 11</span>
                            <span>[1:45]</span>
                            <span class="pull-right">3:45</span>
                            <!--<label class="pull-left smallText">0:00</label>
            <label class="smallText">Track 1 of 11</label>
            <label class="pull-right smallText">2:08</label>-->
                        </div>
                        <div class="trackProgressGrad"></div>
                    </div>
                    <div class="trackTransport">
                        <a href="#">
                            <i class="fa fa-random"></i>
                        </a>

                        <a href="#">
                            <i class="fa fa-backward"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-pause"></i>
                        </a>

                        <a href="#">
                            <i class="fa fa-forward"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-retweet"></i>
                        </a>
                    </div>

                </div>

                <div class="col-sm-1 hidden-xs"></div>

                <div class="col-sm-3 hidden-xs rightPanel">
                    <img src="http://ecx.images-amazon.com/images/I/51NaC-g7LuL.jpg" class="img-responsive center-block" width="85%">
                    <p class="trackTitle">Next Track</p>
                    <p class="trackDetails">Switchfoot</p>
                    <p class="trackDetails">Fading West</p>
                </div>


            </div>
        </div>
    </div>