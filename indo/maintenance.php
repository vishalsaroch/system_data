<?php
#######################################################
#******UNCOMMENT BELOW IF IN MAINTENANCE OR DEVELOPMENT

#    header('Location: /');exit;

#######################################################
#######################################################
?>
<!DOCTYPE html>
<html>
<head>
<title>We are coming soon | Mr. Santosh is working with www.Bestwebs.in</title>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<!-- //Meta Tags -->

<style type="text/css" media="screen">
	/* reset */
	html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
	article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
	ol,ul{list-style:none;margin:0px;padding:0px;}
	blockquote,q{quotes:none;}
	blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
	table{border-collapse:collapse;border-spacing:0;}
	/* start editing from here */
	a{text-decoration:none;}
	.txt-rt{text-align:right;}/* text align right */
	.txt-lt{text-align:left;}/* text align left */
	.txt-center{text-align:center;}/* text align center */
	.float-rt{float:right;}/* float right */
	.float-lt{float:left;}/* float left */
	.clear{clear:both;}/* clear float */
	.pos-relative{position:relative;}/* Position Relative */
	.pos-absolute{position:absolute;}/* Position Absolute */
	.vertical-base{	vertical-align:baseline;}/* vertical align baseline */
	.vertical-top{	vertical-align:top;}/* vertical align top */
	nav.vertical ul li{	display:block;}/* vertical menu */
	nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
	img{max-width:100%;}
	/*end reset*/

	body{
		padding:0;
		margin:0;
		background: linear-gradient(0deg,rgba(0,0,0,0.8),rgba(0,0,0,0.8)), url(https://ps.w.org/under-construction-page/assets/screenshot-2.png?rev=1503807) no-repeat center;
	    background-size: cover;
	    -webkit-background-size: cover;
	    -o-background-size: cover;
	    -ms-background-size: cover;
	    -moz-background-size: cover;
	    font-family: 'Open Sans', sans-serif !important;
		background-position:center;
		background-attachment:fixed;
	}

	h1,h2,h3,h4,h5,h6{
		margin:0;
	}
	p{
		margin:0;
	}
	ul{
		margin:0;
		padding:0;
	}
	label{
		margin:0;
	}
	/*-- main --*/
	.subscribe h2 {
	    text-align: right;
	    color: #fff;
	    font-size: 1.5em;
	    letter-spacing: 2px;
	    margin-bottom: 1em;
		font-weight:500;
	    font-family: sans-serif;
	}
	.subscribe h2 span {
		font-weight:600;
		color:#fc636b;
	}
	p#note {
	    text-align: center;
	    line-height: 1.8em;
	    color:#fff;
	}
	.content h1 {
	    color: #3be8b0;
	    font-size: 53px;
	    text-align: right;
	    letter-spacing: 6px;
	    font-weight: 600;
	    font-family: sans-serif;
	    text-transform: capitalize;
	    margin-bottom: 1.5em;
	}
	.main {
	    width: 75%;
	    margin: 0 auto;
	    float: right;
	    padding: 4em 9em 4em 0em;
	}
	p.para-w3ls {
	    text-align: right;
	    color: #fff;
	    font-size: 19px;
	    letter-spacing: 2px;
	}
	p.copy_rights {
	    color: #fff;
	    font-size: 15px;
	    letter-spacing: 1.5px;
	    text-align: center;
	    margin-top: 1em;
	}
	p.copy_rights a{
		text-decoration:none;
		color:#3be8b0;
		transition: 0.5s all;
	    -webkit-transition: 0.5s all;
	    -moz-transition: 0.5s all;
	}
	p.copy_rights a:hover {
	    text-decoration: underline;
	    color: #fff;
	}
	.subscribe{
		margin-top:3em;
	}
	.subscribe input[type="email"] {
	    outline: none;
	    padding: 10.5px 10px;
	    border: none;
	    background: #ffffff;
	    font-size: 15px;
	    color: #010103;
	    width: 50%;
	    float: left;
	}
	.subscribe input[type="submit"], .subscribe a {
	    outline: none;
	    padding: 10px 20px;
	    border: none;
	    background: #fc636b;
	    font-size: 1em;
	    color: #fff;
	    float: left;
	    cursor: pointer;
	    width: 25.2%;
	}
	.subscribe input[type="submit"], .subscribe a:hover{
		background:#3be8b0;
		transition: 0.5s all;
	    -webkit-transition: 0.5s all;
	    -o-transition: 0.5s all;
	    -moz-transition: 0.5s all;
	    -ms-transition: 0.5s all;
	}
	.contact-form {
	    width: 50%;
	    float: right;
	}
	.ClassyCountdown-wrapper {
	    text-align: center;
	}
	.clock .column {
	    display: inline-block;
	    width: 14%;
	    margin: 40px 0 0 50px;
	    border-top: 7px solid rgba(255, 255, 255, 0.1);
	    /*border-left: 7px solid rgba(255, 255, 255, 0.1);*/
	    border-right: 7px solid rgba(0, 0, 0, 0.2);
	    /*border-bottom: 7px solid rgba(0, 0, 0, 0.2);*/
	    text-align: center;
	    background: rgba(0, 0, 0, 0.19);
	}
	.clock {
	    text-align: right;
	}
	.timer {
	    font-size: 74px;
	    font-weight: 700;
	    display: inline-block;
	    vertical-align: top;
	    color: #fff;
	    letter-spacing: 5px;
	    /* background: rgba(0, 0, 3, 0.37); */
	    padding: 6px 16px;
	}
	.text {
	    color: #d0d0d0;
	    margin-bottom: 14px;
	    font-family: sans-serif;
	    font-size: 15px;
	    letter-spacing: 1px;
	    text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.68);
	    text-align: center;
	}
	/*-- responsive media queries --*/
	@media (max-width: 1680px){
		.subscribe input[type="submit"], .subscribe a {
			width: 24.8%;
		}
	}
	@media (max-width: 1600px){
		.subscribe input[type="submit"], .subscribe a {
			width: 24.6%;
		}
	}
	@media (max-width: 1440px){
		.contact-form {
			width: 59%;
		}
	}
	@media (max-width: 1366px){
		.contact-form {
			width: 62%;
		}
	}
	@media (max-width: 1280px){
		.contact-form {
			width: 67%;
		}
		.ClassyCountdown-wrapper canvas {
			width: 100%;
			height:initial;
		}
	}
	@media (max-width: 1080px){
		.content {
			padding: 20px 0;
		}
		p.copy_rights {
			margin-top: 0px;
		}
		.content h1 {
			font-size: 41px;
			margin-bottom: 1em;
		}
		.main {
			width: 86%;
			padding: 2.5em 5em 1em 0em;
		}
		.subscribe h2 {
			font-size: 1.3em;
		}
		.contact-form {
			width: 70%;
		}
		.clock .column {
			width: 17%;
		}
	}
	@media (max-width: 1024px){
		.contact-form {
			width: 75%;
		}
		.subscribe input[type="submit"], .subscribe a {
			margin: 0em 0 0 0em;
		}
		.subscribe h2 {
			margin-bottom: 1em;
		}
		.subscribe {
			margin-top: 3em;
		}
		p.copy_rights {
			margin: 0em 0em 2.8em;
		}
	}
	/*-- w3layouts --*/

	@media (max-width: 991px){
		.main {
			width: 81%;
		}
		.ClassyCountdown-wrapper > div {
			width: 19%;
			margin: 0 3%;
			height: inherit !important;
		}
	}
	@media (max-width: 900px){
		.main {
			width: 89%;
			padding: 3.5em 3em 0em 0em;
		}
		.timer {
			font-size: 65px;
		}
		p.copy_rights {
			font-size: 14px;
			letter-spacing: 2px;
		}
		.content {
			padding: 0;
		}
		p.copy_rights {
			margin: 3em 0;
		}
	}
	@media (max-width: 800px){
		.clock .column {
			width: 19%;
			margin: 28px 0 0 30px;
		}
		.content h1 {
			font-size: 38px;
			margin-bottom: 0.7em;
			letter-spacing: 4px;
		}
		.subscribe input[type="submit"], .subscribe a {
			width: 24.2%;
		}
		.main {
			width: 90%;
			padding: 5em 3em 0em 0em;
		}
		.subscribe h2 {
			font-size: 1.2em;
		}
	}
	@media (max-width: 768px){
		.subscribe input[type="submit"], .subscribe a {
			width: 24%;
		}
		/*-- agileits --*/
		.main {
			padding: 8em 3em 0em 0em;
		}
		p.copy_rights {
			margin: 5em 0;
		}
	}
	@media (max-width: 767px){
		/*-- agileits --*/
		.main {
			padding: 5em 3em 0em 0em;
		}
		p.copy_rights {
			margin: 3em 0;
		}
	}
	@media (max-width: 736px){
		.timer {
			font-size: 55px;
			padding: 2px 16px;
		}
		.text {
			font-size: 12px;
			letter-spacing: 2px
		}
		.clock .column {
			margin: 28px 0 0 28px;
		}
		.subscribe input[type="submit"], .subscribe a {
			width: 23.97%;
		}
		.content h1 {
			margin-bottom: 1.5em;
		}
	}
	@media (max-width: 667px){
		.subscribe {
			margin-top: 2.5em;
		}
		.contact-form {
			width: 78%;
		}
		.main {
			padding: 5em 2em 0em 0em;
		}
		.timer {
			font-size: 50px;
		}
		p.copy_rights {
			margin: 2.5em 0;
			line-height: 28px;
		}
		.clock .column {
			margin: 28px 0 0 24px;
		}
		.subscribe input[type="submit"], .subscribe a {
			width: 23.6%;
		}
	}
	@media (max-width: 640px){
		.ClassyCountdown-value{
			font-size:39px !important;
		}
		.ClassyCountdown-value span{
			font-size:14px !important;
		}
		.subscribe input[type="email"] {
			width: 68%;
		}
		.main {
			width: 95%;
		}
		.subscribe input[type="submit"], .subscribe a {
			width: 17.0%;
		}
		p.para-w3ls {
			font-size: 18px;
		}
		.subscribe h2 {
			font-size: 1.1em;
		}
		p.copy_rights {
			margin: 3em 0;
		}
	}
	/*-- w3layouts --*/
	@media (max-width: 600px){
		.subscribe input[type="email"] {
			width: 65%;
		}
		p.copy_rights {
			margin: 3em 1em;
		}
		.content h1 {
			font-size: 36px;
			letter-spacing: 3px;
		}
		.clock .column {
			margin: 28px 0 0 15px;
		}
		.subscribe input[type="email"] {
			width: 67.7%;
		}
		p.copy_rights {
			margin: 3em 2em;
		}
	}
	@media (max-width: 568px){
		.main {
			padding: 4.5em 1.5em 0em 0em;
		}
		.subscribe input[type="submit"], .subscribe a {
			width: 14.4%;
		}
		.subscribe input[type="submit"], .subscribe a {
			font-size: 14px;
			letter-spacing: 1px;
		}
		.subscribe input[type="email"] {
			padding: 10px 10px;
			font-size: 14px;
			letter-spacing: 1px;
		}
	}
	@media (max-width: 480px){
		.content h1 {
			font-size: 28px;
		}
		.contact-form {
			width: 95%;
		}
		p.para-w3ls {
			font-size: 15px;
		}
		.timer {
			font-size: 43px;
		}
		.main {
			padding: 5.5em 1.5em 0em 0em;
		}
		p.copy_rights {
			margin: 4em 2em;
		}
		.contact-form {
			width: 93%;
		}
	}
	@media (max-width: 440px){
		.main {
			padding: 4em 1.2em 0em 0em;
		}
		.content h1 {
			font-size: 31px;
			line-height: 1.5em;
			margin-bottom: 0.6em;
		}
		p.para-w3ls {
			letter-spacing: 1.5px;
		}
		.timer {
			font-size: 39px;
		}
		.clock .column {
			margin: 28px 0 0 10px;
		}
		.subscribe h2 {
			font-size: 1em;
		}
		.subscribe input[type="email"] {
			width: 67.4%;
		}
		.text {
			font-size: 11px;
		}
	}
	@media (max-width: 414px){

		.main {
			width: 93%;
		}
		.subscribe input[type="email"] {
			width: 63%;
		}
		.timer {
			font-size: 40px;
			padding: 2px 12px;
		}
		.subscribe {
			margin-top: 3em;
		}
		p.copy_rights {
			margin: 6em 2em;
		}
		.subscribe input[type="submit"], .subscribe a {
			width: 18.4%;
		}
	}
	@media (max-width: 384px){
		.clock .column {
			width: 44%;
			margin: 14px 0 0 10px;
		}
		.main {
			width: 94%;
			padding: 2.1em 1.2em 0em 0em;
		}
		.content h1 {
			letter-spacing: 2.5px;
			margin-bottom: 0.4em;
		}
		p.para-w3ls {
			line-height: 25px;
		}
		.subscribe input[type="submit"], .subscribe a {
			padding: 10px 13px;
		}
		.subscribe input[type="email"] {
			width: 62%;
		}
		.subscribe {
			margin-top: 1.5em;
		}
		.subscribe h2 {
			font-size: 16px;
			letter-spacing: 1.5px;
		}
		p.copy_rights {
			margin: 1.8em 1em;
			font-size: 13px;
			letter-spacing: 1px;
			line-height: 27px;
		}
	}
	@media (max-width: 375px){

	}
	@media (max-width: 320px){
		.clock .column {
			width: 41%;
		}
		.content h1 {
			letter-spacing: 1px;
			font-size: 27px;
		}
		.main {
			padding: 1.5em 1.2em 0em 0em;
		}
		.subscribe input[type="email"] {
			width: 57%;
		}
		.subscribe input[type="submit"], .subscribe a {
			padding: 10px 9px;
			width: 35.4%;
		}
		.subscribe h2 {
			font-size: 14px;
			letter-spacing: 1.3px;
		}
		.timer {
			font-size: 30px;
		}
		p.copy_rights {
			margin: 1.5em 1em;
		}
		p.para-w3ls {
			letter-spacing: 1px;
			font-size: 13.5px;
		}
	}
	/*-- responsive media queries --*/
</style>

<body>
	<div class="content">
			<div class="main agile">
			<h1>We are Under Maintenance</h1>
			<p class="para-w3ls">Mr. Santosh is Working on it.</p>
				<div class="clock w3agile">
            <div class="column days">
                <div class="timer" id="days"></div>
                <div class="text">DAYS</div>
            </div>

            <div class="column">
                <div class="timer" id="hours"></div>
                <div class="text">HOURS</div>
            </div>

            <div class="column">
                <div class="timer" id="minutes"></div>
                <div class="text">MINUTES</div>
            </div>

            <div class="column">
                <div class="timer" id="seconds"></div>
                <div class="text">SECONDS</div>
            </div>
        </div>
		 <!-- Custom-JavaScript-File-Links -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.4/moment-timezone-with-data.js"></script>
        <script type="text/javascript">
        	$(function(){
			    function timer(settings){
			        var config = {
			            endDate: '2017-11-12 21:05',
			            timeZone: 'Asia/Kolkata',
			            hours: $('#hours'),
			            minutes: $('#minutes'),
			            seconds: $('#seconds'),
			            newSubMessage: 'and should be back online in a few minutes...'
			        };
			        function prependZero(number){
			            return number < 10 ? '0' + number : number;
			        }
			        $.extend(true, config, settings || {});
			        var currentTime = moment();
			        var endDate = moment.tz(config.endDate, config.timeZone);
			        var diffTime = endDate.valueOf() - currentTime.valueOf();
			        var duration = moment.duration(diffTime, 'milliseconds');
			        var days = duration.days();
			        var interval = 1000;
			        var subMessage = $('.sub-message');
			        var clock = $('.clock');
			        if(diffTime < 0){
			            endEvent(subMessage, config.newSubMessage, clock);
			            return;
			        }
			        if(days > 0){
			            $('#days').text(prependZero(days));
			            $('.days').css('display', 'inline-block');
			        }
			        var intervalID = setInterval(function(){
			            duration = moment.duration(duration - interval, 'milliseconds');
			            var hours = duration.hours(),
			                minutes = duration.minutes(),
			                seconds = duration.seconds();
			            days = duration.days();
			            if(hours  <= 0 && minutes <= 0 && seconds  <= 0 && days <= 0){
			                clearInterval(intervalID);
			                endEvent(subMessage, config.newSubMessage, clock);
			                window.location.reload();
			            }
			            if(days === 0){
			                $('.days').hide();
			            }
			            $('#days').text(prependZero(days));
			            config.hours.text(prependZero(hours));
			            config.minutes.text(prependZero(minutes));
			            config.seconds.text(prependZero(seconds));
			        }, interval);
			    }
			    function endEvent($el, newText, hideEl){
			        $el.text(newText);
			        hideEl.hide();
			    }
			    timer();
			});
        </script>
    	<!-- //Custom-JavaScript-File-Links -->
		<div class="subscribe wthree">
			<h2><span>Contact</span> if wants to know more</h2>
			<div class="contact-form">
				<form action="#" method="post" onsubmit="return false;">
					<input type="email" id="myemail" name="Email" placeholder="santoshe61@gmail.com" value="santoshe61@gmail.com" disabled="">
					<a value="Subscribe" id="clicktocopy" href="#">Mail</a>
					<div class="clear"></div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
 			$('#clicktocopy').click(function(event) {
 				event.preventDefault();
				$("#myemail").val().select();
				document.execCommand("copy");
			});
		</script>
    </div>
	<div class="clear"></div>
			</div>
		<p class="copy_rights">&copy; 2017. All Rights Reserved | Designed, Developed and Maintained by  <a href="http://bestwebs.in/">BestWebs</a></p>
	</div>

</body>
</html>
