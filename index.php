<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $name=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $mail=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $cell=filter_var($_POST['cellphone'],FILTER_SANITIZE_NUMBER_INT);
    $msg=filter_var($_POST['message'],FILTER_SANITIZE_STRING);

    $errors=[];

    if(strlen($name)<3)
    {
        $errors[]="user name must be larger than <strong>3</strong> characters";
    }

    if(strlen($msg)<10)
    {
        $errors[]="message must be larger than <strong>10</strong> characters";
    }

    $headers='from: ' . $mail . '\r\n';

    if(empty($errors))
    {
        mail('mg6783256@gmail.com', 'Contact Form', $msg, $headers);
        $name='';$mail='';$cell='';$msg='';
        $success='<div class="alert alert-success">We Have Recieved Your Message</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index2.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700,900,900i">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Contact Me</h1>
        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
            <?php if(! empty($errors)){ ?>
                <div class="alert alert-danger alert-dismissible" role="start">
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            <?php foreach($errors as $error){echo "<br>" . $error ."<br>";} ?>
                </div>
            <?php }?>
            <?php if(isset($success)){echo $success;} ?>

            <div class="form-group">
                <input type="text" name="username" class="username form-control" placeholder="Type your Username" value="<?php if(isset($name)){echo $name;}?>">
                <i class="fa fa-user fa-fw"></i>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                     user name must be larger than <strong>3</strong> characters
                </div>
            </div>
            
            <div class="form-group">
                <input type="email" name="email" class="email form-control"  placeholder="Type your email" value="<?php if(isset($mail)){echo $mail;}?>">
                <i class="fa fa-envelope fa-fw"></i>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                     Email can not be <strong>Empty</strong>
                </div>
            </div>
            
            <div class="form-group">
                <input type="text" name="cellphone" class="form-control"  placeholder="Type your cellphone" value="<?php if(isset($cell)){echo $cell;}?>">
                <i class="fa fa-phone fa-fw"></i>
            </div>
            
            <div class="form-group">
                <textarea class="message form-control" name="message" placeholder="Your Message"><?php if(isset($msg)){echo $msg;}?></textarea>
                <div class="alert alert-danger custom-alert">
                      message must be larger than <strong>10</strong> characters
                </div>
            <div>
            
            <input class="btn btn-success" type="submit" value="Send Message">
            <i class="fa fa-paper-plane fa-fw send-icon"></i>
        </form>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>