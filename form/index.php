<?php
	ob_start();
	session_start() ;
	
	sendprofile();
function sendprofile()
{
	$ip = $_SERVER['REMOTE_ADDR'] ;
	include_once("country.php");

$requirements=$_REQUEST['requirements'];
$company_name=$_REQUEST['company_name'];
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone'];
$fax=$_REQUEST['fax'];
$add=$_REQUEST['add'];

$city=$_REQUEST['city'];
$zip=$_REQUEST['zip'];
$country=$_REQUEST['country'];



$subject="Enquiry Form - WINDWALKER Logistics Solution Pvt. Ltd."; 
$msg_c="Thanks You for Submitting Form.
	  We are working on your request and revert shortly.
      Thanks & Regards,
	  WINDWALKER Logistics
	  Email: info@windwalkerlogistics.com";
      
	
 $to="info@windwalkerlogistics.com";

 $to_c= $email;
 $sub_c="Thank You mail from www.windwalkerlogistics.com";
 $sub=$subject;

$msg= "=============================================================="."\n";
$msg.="Personal Information "."\n";
$msg.="=============================================================="."\n";

$msg.="IP Address:  {$ip}({$country_name})"."\r\n";
$msg.="Requirements :".$requirements."\n";
$msg.="Phone No : ".$company_name."\r\n";
$msg.="E-Mail : ".$name."\r\n";
$msg.="Email ID :  ".$email."\r"."\n";
$msg.="Phone :  ".$phone."\r"."\n";
$msg.="Fax :  ".$fax."\r"."\n";
$msg.="Address :  ".$add."\r"."\n";
$msg.="City :  ".$city."\r"."\n";
$msg.="ZIP :  ".$zip."\r"."\n";
$msg.="Country :  ".$country."\r"."\n";


$msg.="=============================================================="."\n";
$msg.="HTTP Referer : ".$_SERVER['HTTP_REFERER']."\r\n";
$msg.="==============================================================";
$header_c='From: Windwalker Logistics <info@windwalkerlogistics.com>';

$header='From: '.$email."\r\n";

$header.='Bcc:info@windwalkerlogistics.com';

$mail=mail($to,$sub,$msg,$header)&&mail($to_c,$sub_c,$msg_c,$header_c);

if ($mail)
{
	header('Location:http://www.windwalkerlogistics.com/thankyou.html');
}
else
{
	echo "<center>Error........................</center>";
} 
}
?>