<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 14/12/11
 * Time: 上午10:27
 */
include_once 'Crypt/AES.php';

//结构
$fileStart='<!doctype html><title>404 Not Found</title><h1>404 Not Found</h1> <?php Header("HTTP/1.1 404 Not Found");@header("status: 404 not found");exit();  /**';
$fileEnd="*/ ?>";



function fileWrite($data,$key){
    $file=fopen("data.php","w+");
    $aes = new Crypt_AES();
    $aes->setKey($key);
    if($file){
        fwrite($file,$GLOBALS["fileStart"].$aes->encrypt($data).$GLOBALS["fileEnd"]);
    }
    fclose($file);
}

function fileRead($key){
    $file=fopen("data.php","r");
    $aes = new Crypt_AES();
    $aes->setKey($key);
    $tempdata="";
    if($file){
        $tempdata=file_get_contents("data.php");
        $tempdata=substr($tempdata,strlen($GLOBALS["fileStart"]));
        $tempdata=$aes->decrypt(substr($tempdata,0,-strlen($GLOBALS["fileEnd"])));
    }
    fclose($file);
    return $tempdata;
}

?>