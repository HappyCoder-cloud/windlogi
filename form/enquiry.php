<?php
ob_start();
session_start() ;

sendprofile();
function sendprofile(){
$ip = $_SERVER['REMOTE_ADDR'] ;
include_once("country.php");

$TourName=$_REQUEST['TourName'];
$DateofTravel=$_REQUEST['DateofTravel'];
$TripDuration=$_REQUEST['TripDuration'];
$NumberofGuest=$_REQUEST['NumberofGuest'];
$HotelCategory=$_REQUEST['HotelCategory'];
$SpecialRequirements=$_REQUEST['SpecialRequirements'];
$YourName=$_REQUEST['YourName'];
$Email=$_REQUEST['Email'];
$Country=$_REQUEST['Country'];
$PhoneNo=$_REQUEST['PhoneNo'];

$subject="Enquiry Form - Nigella Travels India Pvt Ltd."; 
$msg_c="Thanks You for Submitting Form.

	  We are working on your request and revert shortly.
      Thanks & Regards, <www.budgettourtoindia.com>";
      
	
 $to="sales@nigellatravels.com";

 $to_c= $Email;
 $sub_c="Thank You mail from www.budgettourtoindia.com";
 $sub=$subject;

$msg= "=============================================================="."\n";
$msg.="Personal Information "."\n";
$msg.="=============================================================="."\n";

$msg.="IP Address:  {$ip}({$country_name})"."\r\n";
$msg.="Full Name :".$YourName."\n";
$msg.="Phone No : ".$PhoneNo."\r\n";
$msg.="E-Mail : ".$Email."\r\n";
$msg.="Country :  ".$Country."\r"."\n";
if(strlen(trim($TourName))>0){
	$msg.="Tour Name : ".$TourName."\r\n";
}
if(strlen(trim($DateofTravel))>0){
	$msg.="Date of Travel : ".$DateofTravel."\r\n";
}
if(strlen(trim($TripDuration))>0){
	$msg.="Trip Duration : ".$TripDuration."\r\n";
}
if(strlen(trim($NumberofGuest))>0){
	$msg.="No of Guest : ".$NumberofGuest."\r\n";
}
if(strlen(trim($HotelCategory))>0){
	$msg.="Hotel Category : ".$HotelCategory."\r\n";
}
if(strlen(trim($SpecialRequirements))>0){
	$msg.="Special Requirements : ".$SpecialRequirements."\r\n";
}

$msg.="=============================================================="."\n";
$msg.="HTTP Referer : ".$_SERVER['HTTP_REFERER']."\r\n";
$msg.="==============================================================";
$header_c='From:Budget Tour India<info@budgettourtoindia.com>';

$header='From: '.$Email."\r\n";

$header.='Bcc:info@budgettourtoindia.com';

$mail=mail($to,$sub,$msg,$header)&&mail($to_c,$sub_c,$msg_c,$header_c);

if ($mail)
{
	header('Location:http://www.budgettourtoindia.com/thankyou.html');
}
else
{
	echo "<center>Error........................</center>";
} 
}
?>