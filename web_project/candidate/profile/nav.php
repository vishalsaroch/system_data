  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="#"><img src="images/ashwani1.png" style="margin-top:-20px; margin-left:-20px; width:200px;"></a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="width: 30px;">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Update Profile</a></li>
            <li><a href="#">My Jobs</a></li>
        </ul>
      <ul class="nav navbar-nav navbar-right">        
      <li><a href="../../login2/logout.php"><span class="glyphicon glyphicon-log-in"></span><?php echo $_SESSION['first_name'] ?> Log Out</a></li>
    </ul>
    </div>
  </div>
</nav>