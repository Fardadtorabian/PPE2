<?php
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Thank you for contact us. As early as possible  we will contact you'
	);

    

    $entreprise       = @trim(stripslashes($_POST['entreprise'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $sujet    = @trim(stripslashes($_POST['sujet'])); 
    $message    = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'fardad.torabian@gmail.com';//replace with your email

    $body = 'Entreprise: ' . $entreprise . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $sujet . "\n\n" . 'Message: ' . $message;

    $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

    echo json_encode($status);
    die;
?>
