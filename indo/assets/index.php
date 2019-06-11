<!DOCTYPE html>
<html>
<head>
	<title>Redirecting by BestWebs...</title>
	<meta http-equiv="refresh" content="1">
	<script type="text/javascript">window.location = "/error/404";</script>
</head>
<body>
<section class="content">
  <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

      <p>
        We could not find the page you were looking for.<br>
        Maybe we have missed something or You have typed wrong
      </p>
      <a href="/" class="btn btn-flat btn-warning">Go to Home</a>
    </div>
    <!-- /.error-content -->
  </div>
  <!-- /.error-page -->
</section>
</body>
</html>
<?php
error_reporting(0);
header('Location: /error/404');
exit;
?>