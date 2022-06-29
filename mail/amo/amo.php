<?php 
header('Content-type: text/html; charset=utf-8');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'vendor/autoload.php';

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
    */

} catch (AmoAPIException $e) {
    printf('Ошибка авторизации (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    exit;
} catch (TokenStorageException $e) {
    printf('Ошибка обработки токенов (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    exit;
}

/****************************************************************************************************/

$conf = array(
	"status"          => "36271051", // Статус сделки
	"pipeline"        => "3744658", // Воронка
	"responsibleUser" => "6510325", // Ответственный пользователь
	"phone"           => "211659", // Телефон
	"email"           => "211661", // Email
	"tags"            => array('сайт', 'georelief'), // Теги
	
	"utm_source"   => "308713",
	"utm_medium"   => "308715",
	"utm_campaign" => "308717",
	"utm_content"  => "308719",
	"utm_term"     => "308721",
);




/****************************************************************************************************/

$lead = new AmoLead([
	'name'                => $subject,
	'responsible_user_id' => $conf['responsibleUser'],
	'pipeline'            => [ 'id' => $conf['pipeline'] ],
	'status_id'           => $conf['status'],
	//'sale'                => 15000
]);

$lead_fields = [
	$conf['utm_source']   => $user['utm_source'],
	$conf['utm_medium']   => $user['utm_medium'],
	$conf['utm_campaign'] => $user['utm_campaign'],
	$conf['utm_content']  => $user['utm_content'],
	$conf['utm_term']     => $user['utm_term'],

	'258381' => $user['device'],
	'258383' => $user['form'],
];




// Источник
if( $user['referer'] == 'yandex' ) {

	$lead_fields['257785'] = '352787'; //Яндекс
	array_push($conf['tags'], 'Яндекс');

} else if( $user['referer'] == 'google' ) {

	$lead_fields['257785'] = '352789'; //Гугл
	array_push($conf['tags'], 'Гугл');

}


$lead->setCustomFields( $lead_fields );
$lead->addTags( $conf['tags'] );
$leadId = $lead->save();

/****************************************************************************************************/

$contact = new AmoContact([
	'name'                => $user['name'],
	'responsible_user_id' => $conf['responsibleUser']
]);

$contact->setCustomFields([
	$conf['phone'] => [[
		'value' => $user['phone'],
		'enum'  => 'WORK'
	]],
	$conf['email'] => [[
		'value' => $user['email'],
		'enum'  => 'WORK'
	]]
]);

$contact->addLeads([ $leadId ]);

$contactId = $contact->save();

/****************************************************************************************************/

/*
$note = new AmoNote([
	'element_id'   => $leadId,
	'note_type'    => AmoNote::COMMON_NOTETYPE,
	'element_type' => AmoNOTE::LEAD_TYPE,
	'text'         => $comment,
]);

$noteId = $note->save();
*/

