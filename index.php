<?php 

    $site_key = ''; // Diisi dengan site_key API Google reCapthca yang sobat miliki
    $secret_key = ''; // Diisi dengan secret_key API Google reCapthca yang sobat miliki


 
    if (isset($_POST['submit']))
    {
        if(isset($_POST['g-recaptcha-response']))
        {
            $api_url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response='.$_POST['g-recaptcha-response'];
            $response = @file_get_contents($api_url);
            $data = json_decode($response, true);
 
            if($data['success'])
            {
                $to = "email@mail.com"; // this is your Email address
                $from = $_POST['email']; // this is the sender's Email address
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $subject = "Form submission";
                $subject2 = "Copy of your form submission";
                $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
                $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

                $headers = "From:" . $from;
                $headers2 = "From:" . $to;
                mail($to,$subject,$message,$headers);
                mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
                $success = true;
                //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
                // You can also use header('Location: thank_you.php'); to redirect to another page.
            }
            else
            {
                $success = false;
            }
        }
        else
        {
            $success = false;
        }
    }
?>




<!DOCTYPE html>
<head>
<title>Contact US | SkyLight Animation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style type="text/css">
    .importantLable{color: #d60606}
    .contactPage{padding: 20px}
    .messageBox{margin: 10px 0}
    .widthInput{width: 100%}
    .inputForm{margin: 10px 0}
    .myform-control{
        display: block;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
    
    body{padding:20px;}
    h1{padding: 0 10px;color: rgba(66,133,244,1);}
    h3{padding: 0 20px;}
  
</style>
</head>
<body>
  <?php if (isset($success)) {
            if ($success==true) { ?>
                <div class="alert alert-success"><?php echo "Terima Kasih, Message Berhasil Terkirim..."; ?></div>
            <? } else { ?>
            <div class="alert alert-danger"><?php echo "Gagal!, Mohon lengkapi form dan Captcha yang tersedia!!!"; ?></div>
            <?php } } ?>
<form class="container thumbnail" action="" method="post">
    
    <h1>Contact Us<small> <i>ReBuild Irregular ANime</i></small></h1>
    

        <div class="col-md-6 col-sm-6 inputForm">
            <label>First Name<span class="importantLable"> *</span></label>
            <input type="text" name="first_name" class="myform-control col-md-6 widthInput"><br>
        </div>
            <div class="col-md-6 col-sm-6 inputForm">
            <label>Last Name <span class="importantLable"> *</span></label>
            <input type="text" name="last_name" class="myform-control col-md-6 widthInput"><br>
        </div>
        <div class="col-md-12 inputForm">
            <label>Email<span class="importantLable"> *</span></label>
            <input type="text" name="email" class="myform-control col-md-6 widthInput"><br>
        </div>
        <div class="col-md-12 messageBox">
            <label>Message<span class="importantLable"> *</span></label>
            <textarea rows="5" name="message" cols="30" class="col-md-12 col-sm-12 col-xs-12 col-lg-12"></textarea><br>
  
           
        </div>
        <div class="col-md-12 col-sm-12 inputForm">
            <center>
                <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div></center>
                      
        </div>
        <div class="col-md-12 col-sm-12 inputForm">
            <center><input type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary"></center>
        </div>
</form>

</body>
</html> 
