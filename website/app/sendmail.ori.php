<?php
$emailaddress = "aalfiann@gmail.com";
if($_POST['formname'] == 'get_quote'){
	if($_POST['gq-location'] != '' && $_POST['gq-person'] != '' && $_POST['gq-destination'] != '' && $_POST['gq-contact'] != '' && $_POST['gq-text'] != ''){
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'From: ' . $_POST["gq-person"] . '<' . $_POST["gq-contact"] . '>' . "\r\n" .
		'Reply-To: ' . $_POST["gq-contact"] . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		$subject = 'Pesan baru dari kirimbarangpurwokerto.com';
		$message = '<b>Nama:</b> '.$_POST["gq-person"].'<br>
		<b>Kontak:</b> '.$_POST["gq-contact"].'<br>
		<b>Lokasi:</b> '.$_POST["gq-location"].'<br>
		<b>Tujuan:</b> '.$_POST["gq-destination"].'<br>
		<b>Pesan:</b> '.$_POST["gq-text"];
		
		if (@mail( $emailaddress, $subject, $message, $headers )){
			echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda berhasil terkirim!
			</div>';
		} else{
			echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda gagal terkirim! Silahkan coba beberapa saat lagi.
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
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'From: ' . $_POST["contact-name"] . '<' . $_POST["contact-email"] . '>' . "\r\n" .
		'Reply-To: ' . $_POST["contact-email"] . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		$subject = 'Pesan baru dari kirimbarangpurwokerto.com';
		$message = '<b>Nama:</b> '.$_POST["contact-name"].'<br>
		<b>E-mail:</b> '.$_POST["contact-email"].'<br>
		<b>Telepon:</b> '.$_POST["contact-phone"].'<br>
		<b>Website:</b> '.$_POST["contact-site"].'<br>
		<b>Pesan:</b> '.$_POST["contact-message"];
		
		if (@mail( $emailaddress, $subject, $message, $headers )){
			echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda berhasil terkirim!
			</div>';
		} else{
			echo '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pesan Anda gagal terkirim! Silahkan coba beberapa saat lagi.
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