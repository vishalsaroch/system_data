
<!DOCTYPE html>
<html>
<head>
<title>Password Change</title>
</head>
<body>
<?php

?>
<h3 align="center">CHANGE PASSWORD</h3>
<div><?php if(isset($message)) { echo $message; } ?></div>
<form method="post" action="" align="center">
Current Password:<br>
<input type="password" name="currentPassword" required><br
<br>
New Password:<br>
<input type="password" name="newPassword" required><br>
Confirm Password:<br>
<input type="password" name="confirmPassword" required>
<br><br>
<input type="submit">
</form>
<br>
<br>
</body>
</html>