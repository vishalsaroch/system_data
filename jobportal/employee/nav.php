<nav class="navbar navbar-expand-lg  ftco_navbar bg-light ftco-navbar-light shadow" id="ftco-navbar  " >
  <div class="container">
    <a href="../index.php" class="navbar-brand"><img src="../images/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu" style="color: #000;"></span>
    </button>
    <?php
      $sql = "SELECT * FROM employersusers where userid='$email'";
      $result = $conn->query($sql); 
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item active"><a href="Profile.php" class="nav-link" style="color:#000; font-weight: bold">Profile</a></li>
      <?php
        if ($row["showjob"]==0){
          echo "";}
        else{
        ?>
          <li class='nav-item active'><a href='addjob.php' class='nav-link' style='color:#000; font-weight: bold'>Add New Job</a></li>
          <li class='nav-item active'><a href='compjob.php' class='nav-link' style='color:#000; font-weight: bold'>Our Company Job</a></li>
          <li class="nav-item active"><a href="searchcandidate.php" class="nav-link" style="color:#000; font-weight: bold">Search Candidate</a></li>
          <li class="nav-item active"><a href="interviewstatus.php" class="nav-link" style="color:#000; font-weight: bold">Interview Status</a></li>
        <?php
          }
        }
      }
    ?>
    <li class="nav-item active"><a href="../emplogin/logout.php" class="nav-link" style="color:#000; font-weight: bold;"\>Logout</a></li>
  </ul>
</div>
</div>
</nav>