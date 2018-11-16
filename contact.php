<?php

error_reporting(0);

if($_POST)
{
	$to_email  = "night.night.76@gmail.com"; //Recipient email, Replace with own email here
	
	//check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		
		$output = json_encode(array( //create JSON data
			'type'=>'error', 
			'text' => 'Sorry Request must be Ajax POST'
		));
		die($output); //exit script outputting json data
    } 
	
	//Sanitize input data using PHP filter_var().
	$user_fname		= filter_var($_POST["user_fname"], FILTER_SANITIZE_STRING);
	$user_email		= filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
	$user_numero		= filter_var($_POST["user_numero"], FILTER_SANITIZE_STRING);
	$user_message		= filter_var($_POST["user_message"], FILTER_SANITIZE_STRING);
	$user_servicios		= filter_var($_POST["user_servicios"], FILTER_SANITIZE_STRING);
	$subject		= $user_fname;
	$subject_2		= "Datos";
	
	
	
	//email body
    $Body = "";
    $Body .= "Nombre: ";
    $Body .= $user_fname;
    $Body .= "\n";
    $Body .= "Email: ";
    $Body .= $user_email;
    $Body .= "\n";
    $Body .= "Número telefónico: ";
    $Body .= $user_numero;
    $Body .= "\n";
    $Body .= "Mensaje: ";
    $Body .= $user_message;
    $Body .= "\n";
    $Body .= "Servicios: ";
    $Body .= $user_message;
    $Body .= "\n";
        //email auto responder
    $Body_2 = "";
    $Body_2 .= "Gracias por contactarnos";
    $Body .= "\n";
	
	//proceed with PHP email.
	$headers = 'From: '.$user_fname.'' . "\r\n" .
	'Reply-To: '.$user_email.'' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	
	$send_mail = mail($to_email, $subject, $Body, $headers);
	
	$headers_2 = 'From: '.$to_email.'' . "\r\n" .
	mail($user_email, $subject_2, $Body_2, $headers_2);
	if(!$send_mail)
	{
		//If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
		$output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
		die($output);
	}else{
		$output = json_encode(array('type'=>'message', 'text' => 'Gracias por registrarse'));
		die($output);
	}
}
?>