<?php
header('Content-type: text/html; charset=utf-8');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'vendor/autoload.php';


use AmoCRM\{AmoAPI, AmoAPIException};
use AmoCRM\TokenStorage\TokenStorageException;

try {
    // Параметры авторизации по протоколу oAuth 2.0
    $clientId     = '9260bd1b-e893-4c40-8f21-c412b22b07d8';
    $clientSecret = 'yQ6Q1ds6DL0X8naYiVoIBQU9Ka8NMqDzbxL7t7xdk9z1JM6by2imGltpLrS1Deuf';
    $authCode     = 'def502004fbb7f264156fb6d4a864da8b1f59abb1ff002cf8b055b0c67203e02a3ecc52fd074b875c3bec830786af7de4d9ad78892e62bba0a73f172da0a5cb17aaefbd71cb795b1c8e61fb9cc274ee3774d0e8be26ee7972030c23670ce3698dd3f9199d6d798d03ccde2d39a8449e68336c08f1242e24bfd046cce507d618b2e5aaf0646f11805b59374fb095aca56f6ce4068c03d710dd6635b438b080cc48e38d061125433c21a64eedde3859d193bccc96f878b05148682795a891076395edb677b7a5ea08f0880c5203bf15b50c64c8d33f752f135403e2893604311932fea952d0ed03fa7905c2590c33e65c0dac2a33c6df66d595c73f9259e1bdc5d140522849fb059c18be736e33ec6aa130a9a2b130ae60303d0b32b25a1496111f70627ef25159bb1523c8b4751f0cb7fb14dfab58d72f8c38916f986465c60367cf32d1ce11b732dba33f1fa223c08aefe7ec90aa2cff3691eba31c99164ae19904ca4bb45a0e45bf21e8cd345f9844907efce579070975501ea889afd465c7516895f235200a4337f64277ef6bdca22ca74abaf8488ceb8260c95aba29770fc26055ea509b613ec9d75b48226584639e2401fb9b28bc4b714e1e84ae76e';
    $redirectUri  = 'https://georelief.ru';
    $subdomain    = 'georelief';

    // Первичная авторизация
    AmoAPI::oAuth2($subdomain, $clientId, $clientSecret, $redirectUri, $authCode);

    // Получение информации об аккаунте
    echo '<pre>';
    print_r(AmoAPI::getAccount('custom_fields,users,pipelines'));
    echo '</pre>';

} catch (AmoAPIException $e) {
    printf('Ошибка авторизации (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
} catch (TokenStorageException $e) {
    printf('Ошибка обработки токенов (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}