<?php


session_start();
// переменная, в которую будем сохранять результат работы
$data['result']='error';
function validStringLength($string,$min,$max) {
	$length = mb_strlen($string,'UTF-8');
	if (($length<$min) || ($length>$max)) {
		return false;
	}
	else {
		return true;
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
		$password = $_POST['password'];
		if (!validStringLength($password,2,30)) {
			$data['password']='The password field contains an invalid number of characters';
			$data['result']='error';
		}
	} else {
		$data['result']='error';
	}
	if (isset($_POST['checkbox'])) {
		$checkbox = $_POST['checkbox'];
		
		$data['checkbox']='Chesboks not marked';
		$data['result']='error';
		
	} else {
		$data['result']='error';
	}
	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['checkbox'])){
		
		$to = "7yatan@gmail.com";
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$checkbox = trim($_POST['checkbox']);
		$subject = "A letter from your site http://".$_SERVER["HTTP_HOST".""];
		$header ="From<".$email.">\r\nContent-type: text/plain; charset=utf-8\r\n";
		mail($to, $subject, $headers)
		
	}	else {
		$data['result']='error';
	}      
}
return $data; 
?>