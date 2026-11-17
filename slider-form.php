<?php 
/* updatd script */
if (isset($_REQUEST['submit'])) {

$nam = $_REQUEST['name'];
$mal = $_REQUEST['email'];
$phn = $_REQUEST['phone'];
$ser = $_REQUEST['service'];
$sub = $_REQUEST['suburb'];
      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
	   // Google secret API
                $secretAPIkey = '6LdDqEYqAAAAAA8DILKFFqPz-j1_y-h5NiZA8hLi';

                // reCAPTCHA response verification
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);


//Do you stuff
}
else
{
die("Robot verification failed, please try again.");

echo '<a href="index.php">Click here to go to home page</a>';
}
$msg_data = $_REQUEST['message'];

$to = "admin@hydrolinkplumbing.com.au";
$subject = "New Email Address for Mailing List";
$headers = "From: admin@hydrolinkplumbing.com.au\n";
$message = "A visitor to your site has sent the following email address to be added to your mailing list.\n

Name: $nam \n 
Email: $mal \n 
Phone: $phn \n 
Service: $phn \n 
Suburb: $sub \n 
";
$usersubject = "Get A Quote";
$userheaders = "From: admin@hydrolinkplumbing.com.au \n";
mail($to,$usersubject,$message,$headers);

echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
  header("Location: thankyou.php");
}
/* updatd script */



?>