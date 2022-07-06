<?php
// www.georelief.ru/?utm_source=yandex
// www.georelief.ru/?utm_source=google


if( isset($_GET['utm_source']) && $_GET['utm_source'] == 'yandex' ) {
	$phone = '+7 (928) 421-77-73';
} else if( isset($_GET['utm_source']) && $_GET['utm_source'] == 'google' ) {
	$phone = '+7 (938) 294-77-78';
} else {
	$phone = '+7 (861) 290-77-22';
}