<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**********************  Settings ****************************/

$admin_email    = "info@georelief.ru"; //geo-relief@mail.ru

// SMTP
// $email_host     = "smtp.yandex.ru";
// $email_port     = "465";
// $email_login    = "";
// $email_password = "";

$subject = "Заявка с сайта «georelief.ru»";

$user = array(
	// Основные поля
	'name'  => isset($_POST["name"])  ? $_POST["name"]   : "",
	'phone' => isset($_POST["phone"]) ? $_POST["phone"]  : "",
	'email' => isset($_POST["email"]) ? $_POST["email"]  : "",
	
	'device'  => isset($_POST["device"])  ? $_POST["device"]   : "",
	'form'    => isset($_POST["form"])    ? $_POST["form"]     : "",
	'referer' => isset($_POST["referer"]) ? $_POST["referer"]  : "",

	'utm_source'   => isset($_POST["utm_source"])   ? $_POST["utm_source"]    : "",
	'utm_medium'   => isset($_POST["utm_medium"])   ? $_POST["utm_medium"]    : "",
	'utm_campaign' => isset($_POST["utm_campaign"]) ? $_POST["utm_campaign"]  : "",
	'utm_content'  => isset($_POST["utm_content"])  ? $_POST["utm_content"]   : "",
	'utm_term'     => isset($_POST["utm_term"])     ? $_POST["utm_term"]      : "",
);

if( trim($user['name']) == '' && trim($user['phone']) == '' ) {
	exit;
}


/************ проверка на дубли *************/
if( file_exists('last.txt') ) {
	$last = file_get_contents('last.txt');
	if( $user['phone'] == $last) exit;
}
file_put_contents('last.txt', $user['phone']);
/********************************************/

$dict = array(
	// Основные поля
	'name'  => 'Имя',
	'phone' => 'Телефон',
	'email' => 'Email',
	
	'device'  => 'Устройство',
	'form'    => 'Форма',
	'referer' => 'Источник',

	'utm_source'   => 'utm_source',
	'utm_medium'   => 'utm_medium',
	'utm_campaign' => 'utm_campaign',
	'utm_content'  => 'utm_content',
	'utm_term'     => 'utm_term',
);

$body  = "<!DOCTYPE html>";
$body .= "<html><head>";
$body .= "<meta charset='UTF-8' />";
$body .= "<title>".$subject."</title>";
$body .= '</head><body><table cellspacing=0 style="border:1px solid #ccc;">';

foreach ($user as $key => $value) {
	if ( !$value ) continue;

	$body .= '<tr><td style="padding:5px 30px 5px 10px;border:1px solid #ccc;font-weight:bold;">' . $dict[$key] . ': </td>';
	$body .= '<td style="padding:5px 30px 5px 10px;border:1px solid #ccc;">' . $value . '</td></tr>';
}

$body .= "</table></body></html>";

/************************************************************/

date_default_timezone_set("Europe/Moscow");

require "mailer/PHPMailerAutoload.php";
$mail = new PHPMailer();

if ( file_exists("/language/phpmailer.lang-ru.php") ) 
	$mail->SetLanguage("ru", "/language/");
else 
	$mail->SetLanguage("en", "/language/");

// SMTP
// $mail->isSMTP();
// $mail->Host = $email_host;
// $mail->Port = $email_port;
// $mail->SMTPAuth = true;
// $mail->Username = $email_login;
// $mail->Password = $email_password;

$mail->CharSet = "UTF-8";
$mail->setFrom($admin_email, $admin_email);
$mail->addReplyTo($admin_email, $admin_email);
$mail->Subject = $subject;
$mail->isHTML(true);

$mail->msgHTML($body);

if ( isset($_FILES['file1']) ) {
	if($_FILES['file1']['error'] == 0) {
		$mail->AddAttachment($_FILES['file1']['tmp_name'], $_FILES['file1']['name']); 
	} 
}

$mail->addAddress($admin_email, $admin_email);

if ( !$mail->send() ) {
	$output = $mail->ErrorInfo;
} else {
	$output = "Mail send OK";
}

echo $output;


/**************************************************/

// Amo integration
require_once 'amo/amo.php';


/**************************************************/