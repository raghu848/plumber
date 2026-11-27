<?php 
/* updatd script */
if (isset($_REQUEST['submit'])) {

$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$address1 = $_REQUEST['address1'];
$address2 = $_REQUEST['address2'];
$special_mention = $_REQUEST['special_mention'];

      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
	   // Google secret API
                $secretAPIkey = (require __DIR__ . '/secrets.php')['recaptcha_secret'];

                // reCAPTCHA response verification
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);


//Do you stuff
}
else
{
die("Robot verification failed, please try again.");

echo '<a href="/">Click here to go to home page</a>';
}
$msg_data = $_REQUEST['message'];

$to = "admin@hydrolinkplumbing.com.au";
$subject = "New Email Address for Mailing List";
$headers = "From: admin@hydrolinkplumbing.com.au\n";
$message = "A visitor to your site has sent the following email address to be added to your mailing list.\n

Name: $name \n 
Phone: $phone \n 
Email: $email \n 
Address Line 1: $address1 \n 
Address Line 2: $address2 \n 
Special Mention: $special_mention \n 
";
$usersubject = "Appointment";
$userheaders = "From: admin@hydrolinkplumbing.com.au \n";
mail($to,$usersubject,$message,$headers);

echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
  header("Location: thankyou.php");
}
/* updatd script */



?>