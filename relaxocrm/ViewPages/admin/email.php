<?php
$name = "Santosh";
$email = "santoshe61@gmail.com";
$vLink = URL."/vauth/SSSSSSSSSSSSS";
function htmlMailBody($name , $email, $vLink){
  return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title><?php echo CLIENT_TITLE; ?></title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <link href="http://fonts.googleapis.com/css?family=Raleway:600,700,400" rel="stylesheet" type="text/css">
      <style type="text/css">
        html{
            width: 100%;
        }
        body{
          width: 100%;
          margin:0;
          padding:0;
          -webkit-font-smoothing: antialiased;
          mso-margin-top-alt:0px;
          mso-margin-bottom-alt:0px;
          mso-padding-alt: 0px 0px 0px 0px;
          background: #fff;
        }
        a,h1,h2,h3,h4{
          font-family: "Raleway", Helvetica, Arial, sans-serif;
          margin-top:0;
          margin-bottom:0;
          padding-top:0;
          padding-bottom:0;
        }
        table{
          font-size: 14px;
          border: 0;
        }
        img{
          border: none!important;
        }
        .bg_table {
          background: linear-gradient(90deg, #7577FA 20px, transparent 1%) center, linear-gradient(#7577FA 20px, transparent 1%) center, #9192FB;
          background-size: 22px 22px;
        }
        .heading_1{
          color: #fff; font-family: "Raleway", Helvetica, Arial, sans-serif; font-size: 34px; font-weight: 700; text-transform: capitalize; line-height:50px; letter-spacing:1px;
        }
        .para_1{
          color: #fff; font-family: "Raleway", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 600; line-height:20px; letter-spacing:1px;
        }
        .para_s{
          color: #fff; font-family: "Raleway", Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 500; line-height:17px; letter-spacing:1px;
        }
        .para_s a{
          background-color: #fefefe;text-decoration: underline;padding:2px 5px;
        }
        @media only screen and (max-width: 800px) {
          body[yahoo] .quote_full_width {width:100% !important;}
          body[yahoo] .quote_content_width {width:90% !important;}
        }
        @media only screen and (max-width: 640px) {
          body[yahoo] .full_width {width:100% !important;}
          body[yahoo] .content_width{width:80% !important;}
          body[yahoo] .center_txt {text-align: center!important;}
          body[yahoo] .post_sep {width:100% !important; height:60px !important;}
          body[yahoo] .gal_sep {width:100% !important; height:40px !important;}
          body[yahoo] .gal_img {width:100% !important;}
          body[yahoo] .bb_space {height:90px !important;}
        }
      </style>
    </head>
    <body style="margin: 0; padding: 0;" yahoo="fix">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="bg_table">
        <tr>
          <td>
              <table width="600" cellpadding="0" cellspacing="0" align="center" border="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; border:0; text-align:left;" class="content_width">
                <tr>
                  <td>
                    <a href="'.URL.'" target="_blank"> <img src="'.URL.'/assets/images/logo-teal.png" width="105" height="27" alt="" title="" border="0" style="border:0; display:inline_block;margin: 15px 0;"/></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p width="600" height="1" align="center" bgcolor="#fff"  style="height:1px!important; width:600px; background-color:#fff; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"></p>
                  </td>
                </tr>
              </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="600" cellpadding="0" cellspacing="0" align="center" class="content_width" style="margin:80px auto 40px auto;border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
              <tr>
                <td>
                  <table width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="content_width" align="left">
                    <tr>
                      <td class="heading_1">Thank You, '.$name.'</td>
                    </tr>
                    <tr>
                      <td width="100%" height="20"></td>
                    </tr>'.((IS_EMAIL_VERIFY) ? '
                      <tr>
                        <td class="para_1">
                          Welcome you to '. CLIENT_TITLE.'.<br> Your email <b>'.$email.'</b> is being registered with us. <br><br><br> Click Below verify button within 24 hours to verify your email.
                        </td>
                      </tr>
                      <tr>
                        <td align="center" style="text-align:center;">
                          <a href="'.$vLink.'" target="_blank" style="display: block; width: 100%; color: #fff; font-size: 18px; font-weight: 700; text-decoration:none; letter-spacing:1px; text-transform:uppercase; padding:10px;background-color: #5ec7f0;margin: 40px auto;">Verify Now</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="para_s">
                          if above button is not working then copy and follow this link <a href="'.$vLink.'" target="_blank">'.$vLink.'</a> to your Browser URL bar. Please ignore this Email if this registration is not done by you or you.
                        </td>
                      </tr>' : '
                      <tr>
                        <td class="para_1">
                          Welcome you to '. CLIENT_TITLE.'.<br> Your email <b>'.$email.'</b> is successfully registered with us. <br><br><br> Click Below login button to login your Profile.
                        </td>
                      </tr>
                      <tr>
                        <td align="center" style="text-align:center;">
                          <a href="'.LOGIN_URL.'" target="_blank" style="display: block; width: 100%; color: #fff; font-size: 18px; font-weight: 700; text-decoration:none; letter-spacing:1px; text-transform:uppercase; padding:10px;background-color: #5ec7f0;margin: 40px auto;">Login</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="para_s">
                          if above button is not working then copy and follow this link <a href="'.LOGIN_URL.'" target="_blank">'.LOGIN_URL.'</a> to your Browser URL bar.
                        </td>
                      </tr>').'
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
        <tr>
          <td>
            <table width="600" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; border:0px;margin-top: 40px" class="content_width">
              <tr>
                <td>
                  <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full_width center_txt">
                    <tr>
                      <td>
                        <a href="'.URL.'" target="_blank"> <img src="'.URL.'/assets/images/logo-teal.png" width="80" height="21" alt="" title="" border="0" style="border:0; display:inline_block;"></a>
                      </td>
                    </tr>
                  </table>
                  <table align="right" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full_width center_txt">
                    <tr>
                      <td style="color: #414d5f; font-family: "Raleway", Helvetica, Arial, sans-serif; font-size: 14px; letter-spacing:0.5px; font-weight: 400;">
                        <a href="'.URL.'/about" style="color: #414d60; text-decoration:none;">About</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="'.URL.'/contact" style="color: #414d60; text-decoration:none;">Contact</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="'.URL.'/tnc#terms" style="color: #414d60; text-decoration:none;">Terms</a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;margin:40px auto;"" class="full_width center_txt">
                    <tr>
                      <td style="color: #414d5f; font-family: "Raleway", Helvetica, Arial, sans-serif; font-size: 12px; letter-spacing:.5px; font-weight: 400;">
                        © '.date('Y').' <a href="'.URL.'" target="_blank" style="color: #414d5f; font-weight: 600; text-decoration:none;">'.CLIENT_COMPANY.'</a>. All Rights Reserved
                      </td>
                    </tr>
                  </table>
                  <table align="right" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;margin:40px auto;"" class="full_width center_txt">
                    <tr>
                      <td>
                        <a href="<?php echo FACEBOOK_LINK; ?>" target="_blank" style="color: #414d60; text-decoration:none;"><img src="'.URL.'/assets/images/facebook.png" width="7" height="12" alt="" title="" border="0" style="border:0; display:inline_block;"/></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo TWITTER_LINK; ?>" target="_blank" style="color: #414d60; text-decoration:none;"><img src="'.URL.'/assets/images/twitter.png" width="14" height="10" alt="" title="" border="0" style="border:0; display:inline_block;"/></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GOOGLE_LINK; ?>" target="_blank" style="color: #414d60; text-decoration:none;"><img src="'.URL.'/assets/images/gplus.png" width="6" height="12" alt="" title="" border="0" style="border:0; display:inline_block;"/></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo LINKEDIN_LINK; ?>" target="_blank" style="color: #414d60; text-decoration:none;"><img src="'.URL.'/assets/images/linkedin.png" width="11" height="12" alt="" title="" border="0" style="border:0; display:inline_block;"/></a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
  </html>';
}


echo $msg = htmlMailBody($name , $email, $vLink);