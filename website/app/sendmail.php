<?php
include_once 'app/Core.php';
//Identitas email
$name = Core::getInstance()->title; 
$to=Core::getInstance()->email;

include('phpmailer/class.phpmailer.php');
include('phpmailer/class.smtp.php');
$mail = new PHPMailer();

//Konfigurasi SMTP Server
$mail->Host     = "server.cap-express.co.id"; 
$mail->Mailer   = "smtp";
$mail->Port 	= 25;
$mail->SMTPAuth = true;
$mail->SMTPSecure = false;
$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
);
$mail->Username = "noreply@cap-express.co.id"; 
$mail->Password = "noreply1234";

//Proses send mailer
if($_POST['formname'] == 'get_quote'){
	if($_POST['gq-location'] != '' && $_POST['gq-person'] != '' && $_POST['gq-destination'] != '' && $_POST['gq-contact'] != '' && $_POST['gq-text'] != ''){
		
		$mail->From = $_POST["gq-contact"];
		$mail->FromName = $_POST["gq-person"];
		$mail->AddAddress($to,$name);
		$mail->AddReplyTo($_POST["gq-contact"],$_POST["gq-person"]);
		$mail->WordWrap = 70; 
		$mail->IsHTML(true); 
		
		$subject = 'Pesan baru dari '.Core::getInstance()->title;
		$message = '<b>Nama:</b> '.$_POST["gq-person"].'<br>
		<b>Kontak:</b> '.$_POST["gq-contact"].'<br>
		<b>Lokasi:</b> '.$_POST["gq-location"].'<br>
		<b>Tujuan:</b> '.$_POST["gq-destination"].'<br>
		<b>Pesan:</b> '.$_POST["gq-text"];

		$mail->Subject = $subject;
		$mail->Body = $message; 
		$mail->AltBody = $message;
		
		if ($mail->Send()){
			echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda berhasil terkirim!
			</div>';
		} else{
			echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda gagal terkirim! Error: '.$mail->ErrorInfo.'.
			</div>';
		}
		
	}else{
				
		echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Semua kolom wajib di isi!
			</div>';
	}
}elseif($_POST['formname'] == 'contact'){
	if($_POST['contact-name'] != '' && $_POST['contact-email'] != '' && $_POST['contact-phone'] != '' && $_POST['contact-site'] != '' && $_POST['contact-message'] != ''){
		
		
		$mail->From = $_POST["contact-email"];
		$mail->FromName = $_POST["contact-name"];
		$mail->AddAddress($to,$name);
		$mail->AddReplyTo($_POST["contact-email"],$_POST["contact-name"]);
		$mail->WordWrap = 70; 
		$mail->IsHTML(true); 
		
		$subject = 'Pesan baru dari '.Core::getInstance()->title;
		$message = '<b>Nama:</b> '.$_POST["contact-name"].'<br>
		<b>E-mail:</b> '.$_POST["contact-email"].'<br>
		<b>Telepon:</b> '.$_POST["contact-phone"].'<br>
		<b>Website:</b> '.$_POST["contact-site"].'<br>
		<b>Pesan:</b> '.$_POST["contact-message"];

		$mail->Subject = $subject;
		$mail->Body = $message; 
		$mail->AltBody = $message;
		
		if ($mail->Send()){
			echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda berhasil terkirim!
			</div>';
		} else{
			echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda gagal terkirim! Error: '.$mail->ErrorInfo.'.
			</div>';
		}
		
		
	}else{
				
		echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Semua kolom wajib di isi!
			</div>';
	}
}
?>