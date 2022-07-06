<?php
header('Content-type: text/html; charset=utf-8');
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/

require_once 'vendor/autoload.php';

/****************************************************************************************************/

$conf = array(
	"status"          => "36271051", // Статус сделки
	"pipeline"        => "3744658", // Воронка
	"responsibleUser" => "6510325", // Ответственный пользователь
	"phone"           => "211659", // Телефон
	"email"           => "211661", // Email
);

/****************************************************************************************************/

use AmoCRM\{AmoAPI, AmoContact, AmoLead, AmoNote, AmoAPIException};
use AmoCRM\TokenStorage\TokenStorageException;

try {

    // Последующие авторизации
    $subdomain = 'georelief';
    AmoAPI::oAuth2($subdomain);

    // Получение информации об аккаунте
    /*
    echo '<pre>';
    print_r(AmoAPI::getAccount('custom_fields,users,pipelines'));
    echo '</pre>';
    exit;
    */

} catch (AmoAPIException $e) {
    printf('Ошибка авторизации (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    exit;
} catch (TokenStorageException $e) {
    printf('Ошибка обработки токенов (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    exit;
}

/****************************************************************************************************/

$data = file_get_contents('php://input');

$url = urldecode($data);
parse_str($url, $arr);

$deal_info    = $arr['deal'];
$contact_info = $arr['contact'];

/*******************************************/

$lead = new AmoLead([
	'name'                => isset($deal_info['Название']) ? $deal_info['Название'] : 'Заявка УК',
	'responsible_user_id' => $conf['responsibleUser'],
	'pipeline'            => [ 'id' => $conf['pipeline'] ],
	'status_id'           => $conf['status'],
	//'sale'                => isset($deal_info['Бюджет']) ? $deal_info['Бюджет'] : 0,
]);

$lead_fields = [];

$lead->setCustomFields( $lead_fields );
$lead->addTags($deal_info['Тэг']);
$leadId = $lead->save();

/*******************************************/

$contact = new AmoContact([
	'name'                => isset($contact_info['Имя']) ? $contact_info['Имя'] : 'Без имени',
	'responsible_user_id' => $conf['responsibleUser']
]);

$contact->setCustomFields([
	$conf['phone'] => array([
		'value' => isset($contact_info['Телефон']) ? $contact_info['Телефон'] : '',
		'enum'  => 'WORK'
	]),
	$conf['email'] => array([
		'value' => isset($contact_info['Email']) ? $contact_info['Email'] : '',
		'enum'  => 'WORK'
	])
]);

$contact->addLeads([ $leadId ]);
$contactId = $contact->save();

/*******************************************/

$comment = '';
foreach($deal_info as $deal_key => $deal_val) {
	if( $deal_key == 'Название' ) continue;
	if( $deal_key == 'Франчайзи' ) continue;
	if( $deal_key == 'Бюджет' ) continue;
	if( $deal_key == 'Тип Клиента' ) continue;
	if( $deal_key == 'Город' ) continue;
	if( $deal_key == 'Тэг' ) continue;
	
	if( is_array($deal_val) ) {
		$comment .= $deal_key . ": " . implode(", ", $deal_val) . "\n\r";
	} else {
		$comment .= $deal_key . ": " . $deal_val . "\n\r";
	}
}

$note = new AmoNote([
	'element_id'   => $leadId,
	'note_type'    => AmoNote::COMMON_NOTETYPE,
	'element_type' => AmoNOTE::LEAD_TYPE,
	'text'         => $comment,
]);

$noteId = $note->save();

/*******************************************/

/*
echo '<pre>';
print_r($arr);
echo '<hr>';
echo '</pre>';
*/