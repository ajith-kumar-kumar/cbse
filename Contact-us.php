<?php include 'header.php'; ?>

<nav aria-label="breadcrumb" >
	<ol class="breadcrumb text-uppercase">
		<h2 class="h2-responsive ml-5 mt-4 font-weight-bold" >
			COntact
			
		</h2>
		<li class="breadcrumb-item ml-auto">
			home
			
		</li>
		<li class="breadcrumb-item" >
			contact
			
		</li>
		
	</ol>
	
</nav>


<section class="my-5">
	<h2 class="h1-responsive font-weight-bold  text-center my-5">Contact <span class="text-span"> us</span></h2>
	<p class="text-center w-responsive mx-auto pb-5 desc">
		Not sure where to start? Visit our help center to get answers to your queries.
	</p>


	<div class="container">
	<div class="row " >
    <div class="col-lg-5 mb-lg-0 mb-4 ">
			<div class="card" >
				<div class="card-body">
					<form method="POST">
					<div class="contact-head  ">

					<h3 class="h3-responsive mt-3 "><i class="fa fa-envelope">&emsp;</i>Write us to</h3> </div>
					<p class="dark-grey-text mt-3 text-center">
						We'll write rarely, but only the best content.
					</p>
					<div class="md-form">
                        <i class="fa fa-user prefix red-text "></i>
                        <input type="text" id="form-name" name="tname" required class="form-control">
                        <label for="form-name">Your name</label>

					 </div>
					<div class="md-form">
						<i class="fa fa-envelope prefix red-text  " ></i>
						<input type="email" name="email" id="form-email" required class="form-control">
						<label for="form-email">Your Mail</label>
					</div>
					<div class="md-form">
						<i class="fa fa-phone prefix red-text "></i>
						<input type="tel" name="subject" id="form-subject" required class="form-control">
						<label for="form-subject">Your Phone number</label>
					</div>
					<div class="md-form">
						<i class="fa fa-pencil prefix red-text " ></i>
						<textarea class="form-control md-textarea "  required name="msg" rows="3"></textarea>
						<label for="form-text">your message</label>
						
					</div>
					<div class="text-center">
						<button type="submit" name="submit"  id=
						"submit"  class="btn nav-red">submit</button>
						</form>
					</div>
				</div>
			</div>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['submit'])) {
	# code...

//Load Composer's autoloader
//require 'vendor/autoload.php';
require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mailtoanjanainfotech@gmail.com';                 // SMTP username
    $mail->Password = 'anjana221015';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; 
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);                                   // TCP port to connect to

    //Recipients
    $mail->setFrom('mailtoanjanainfotech@gmail.com', 'Ajith Kumar');
$mail->addAddress('mailtoanjanainfotech@gmail.com', 'Ajith Kumar');     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('mailtoanjanainfotech@gmail.com', 'ajith kumar');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     //<img src=\"cid:logoimg\"/>
     $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'SRI AYYAN KENDRA VIDYALAYA INTERNATIONAL SCHOOL';
  $mail->Body = "
       
        <hr>
        
    <h1>  HEY! ADMIN <span style='text-transform:capitalize;'> you got a new feedback</span> </h1>
    <p style='margin-left:40px; font-style: italic; font-family:Times New roman'> You Have Got a New Subscriptions</p>
    

<div style='margin-left:60px;'>
<b style=font-size:15px; >Name:  </b>&nbsp;&nbsp;&nbsp;{$_POST['tname']}<br>
<b style=font-size:15px; >Email:  </b>&nbsp;&nbsp;&nbsp;{$_POST['email']}<br>
<b style=font-size:15px;>subject: </b >&nbsp;&nbsp;&nbsp;{$_POST['subject']}<br>
<b style=font-size:15px;>Message:  </b >&nbsp;&nbsp;&nbsp;{$_POST['msg']}<br>


</div>";
    //Content
   
  

    if($mail->send()){


   echo "<script> alert('your message has been sucessfully  sent'); </script>";


}
else{
	echo "<script> alert('not send'); </script>";
}
}

?>
</div>
         <div class="col-lg-7">
         	<div id="map-container" class="rounded z-depth-1 half map-container" style="height: 400px;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3935.65375452724!2d77.55201551434757!3d9.451728793228337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b06e9d3a521a97f%3A0x8444ee0626c630cb!2sAnjana+Infotech!5e0!3m2!1sen!2sin!4v1543280869154" height="100%" width="100%"frameborder="0" style="border:0" allowfullscreen></iframe></div><br>


         	<div class="row text-center">
         		<div class="col-md-4">
         			<a  class="btn btn-danger	 white-background primary ">

         		<i class="fa fa-2x fa-map-marker"> </i>
         		</a>
         		<p class="desc">R.R Nagar North Street <br> Kalangaperi</p>
	<!--                   <p class="desc font-weight-bold">Our Address</p>
 -->         		</div>
         		<div class="col-md-4">
         			<a  class=" btn btn-danger primary white-background">
         				<i class="fa fa-2x fa-phone"></i>
         			</a>
         			<p class="desc"> 9150438779</p>
<!--          			<p class="mb-md-0 font-weight-bold desc mt-4"> Help Line</p>
 -->         		</div>
         		<div class="col-md-4">
         			<a class="btn btn-danger primary white-background">
         				<i class="fa fa-2x fa-envelope"></i>
         			</a>
         			<p class="desc">sakvschool@gmail.com</p>
<!--          			<p class="mb-0 desc font-weight-bold mt-3"> Our Mail</p>
 -->         		</div>
         		</div>
         	</div>
         </div>
</div>

		
		
	
</section>
<?php include 'footer.php'; ?>