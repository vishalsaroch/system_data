<?php
	$sql = "SELECT * from user where user.email = '".$_SESSION['email']."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
?>
<div class="tz-l">
				<div class="tz-l-1">
					<ul>
						<li>
							<?php 
								if($row["image"]===""){
									echo "<img class='rounded-circle' src='images/db-profile.jpg'  data-toggle='modal' data-target='#myModal' class='img-rounded'>" ;}
								else
								echo "<img class='rounded-circle' src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='100' width='100px;' data-toggle='modal' data-target='#myModal' class='img-rounded'><br>";
								}
							} else {
							echo "<imgsrc='images/headshot-male.png'height='150' width='150'>";
						}
						?>
					</li>
					<li><b align="center"><?php echo $first_name; ?><b></li>
					</ul>
				</div>
				<div class="tz-l-2">
					<ul>
						<li>
							<a href="dashboard.php" class="tz-lma"><img src="images/icon/dbl1.png" alt="" /> My Dashboard</a>
						</li>
						<li>
							<a href="db-all-listing.php"><img src="images/icon/dbl11.png" alt="" /> All Posted Ads</a>
						</li>
						<li>
							<a href="db-listing-add.php"><img src="images/icon/dbl11.png" alt="" /> Create New Ad</a>
						</li>
						<!-- <li>
							<a href="db-message.php"><img src="images/icon/dbl14.png" alt="" /> Messages(12)</a>
						</li>
						<li>
							<a href="db-review.php"><img src="images/icon/dbl13.png" alt="" /> Reviews(05)</a>
						</li>-->
						<li> 
							<a href="db-my-profile.php"><img src="images/icon/dbl6.png" alt="" /> My Profile</a>
						</li>
						<!-- <li>
							<a href="db-post-ads.php"><img src="images/icon/dbl11.png" alt="" /> Ad Summary</a>
						</li> -->
						<!-- <li>
							<a href="db-payment.php"><img src="images/icon/dbl9.png" alt=""> Check Out</a>
						</li>
						<li>
							<a href="db-invoice-all.php"><img src="images/icon/db21.png" alt="" /> Invoice</a>
						</li>						 -->
						<!-- <li>
							<a href="db-claim.php"><img src="images/icon/dbl7.png" alt="" /> Claim & Refund</a>
						</li>
						<li>
							<a href="db-setting.php"><img src="images/icon/dbl210.png" alt="" /> Setting</a>
						</li> -->
						
						<li>
							<a href="user-login/logout.php"><img src="images/icon/dbl12.png" alt="" /> Log Out</a>
						</li>
					</ul>
				</div>
			</div>