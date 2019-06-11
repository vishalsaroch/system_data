<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  	function PopUp(hideOrshow) {
    if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
    else document.getElementById('ac-wrapper').removeAttribute('style');
}
window.onload = function () {
    setTimeout(function () {
        PopUp('show');
    }, 5000);
}
  </script>

  <style type="text/css">
  	#ac-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, .6);
    z-index: 1001;
}
#popup {
    width: 500px;
    height: 400px;

   /* background: blue;*/
    /*border: 2px solid #000;*/
    /*border-radius: 25px;
    -moz-border-radius: 25px;
    -webkit-border-radius: 25px;*/
   /* box-shadow: #64686e 0px 0px 3px 3px;
    -moz-box-shadow: #64686e 0px 0px 3px 3px;
    -webkit-box-shadow: #64686e 0px 0px 3px 3px;*/
    background-color:aqua;
    position: relative;
    top: 150px;
    left: 400px;
    border:1px solid red;

}
/*.hire{
	height:100px;
	width: 250px;
	border:1px solid blue;
	float: left;
	padding:10px
}*/
/*.find{
	height:100px;
	width: 250px;
	border:1px solid blue;
	padding: 10px
	background:#000;
	}*/
	
	a{
		background-color: black;	
	}
  </style>

</head>
<body>
	<nav class="navbar navbar">
		<div class=nav-header>
			<h1>Cogentsol</h1>
		</div>
	<ul class="nav navbar-nav" style="background-color:white !important; color: black;">
    <li><a href="#section1">Section 1</a></li>
    
</nav>
	</nav>

	<div class="container">	
		<div class="jombotron">
			<h1 class="title" align="center">WELCOME TO OUR WEBSITE. </h1>
			<h3 align ="center">WE HELP TO FIND YOUR JOB.</h3>
		</div>	
	</div>

	<div class="container">
		<img src="images/baner1.jpg" height="500px" width="100%" >
	</div>
		
	<div id="ac-wrapper">
		<div id="popup">
			<center style="height=""400px> 
				<div class="close"><a class="close" href="#" onClick="PopUp('hide')" style="color:black">X</a></div>
				<div class="image">
					<img src="images/hire.jpg" style="height: 300px; width: 480px; margin:10px; padding: 10px;">
				</div>
				 
				 <div class="row">
					 <div class="col-sm-6 center-block">
						<a href="hire.html" class="btn btn-default btn-xs"><h4>HIRE A CANDIDATE</h4></a>
					</div>

					<div class="col-sm-6 center-block">
						<a href="as.html" class="btn btn-default btn-xs"><h4>FIND A JOB</h4></a>
					</div>
				</div>
			</center>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<h1 class="title" align="center">WELCOME TO OUR WEBSITE. </h1>
			<h3 align ="center">WE HELP TO FIND YOUR JOB.</h3>
		</div>
	</div>

	<nav class="navbar navbar-inverse">
		<div class="footer">
			<p> @ all rights recived</p>
		</div>
	</nav>
</body>
</html>