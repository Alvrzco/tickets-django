<?php

// PHPMailer script below

// Taking the values from the form inputs

$fname = $_REQUEST['fname'] ;
$fnameSanitized = filter_var($fname, FILTER_SANITIZE_STRING);
$lname = $_REQUEST['lname'] ;
$lnameSanitized = filter_var($lname, FILTER_SANITIZE_STRING);
$email = $_REQUEST['email'] ;
$emailSanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
$pnumber = $_REQUEST['pnumber'] ;
$pnumberSanitized = filter_var($pnumber, FILTER_SANITIZE_NUMBER_INT);
$category = $_REQUEST['category'] ;
$categorySanitized = filter_var($category, FILTER_SANITIZE_STRING);
$service = $_REQUEST['service'] ;
$serviceSanitized = filter_var($service, FILTER_SANITIZE_STRING);
$consultant = $_REQUEST['consultant'] ;
$consultantSanitized = filter_var($consultant, FILTER_SANITIZE_STRING);
$dp = $_REQUEST['dp'] ;
$dpSanitized = filter_var($dp, FILTER_SANITIZE_STRING);
$message1 = $_REQUEST['message1'] ;
$message1Sanitized = filter_var($message1, FILTER_SANITIZE_STRING);
$pay = $_REQUEST['pay'] ;
$paySanitized = filter_var($pay, FILTER_SANITIZE_STRING);
$payp = $_REQUEST['payp'] ;
$paypSanitized = filter_var($payp, FILTER_SANITIZE_EMAIL);
$qrcode = $_REQUEST['qrcode'] ;
$qrcodeSanitized = filter_var($qrcode, FILTER_SANITIZE_STRING);

require('phpmailer/PHPMailerAutoload.php');


//EMAIL RECEIVED TO THE CLIENT

$mail2 = new PHPMailer(true);
$mail2->IsMail();
$mail2->IsSMTP(); //use this code if you are using SMTP mail service
$mail2->Host = 'smtp.gmail.com';		//add your host name for eg here it shows gmail 
$mail2->SMTPAuth = true; 
$mail2->SMTPDebug = false; //to remove the mail errors
$mail2->do_debug = 0;
$mail2->Username = 'SMTP EMAIL ADDRESS'; // Enter your SMTP username (if not using SMTP then enter gmail email id for gmail host)
$mail2->Password = 'SMTP PASSWORD'; // Enter your SMTP password (if not using SMTP then enter gmail passwork for gmail host)
$mail2->FromName = "COMPANY NAME";	//name from which the mail is sent
$mail2->From = "ADMIN-MAIL@gmail.com";	//email from which the mail is sent
$mail2->SMTPSecure = 'tls'; //if not tls use 'ssl'
$mail2->Port = 587; //SMTP port -- use '465' or '587'
$mail2->addAddress($emailSanitized, $fnameSanitized);
$mail2->AddReplyTo('ADMIN-EMAIL@gmail.com', 'COMPANY NAME');
$mail2->IsHTML(true);	//if the email template is in html format
$mail2->Subject = "Uneek - Appointment Booked.";	//subject for the mail
$mail2->Body = "Thank you for booking an appointment with us.<br>

                <h4>Booking Details</h4>
                Category : $categorySanitized<br>
                Service : $serviceSanitized<br>
		        Consultant : $consultantSanitized<br>
                Available Dates : $dpSanitized<br>
                Additional Message : $message1Sanitized<br>
                
                <h4>Payment Details</h4>
                Mode of Payment: $paySanitized<br>
		        Paypal address (if paid via Paypal) : $paypSanitized<br>
		        Transaction ID (if paid via Google Pay) : $qrcodeSanitized<br><br>
		        
		        <b>NOTE:</b> If paid online, then please do no forget to bring your payment receipt during your visit. <br><br>
        
                We will get back to you shortly with the time slots as per your availability.<br><br>";
$mail2->Send();


//EMAIL RECEIVED TO ADMIN

$mail = new PHPMailer(true);
$mail->IsMail();
$mail->IsSMTP(); //use this code if you are using SMTP mail service
$mail->Host = 'smtp.gmail.com';		//add your host name for eg here it shows gmail 
$mail->SMTPAuth = true; 
$mail->SMTPDebug = false; //to remove the mail errors
$mail->do_debug = 0;
$mail->Username = 'SMTP EMAIL ADDRESS'; // Enter your SMTP username (if not using SMTP then enter gmail email id for gmail host)
$mail->Password = 'SMTP PASSWORD'; // Enter your SMTP password (if not using SMTP then enter gmail passwork for gmail host)
$mail->FromName = $fnameSanitized;	//name from which the mail is sent
$mail->From = $emailSanitized;	//email from which the mail is sent
$mail->SMTPSecure = 'tls'; //if not tls use 'ssl'
$mail->Port = 587; //SMTP port -- use '465' or '587'
$mail->addAddress('ADMIN-EMAIL@gmail.com', 'COMPANY NAME');
$mail->AddReplyTo($emailSanitized, $fnameSanitized);
$mail->IsHTML(true);	//if the email template is in html format
$mail->Subject = "Appointment: $fnameSanitized $lnameSanitized";	//subject for the mail
$mail->Body = "
		<h4>Personal Details</h4>
        First Name : $fnameSanitized<br>
        Last Name : $lnameSanitized<br>
        Email : $emailSanitized<br>
        Contact No. : $pnumberSanitized<br>
        
		<h4>Appointment Details</h4>
        Category : $categorySanitized<br>
        Service : $serviceSanitized<br>
		Consultant : $consultantSanitized<br>
        Available Dates : $dpSanitized<br>
        Additional Message : $message1Sanitized<br>
		
		<h4>Payment Details</h4>
        Mode of Payment: $paySanitized<br>
		Paypal address (if paid via Paypal) : $paypSanitized<br>
		Transaction ID (if paid via Google Pay) : $qrcodeSanitized<br><br>";


//CHECK IF MAIL IS SENT OR NOT
if(!$mail->Send()) {
   echo "Message could not be sent.  ";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit; 
 };


//REDIRECT TO PAGE AFTER SUBMIT
header("Location:REDIRECT-URL-HERE") //redirects to a page named index.php;


?>