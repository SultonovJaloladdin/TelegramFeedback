<?php

if($_POST['name']!="" && $_POST['email']!="" && $_POST['subject']!="" && $_POST['message']!="")
{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
}
else{
	header('Location:index.php');
	exit;
}
$url = 'index.php';
function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$token = ""; //input your token
$chat_id = ""; //input your id

$arr = array(
   'User Name: '=> $name,
   //'Ip:' => getIp(),
   'Email: '=> $email,
   'Subject: '=> $subject,
   'Message: '=> $message,
);

foreach ($arr as $key => $value) {
	$txt .= "<i>".$key."</i> ".$value."%0A";
}
    
$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

if($sendToTelegram)
{
    header("Location: index.php");
    echo '<script language="javascript">';
    echo 'alert("message successfully sent")';
    echo '</script>';
    exit;
   //return true;

}else{
   echo '<h1> Do not send the comments . Try after some minute!</h1>';
}

?>