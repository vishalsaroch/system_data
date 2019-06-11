<?php include("user-session.php");?>
<?php
  require_once('config.php');

  // $sql="SELECT * FROM user WHERE id=".$_GET['id'];
  // $sql = "SELECT * from user where user.email = '".$_SESSION['email']."'";
   $sql = "SELECT * from user where user.email = '".$_SESSION['email']."';";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
  // $result=mysql_fetch_row(mysql_query($sql));
  // define here all the variable like $name,$image,$company_name & all other
  header('Content-Type: text/x-vcard');  
  header('Content-Disposition: inline; filename= "'.$row["name"].'.vcf"');  

  if(base64_encode($row["photo"])!=""){ 
    $getPhoto               = base64_encode($row["phone"]);
    $b64vcard               = base64_encode($getPhoto);
    $b64mline               = chunk_split($b64vcard,74,"\n");
    $b64final               = preg_replace('/(.+)/', ' $1', $b64mline);
    $photo                  = $b64final;
  }
  $vCard = "BEGIN:VCARD\r\n";
  $vCard .= "VERSION:3.0\r\n";
  $vCard .= "FN:" . $row["name"] . "\r\n";
  $vCard .= "TITLE:" . $row["company"] . "\r\n";

  if($email){
    $vCard .= "EMAIL;TYPE=internet,pref:" . $email . "\r\n";
  }
  // if(base64_encode($row["phone"]){
  //   $vCard .= "PHOTO;ENCODING=b;TYPE=JPEG:";
  //   $vCard .= $photo . "\r\n";
  // }

  if($row["phone"]){
    $vCard .= "TEL;TYPE=work,voice:" . $row["phone"] . "\r\n"; 
  }

  $vCard .= "END:VCARD\r\n";
  echo $vCard;
}}
?>