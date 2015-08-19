<?php
include_once(dirname(__FILE__).'/Crypt/AES.php');
include_once(dirname(__FILE__).'/Crypt/Random.php');
include_once(dirname(__FILE__).'/config.php');
include_once(dirname(__FILE__).'/common.php');
include_once(dirname(__FILE__).'/CASignCert.php');
include_once(dirname(__FILE__).'/DBAdopt/_class/BLL/operator.php');
session_start();

/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/1/20
 * Time: 下午1:22
 */

ini_set('mbstring.internal_encoding','UTF-8');
ini_set('mbstring.func_overload',7);
header('Content-Type: text/html; charset=UTF-8');


//开始处理数据
@$isforceEncrypt=$_POST["forceEncrypt"];//用于跨CA的数据跳转
@$action=$_POST["action"];
@$interfaceData=$_POST["data"];

if($action==="GetPublishX509")
{
    GetPublishX509();
    echo ',';
    echo create_guid();
}
else if($action==="UILoginStart")
{
    $_SESSION['AESKEY']=bin2hex(crypt_random_string(8));
    echo $_SESSION['AESKEY'];

}
else if($action==="UIdoLogin")
{
    UIdoLogin($interfaceData);
}
else if($action==="doGetCertStep2")
{
    doGetCertStep2($interfaceData);
}
else if($action==="doGetCertStep4")
{
    doGetCertStep4($interfaceData);
}
else if ($action==="UIFinishLogin")
{
    UIFinishLogin();
}
else if ($action==="deleteSignCert")
{
    deleteSignCert($interfaceData);
}
else if ($action==="insertShell")
{
    insertShell($interfaceData);
}
else if ($action==="updateShell")
{
    updateShell($interfaceData);
}
else if ($action==="deleteShell")
{
    deleteShell($interfaceData);
}
else if ($action==="getServerGUID")
{
    getServerGUID();
}
else if ($action==="requestGUIDPEM") {
    requestGUIDPEM($interfaceData);
}
else if ($action==="getActiveServerList")
{
    getActiveServerList($interfaceData);
}
else if ($action==="randOneActiveServer")
{
    randOneActiveServer();
}
elseif($action==="modifyPassword"){
    checkLogin();
    modifyPassword($interfaceData);
}
elseif($action==="remakeCAKey"){
    checkLogin();
    remakeCAKey();
}
elseif($action==="saveSysMySQLSetting"){
    checkLogin();
    saveSysMySQLSetting($interfaceData);
}
else{
    echo '404';
}

function saveSysMySQLSetting($data){
    $dataArray=explode(",",$data);
    setConfig_MySQL_Host($dataArray[0]);
    setConfig_MySQL_UserName($dataArray[1]);
    setConfig_MySQL_Password($dataArray[2]);
    setConfig_MySQL_DataBase($dataArray[3]);
    echo 'end';
}
function remakeCAKey(){
    echo CreateNewCA()?"successful":"failed";
}

function modifyPassword($data){
    $dataArray=explode(",",$data);
    count($dataArray)===3 or die('length check error');
    if($dataArray[0]===getConfig_LoginPassword()){
        if($dataArray[1]===$dataArray[2]){
            setConfig_LoginPassword($dataArray[2]);
            echo 'successful';
        }
        else{
            echo '重复新密码校验失败';
        }
    }
    else{
        echo '旧密码填写错误';
    }
}

function randOneActiveServer(){
    $rs=SQLAdopt::getOne(new activeServerModel('rand','',''));
    echo $rs->GUID.",".$rs->interfaceURL;
}

function getActiveServerList($data){
    $decodeData=unpacketInAESData($data);
    $model=new activeServerModel(splitByComma($decodeData)[0],splitByComma($decodeData)[1],'');
    echo SQLAdopt::insert($model);
    echo get_ActiveServerAllJson();
}

function requestGUIDPEM($packetGUID){
    $reciveGUID=splitByComma($packetGUID)[0];

    echo response_PemOut($reciveGUID,unpacketInAESData($packetGUID));
}

function getServerGUID(){
    echo getConfig_SelfGUID();
}

function UIdoLogin($data)
{
    $data1=$data;
    try{

        if(@isset($_SESSION['AESKEY'])&&@isset($_SESSION['AESIV'])){
            $data1=AESDecrypt($data,$_SESSION['AESKEY'],$_SESSION['AESIV']);

        }
    }catch (Exception $e){

    }



    $dataArray=preg_split("/[\s,]+/", $data1);
    $host=$dataArray[0];
    $passwd=$dataArray[1];
    if($GLOBALS['loginPassWord']===$passwd){
        if(!isset($_SESSION['host'])){
            $_SESSION['host']=$host;
            $_SESSION['passwd']=$passwd;
        }
        UIFinishLogin();
    }
    else
    {
        echo 'failed';
    }
}

function GetPublishX509(){
    if($GLOBALS['isCA']==true) {
        if(isset($GLOBALS['CAPubX509'])){
            echo $GLOBALS['CAPubX509'];
        }
       else{
           echo 'CA Public X509 is not set';
       }

    }else{
        echo 'this is not CA';
    }
}

function doGetCertStep2($data){
    //todo s=>c enc by aes (privatekey,x509)
    //是否设置

    if(isset($GLOBALS['CAPrivKeyStr'])){
        //解密
        $decryptData= RSADecrypt($data,$GLOBALS['CAPrivKeyStr']);
        //分割
        $dataArray=preg_split("/,{1,1}/", $decryptData);
        $key=$dataArray[0];
        $iv=$dataArray[1];

        //生成证书
        $newCert=requestSignCert();
        //生成GUID
        $userGUID= create_guid();
        //写入记录进入数据库
        $certmodel=new certModel($userGUID,getip(),$newCert['publicX509'],'');
        SQLAdopt::insert($certmodel);

        if(count($dataArray)==3){
            $clientIURL=$dataArray[2];
            $acitveServermodel=new activeServerModel($userGUID,$clientIURL,'');
            SQLAdopt::insert($acitveServermodel);
        }

        //返回数据
        $returnStr=$userGUID.",".$newCert['privateKey'].",".$newCert['publicX509'].",".getConfig_CAGUID();
        //加密
        echo AESEncrypt($returnStr,$key,$iv);
    }
    else{
        echo 'It look like is not CA';
    }
}

function doGetCertStep4($data){
    //解密
    $decryptData= RSADecrypt($data,$GLOBALS['CAPrivKeyStr']);
    //分割

    $usercert=SQLAdopt::getOne(new certModel($decryptData,'','',''));
    if(!empty($usercert)){
        $keyII=md5(uniqid(mt_rand(), true));
        $ivII=md5(uniqid(mt_rand(), true));
        $_SESSION['AESKEY']=$keyII;
        $_SESSION['AESIV']=$ivII;
        save_AESKeyIV($decryptData,$keyII,$ivII,'in');
        save_AESKeyIV($decryptData,$keyII,$ivII,'out');
        echo RSAEncrypt($keyII.','.$ivII,$usercert->x509);
    }
    else{
        echo 'noEncrypt';
    }
}



function requestSignCert(){
    if($GLOBALS['isCA']==true){
        if(!(isset($GLOBALS['CAPrivKeyStr'])&&!is_null($GLOBALS['CAPrivKeyStr'])&&isset($GLOBALS['CAPubX509'])&&!is_null($GLOBALS['CAPubX509']))){
            CreateNewCA();
        }
        return signNewCert();
    }
    else{
        return false;
    }

}



function UIFinishLogin(){
    $_SESSION['loginToken']=create_guid();
    echo $_SESSION['loginToken'];
}

function deleteSignCert($data){
    $dataArray=preg_split("/,{1,1}/", $data);
    $reciveToken=$dataArray[0];
    $CertGUID=$dataArray[1];
    if($reciveToken===$_SESSION['loginToken']){
        SQLAdopt::delete(new certModel($CertGUID,'','',''));
    }
    echo 'completed';
}

function deleteShell($data){
    $dataArray=preg_split("/,{1,1}/", $data);
    $reciveToken=$dataArray[0];
    $shellUrl=$dataArray[1];
    if($reciveToken===$_SESSION['loginToken']){
        SQLAdopt::delete(new shellModel($shellUrl,'','','',''));
    }
    echo 'completed';
}

function insertShell($data){
    $dataArray=preg_split("/,{1,1}/", $data);
    //loginToken+","+url+","+pass+","+type+","+extraConfig+","+notes
    $reciveToken=$dataArray[0];
    $url=$dataArray[1];
    $pass=$dataArray[2];
    $type=$dataArray[3];
    $extraConfig=$dataArray[4];
    $notes=$dataArray[5];
    if($reciveToken===$_SESSION['loginToken']){
        SQLAdopt::insert(new shellModel($url,$pass,$extraConfig,$notes,$type));
    }
    echo 'completed';
}

function updateShell($data){
    $dataArray=preg_split("/,{1,1}/", $data);
    //loginToken+","+url+","+pass+","+type+","+extraConfig+","+notes
    $reciveToken=$dataArray[0];
    $url=$dataArray[1];
    $pass=$dataArray[2];
    $type=$dataArray[3];
    $extraConfig=$dataArray[4];
    $notes=$dataArray[5];
    if($reciveToken===$_SESSION['loginToken']){
        SQLAdopt::update(new shellModel($url,$pass,$extraConfig,$notes,$type));
    }
    echo 'completed';
}

function checkLogin(){
    if(isset($_POST['Token'])) {
        if (@$_POST['Token'] === $_SESSION['loginToken']) {
            return true;
        }
        else{
            die('need login');
        }
    }
    else{
        die('Token Need Set');
    }
}




?>