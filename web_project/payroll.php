<!DOCTYPE html>
<html>
<head>
	<title>Payroll</title>
	<link rel="icon" href="images/ashwani.png" type="image/png">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="footer.css">
   <link rel="stylesheet" type="text/css" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
  	$(function () {
  $(document).scroll(function () {
	  var $nav = $(".navbar-fixed-top");
	  $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});
  </script>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<?php include("nav.php"); ?>
			</div>	

		<div class="container" style="margin: 10px;">
			<h1 align="center" style="margin-top: 30px; background-color: black;color: white; opacity: 0.5;">Payroll & Statutory Compliance</h1>
			<div class="row" style="margin: 10px;">
			<P> Our team of professionals, with years of experience in this area, will ensure timely payroll  and statutory compliance under various acts like returns, forms, records, registers :</P>

			<P>Contract Labor (Regulation & Abolition) Act, 1970</P>
			<P>Minimum Wages Act, 1948 (State Act)</P>
			<P>Employees’ State Insurance Act, 1948</P>
			<P>Labor Welfare Act</P>
			<P>Employees’ Provident Funds & Miscellaneous Provisions Act, 1952</P>
			<P>Payment of Wages Act, 1936</P>
			<P>Shop & Establishments Act</P>  
			<P>Payment of Bonus Act, 1965</P>
			<P>Payment of Gratuity Act,1972</P>
			<P>Equal Remuneration Act, 1976</P>
			<P>Professional Tax (State Act)</P>
			<P>Factories Act, 1948</P>
			<P>Trade Unions Act 1926</P>
			<P>Other Relevant Laws & act</P><br>
			<a href="contact.php">Inquery Now</a>
		</div>
		</div>
	</div>
	<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<?php include("footer.php"); ?>
</body>
</html>
