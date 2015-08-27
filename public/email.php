
<?php
// multiple recipients
$to  = 'rishabh.trivedi08@timescity.com' . ', '; // note the comma
$to .= 'rishabh.trivedi@timesinternet.in';

// subject
$subject = 'Test mail newsletter';

// message
$message = '
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Responsive Email Template</title>

<style type="text/css">
    @import "http://fonts.googleapis.com/css?family=Roboto:100normal,100italic,300normal,300italic,400normal,400italic,500normal,500italic,700normal,700italic,900normal,900italic|Lora:400normal,400italic,700normal,700italic|Raleway:400normal|Roboto+Condensed:400normal|Roboto+Slab:400normal&subset=all";

    a{text-decoration: none;}
  .ReadMsgBody {width: 100%; background-color: #fff;}
  .ExternalClass {width: 100%; background-color: #fff;}
  body   {width: 100%; background-color: #f0f0f0; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Georgia, Times, serif}
  table {border-collapse: collapse;}
    .hr {background: #000 none repeat scroll 0 0; height: 2px; margin: 16px 0; width: 38px;}
    .feed_time {font-size: 14px; font-family: Roboto;}
    .feed_title {padding-bottom: 7px;}
    .feed_title > a {color: #000;font-family: Lora;font-size: 26px;font-weight: 500;text-decoration: none;}
    .summary { font-family: Roboto; font-size: 14px; line-height: 18px; padding-top: 20px;}
    .btn.btn-primary {background: #fc3768 none repeat scroll 0 0; color: #fff; font-size: 12px; padding: 15px 20px; text-decoration: none; width: 115px;}

  @media only screen and (max-width: 640px)  {
          body[yahoo] .deviceWidth {width:440px!important; padding:0;}
          body[yahoo] .center {text-align: center!important;}
                    body[yahoo] .border-bottom{border-bottom: 1px solid #ccc; margin-bottom: 20px;}
                    body[yahoo] .left{padding-right: 0 !important;}
      }

  @media only screen and (max-width: 479px) {
          body[yahoo] .deviceWidth {width:280px!important; padding:0;}
          body[yahoo] .center {text-align: center!important;}
                    body[yahoo] .border-bottom{border-bottom: 1px solid #ccc; margin-bottom: 20px;}
                    body[yahoo] .left{padding-right: 0 !important;}
      }

</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Georgia, Times, serif">

<!-- Wrapper -->
<table class="deviceWidth" width="580" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="100%" valign="top" bgcolor="#f0f0f0" style="padding-top:20px">

      <!-- Logo Header -->
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="margin:0 auto;">
                <tr>
                    <td style="font-size: 13px; color: #000; font-weight: normal; text-align: left; font-family: Georgia, Times, serif; line-height: 24px; vertical-align: top; padding:45px 0;" bgcolor="#ffffff">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                            <tr>
                                <td valign="middle" width="50%" align="right" style="border-right: 1px solid #ccc; padding: 5px 20px;">
                                    <a href="#"><img  class="deviceWidth" src="http://dev.whatshot.in/img/logo-email.png" alt="" border="0" style="display: block; width: 130px !important;" /></a>
                                </td>
                                <td valign="middle" width="50%" align="left" style="padding: 5px 20px;">
                                    <a href="#" style="text-decoration: none; color: #000; font-size: 16px; color: #000;font-family:Arial, sans-serif ">Delhi NCR</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><!-- Logo Header End -->
            <div style="height:0px;margin:0 auto;">&nbsp;</div><!-- spacer -->

      <!-- User Detail -->
      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="margin:0 auto;">
                <tr>
                    <td style="font-size: 21px; color: #000000; font-weight: normal; text-align: left; font-family: 'Raleway', sans-serif; line-height: 24px; vertical-align: top;" bgcolor="#ffffff">
                        <table width="100%">
                            <tr>
                                <td valign="top" align="center" style="padding:10px 0">
                                    Hi <strong>Chandra</strong>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:10px 0">
                                    Top Activities this weekend
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center">
                                    <div class="hr"></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
      </table><!-- User Detail -->
            <div style="height:0px;margin:0 auto;">&nbsp;</div><!-- spacer -->


            <!-- 2 Column Images & Text Side by SIde -->
            <table width="580" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth" bgcolor="#ffffff">
                <tr>
                    <td style="padding:20px">
                        <table align="left" width="41%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth border-bottom">
                            <tr>
                                <td valign="top" class="left" style="padding-right:20px; padding-bottom: 20px;">
                                    <div class="feed_time">8th Aug, 09:00pm - 01:00am</div>
                                    <div class="feed_title"><a href="">Gig Alert: Ramiro Lopez + Kohra</a></div>
                                    <a href="#"><img width="267" src="http://dev.whatshot.in/img/img1.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div class="summary">Summer House Cafe, 1st Floor, DDA Shopping Complex, Aurobindo Market, Near Pyare Lal and Sons Jewellers, Hauz Khas, South, Delhi NCR</div>
                                </td>
                            </tr>
                        </table>
                        <table align="left" width="59%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td valign="top" style="padding-right:0px;">
                                    <div class="feed_time">6th Aug, 08:00pm - 11:00pm</div>
                                    <div class="feed_title"><a href="">Acappella Music With Vocal Rasta</a></div>
                                    <a href="#"><img width="267" src="http://dev.whatshot.in/img/img2.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div class="summary">Raasta, 30A, 1st Floor, Hauz Khas Village, Near Shri Hanuman  Mandir, Hauz Khas, South, Delhi NCR</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px"><div style="height:1px; background:#ccc">&nbsp;</div></td>
                </tr>
            </table><!-- End 2 Column Images & Text Side by SIde -->
            <div style="height:15px;margin:0 auto;">&nbsp;</div><!-- spacer -->

            <table width="580" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth" bgcolor="#ffffff">
                <tr>
                    <td style="padding:20px">
                        <table align="left" width="59%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth border-bottom">
                            <tr>
                                <td valign="top" class="left" style="padding-right:20px; padding-bottom: 20px;">
                                    <div class="feed_time">By Pritisha Borthakur</div>
                                    <div class="feed_title"><a href="">City Guide: Regional Flavours Of The West</a></div>
                                    <a href="#"><img width="267" src="http://dev.whatshot.in/img/img3.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div class="summary">Explore local regional fare with our new series covering restaurants, delivery outlets and stores across Delhi NCR.</div>
                                </td>
                            </tr>
                        </table>
                        <table align="left" width="41%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td valign="top" style="padding-right:0px;">
                                    <div class="feed_time">6th Aug, 08:45pm - 12:00am</div>
                                    <div class="feed_title"><a href="">Acoustic Music With Bhrigu Sahni</a></div>
                                    <a href="#"><img width="267" src="http://dev.whatshot.in/img/img4.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div class="summary">Depot 29, B-6/2, Level 2/3, Commercial Complex, Safdarjang Enclave, Opposite Deer Park, Safdarjang, South, Delhi NCR</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="center">
                        <div class="hr"></div>
                    </td>
                </tr>
            </table><!-- End 2 Column Images & Text Side by SIde -->
            <div style="height:15px;margin:0 auto;">&nbsp;</div><!-- spacer -->

            <!-- Checkout detail btn -->
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="margin:0 auto;">
                <tr>
                    <td style="font-size: 21px; color: #000000; font-weight: normal; text-align: left; font-family: 'Raleway', sans-serif; line-height: 24px; vertical-align: top;" bgcolor="#ffffff">
                        <table width="100%">
                            <tr>
                                <td valign="top" align="center" style="padding:10px 0">
                                    <span>Find Interesting? huh !</span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:10px 0 45px 0">
                                    <a href="#"><div class="btn btn-primary">CHECK OUT MORE</div></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><!-- Checkout detail btn -->
            <div style="height:0px;margin:0 auto;">&nbsp;</div><!-- spacer -->

            <!-- Footer -->
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f0f0f0" style="margin:0 auto;">
                <tr>
                    <td style="font-family: 'Raleway',sans-serif; color: rgb(173, 173, 173);" bgcolor="#f0f0f0">
                        <table width="100%">
                            <tr>
                                <td valign="top" align="center" style="padding:10px 0">
                                    <img src="http://dev.whatshot.in/img/wh_grey.jpg">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:5px 0">
                                    <span>Explore whats popular & new in your city.</span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:5px 0">
                                    <a href="http://www.whatshot.in" style="color:#fc3768"><span>www.whatshot.in</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:5px 0">
                                    <span>Unable to see this message? <a href="" style="color:#5e5e5e">View here</a></span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:5px 0">
                                    <span>Not interested? <a href="" style="color:#5e5e5e">Unsubscribe</a></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><!-- Footer -->
            <div style="height:0px;margin:0 auto;">&nbsp;</div><!-- spacer -->

    </td>
  </tr>
</table> <!-- End Wrapper -->

</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
// $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
// $headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
