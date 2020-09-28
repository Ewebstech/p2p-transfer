<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from demo.harnishdesign.net/html/quickai/email-template/recharge-email-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Oct 2019 18:11:22 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Email Reciept</title>
<style type="text/css">
@media only screen and (max-width: 600px) {
table[class="contenttable"] {
	width: 320px !important;
	border-width: 3px!important;
}
table[class="tablefull"] {
	width: 100% !important;
}
table[class="tablefull"] + table[class="tablefull"] td {
	padding-top: 0px !important;
}
table td[class="tablepadding"] {
	padding: 15px !important;
}
}
</style>
</head>
<body style="margin:0; border: none; background:#f5f7f8">
<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  <tr>
    <td align="center" valign="top"><table class="contenttable" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#ffffff" style="border-width:1px; border-style: solid; border-collapse: separate; border-color:#ededed; margin-top:20px; font-family:Arial, Helvetica, sans-serif">
        <tr>
          <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td width="100%" height="30">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" align="center" style="font-size: 25px; text-align: center; align-content: center;">Blossom Pay NG</td>
                </tr>
                <tr>
                  <td width="100%" height="30">&nbsp;</td>
                </tr>
                <tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td style="padding:0px 20px;"><table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td style="border:4px solid #eee; border-radius:4px; padding:25px 0px;"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                      <tbody>
                        <tr>
                          <td style="font-size:14px; line-height:20px; padding:0px 25px;"><img alt="" src="mobile-successful.png"></td>
                          <td style="font-size:16px; font-weight:600; color:#777; line-height:26px; padding-right:20px;">Hi, {{$Name}}, your  {{$category}} recharge payment of <span style="color:#000;">&#8358;{{$amount}}</span> for Mobile No. <span style="color:#000;">{{$phonenumber}}</span> is now <span style="color:#28a745;">{{$status}}!</span></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
                <tr>
                  <td style="padding:25px 0px; line-height:28px; font-size:13px; color:#808080; text-align:center; ">This transaction has been successfully processed. <br> Below are the transaction details:</td>
                </tr>
                <tr>
                  <td><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                      <tbody>
                        <tr>
                          <td style="font-size:14px; line-height:20px; border-top: 1px solid #eaebed; border-bottom: 1px solid #eaebed; color:#808080">IUC/Smart Number</td>
                          <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-top: 1px solid #eaebed; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">{{$iuc}}</td>
                        </tr>
                        <tr>
                          <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Service</td>
                          <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">{{$service}}</td>
                        </tr>
                        <tr>
                          <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Category</td>
                          <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">{{$category}}</td>
                        </tr>
                        <tr>
                          <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Transaction Date</td>
                          <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">{{$date}}</td>
                        </tr>
                        <tr>
                          <td style="font-size:14px; line-height:20px; border-bottom: 1px solid #eaebed; color:#808080">Transaction ID</td>
                          <td style="font-size:14px; line-height:20px; padding: 10px 0 10px 5px; border-bottom: 1px solid #eaebed; color: #404040; font-weight: bold;" valign="top" align="right">{{$reference}}</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td style="padding:20px 20px;">

            <table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td style="background-color:#efefef; border-radius:4px; padding:25px 20px; text-align: center; align-content: center;"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                      <tbody>
                        <tr>
                          <td style="font-size:14px; line-height:20px; color:#404040; font-weight: bold;">Total Payment</td>
                          <td style="font-size:16px; line-height:20px; color: #404040; font-weight: bold;" valign="top" align="right">&#8358;{{$amount}}.00</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>

          </td>
        </tr>
        <tr>
          <td><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#555555; font-family:Arial, Helvetica, sans-serif;">
              <tbody>
                <tr>
                  <td class="tablepadding" align="center" style="font-size:14px; line-height:32px; padding:5px 20px 34px 20px;"> Any Questions? Get in touch with our 24x7 Customer Care team.<br />
                    <a href="https://api.whatsapp.com/send?phone=2349023624623" style="background-color:#0071cc; color:#ffffff; padding:8px 25px; border-radius:4px; font-size:14px; text-decoration:none; display:inline-block; text-transform:uppercase; margin-top:10px;">Contact Customer Care</a></td>
                </tr>
                <tr> </tr>
              </tbody>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#777777; font-family:Arial, Helvetica, sans-serif">
        <tbody>
          <tr>
            <td class="tablepadding" style="padding:20px 0; border-collapse:collapse"><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#777777; font-family:Arial, Helvetica, sans-serif">
                <tbody>
                  <tr>
                    <td align="center" class="tablepadding" style="line-height:20px; padding:20px; font-size: 10px;"> This email was generated for ewebstech@gmail.com and will not be published or shared as part of our data privacy policies.</td>
                  </tr>
                </tbody>
              </table>
              <table align="center">
                <tr>
                  <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="https://blossompay.com.ng/images/facebook.png" width="32" height="32" alt=""></a></td>
                  <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="https://blossompay.com.ng/images/twitter.png" width="32" height="32" alt=""></a></td>
                  <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="https://blossompay.com.ng/images/google_plus.png" width="32" height="32" alt=""></a></td>
                  <td style="padding-right:10px; padding-bottom:9px;"><a href="#" target="_blank" style="text-decoration:none; outline:none;"><img src="https://blossompay.com.ng/images/pinterest.png" width="32" height="32" alt=""></a></td>
                </tr>
              </table>
              <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#777777; font-family:Arial, Helvetica, sans-serif">
                <tbody>
                  <tr>
                    <td class="tablepadding" align="center"  style="line-height:20px; padding-top:10px; padding-bottom:20px; text-align: center; align-content: center;">Copyright &copy; 2020 Blossom Pay NG. All Rights Reserved. </td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</table>
</body>

<!-- Mirrored from demo.harnishdesign.net/html/quickai/email-template/recharge-email-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Oct 2019 18:11:31 GMT -->
</html>