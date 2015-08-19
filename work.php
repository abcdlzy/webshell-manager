<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 14/12/2
 * Time: 下午4:37
 */
include_once 'Crypt/RSA.php';
include_once 'DataTransport.php';

$rsa = new Crypt_RSA();
static $privateKey;
$rsa->createKey(2048);



$trans=new DataTransport();

$PK="-----BEGIN PUBLIC KEY----- MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCfZJsfjJeuWAls6PHla82tM/Ht /YarqH73AVkS4bTzLkdxyIsz7/NxaMo8tOXsR5HEG8gKMP+i0txo18ydA2Q7AqJ4 ESzhZ9EwiU4JrxhIfDQCuaWZSanU3ECyvzAqNyjY/gws1oaigCd6hSRQAvqrbJSG via9fTBxHM+SETb00QIDAQAB -----END PUBLIC KEY-----";

$rsa->loadKey($PK);

if($trans->start('http://localhost:63342/untitled/echo.php',array('data'=>$rsa->encrypt('123'))))
{
    echo $trans->response;
}
else
{
    echo $trans->errMsg;
}


?>