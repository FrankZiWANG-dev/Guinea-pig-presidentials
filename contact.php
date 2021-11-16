<?php
include_once "parts/nav.php";

//import phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

// check if field filled
if(filter_has_var(INPUT_GET, 'submit')){
    //variables
    $firstName = $_GET["firstName"];
    $lastName = $_GET["lastName"];
    $email = $_GET["email"];
    $message = $_GET["message"];
    $subject = $_GET["subject"];

    $variables = array ($firstName, $lastName, $email, $message);
    $error= "Please fill this field in.";

    //if all fields filled in but honeypot field empty
    if (!empty($firstName) AND !empty($lastName) AND !empty($email) AND !empty($message) AND empty($honey)){
        //if doesn't currently display error message
        if ( ($firstName !== $error) AND ($lastName !== $error) AND ($email !== $error) AND ($message !== $error) ){
            //sanitize
            for ($x=0; $x<sizeof($variables); $x++){
                if ($variables[$x]== $email){
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                }
                else if ($variables[$x] == $message){
                    continue;
                }
                else{
                    $variables[$x] = filter_var($variables[$x], FILTER_SANITIZE_STRING);
                }
            }
        
            //validate
            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL) == true){
                $phpmailer = new PHPMailer(true);
                try {
                    $phpmailer->isSMTP();
                    $phpmailer->Host = 'smtp.mailtrap.io';
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->Port = 2525;
                    $phpmailer->Username = '3a523c273edefe';
                    $phpmailer->Password = 'd6c06b4ce1aea8';
                
                    $phpmailer->setFrom($email, 'Guinea pig presidentials');
                    $phpmailer->addAddress('frankziwang.dev@gmail.com');
            
                    $phpmailer->isHTML(true);
                    $phpmailer->Subject = 'Guinea pig presidentials - ' .$subject;
                    $phpmailer->Body    = '<h2> Someone used the contact form on Guinea Pig Presidentials </h2>
                    <p>'.$message.'</p>';

                    $phpmailer->send();
                    echo "<script type='text/javascript'>alert('Your message was delivered!');</script>";
                }
                catch (Exception $e) {
                    echo "<script type='text/javascript'>alert('Sorry, there seems to be an error...');</script>";
                }
            }
        }
    }  
}   

//check and display message in field if field is empty
function checkEmpty($field){
    if(filter_has_var(INPUT_GET, 'submit')){
        if (empty($field) == true){
            echo 'value="Please fill this field in." style="color:red" ';
        }
    }
}

//function to display message in email field if invalid email
function invalidEmail(){
    if (filter_var(trim($_GET["email"]), FILTER_VALIDATE_EMAIL) == false AND !empty($_GET["email"]) AND $_GET["email"]!=="Please fill this field in."){
        echo 'value="Please use a valid email adress." style="color:red; font-weight:bold"';
    }
}

?>

<link rel="stylesheet" href="assets/css/contact.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
</head>
<body>

<div id="intro" role="introduction-text">
<h1> Contact us ! </h1>
<p> Got a question or a comment about the project?</p>
<p>Need to report a bug? Please get in touch !</p>
</div>

<div id="container" role="contact-section">

<form method="post" id='form' action="contact.php" role="contact-form">
    
        <label for="firstName"> First Name: </label>
        <input type="text" name="firstName" placeholder='Type in your first name' onfocus="this.value=''" <?php checkEmpty($firstName);?> >
        <br/>
        <label for="lastName"> Last Name: </label>
        <input type="text" name="lastName" placeholder='Type in your last name' onfocus="this.value=''" <?php checkEmpty($lastName);?> >
        <br/>
        <label for="email"> E-mail: </label>
        <input type="text" name="email" placeholder='Type in your email address' onfocus="this.value=''" <?php checkEmpty($email); invalidEmail();?> > 
        <br/>
        <label for="subject"> Subject: </label>
        <select name = "subject">
            <option value="Question" selected> Question about the project </option>
            <option value="Comment"> Comment about the project </option>
            <option value="Bug"> Report a bug </option>
        </select>
        <br/>
        <label for="message"> Message: </label>
        <input type="text" name="message" placeholder='Type in your message' id="message" <?php checkEmpty($message);?> >
        <br/>
    <button type="submit" form='form' name="submit" onClick='return confirmSubmit()'>Let's have a chat ! </button>
   

</form>
</div>

<?php
include_once "parts/footer.php";
?>