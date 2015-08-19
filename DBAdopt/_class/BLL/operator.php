<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午6:52
 */

require_once(dirname(__FILE__) . '/../../../config.php');
require_once(dirname(__FILE__) . '/../../../common.php');
require_once(dirname(__FILE__) . '/../../file.php');
require_once(dirname(__FILE__) . '/../../mssql.php');
require_once(dirname(__FILE__) . '/../../mysql.php');
require_once(dirname(__FILE__) . '/../../sqlite.php');

include_once(dirname(__FILE__) . '/../Model/baseModel.class.php');

//证书
include_once(dirname(__FILE__) . '/../Model/certModel.class.php');
include_once(dirname(__FILE__) . '/../IDAL/certIDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/cert/cert_mysqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/cert/cert_mssqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/cert/cert_sqliteDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/cert/cert_fileDAL.class.php');

//活动服务器
include_once(dirname(__FILE__) . '/../Model/activeLinkModel.class.php');
include_once(dirname(__FILE__) . '/../IDAL/activeLinkIDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeLink/activeLink_mysqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeLink/activeLink_mssqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeLink/activeLink_sqliteDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeLink/activeLink_fileDAL.class.php');

//活动链接
include_once(dirname(__FILE__) . '/../Model/activeServerModel.class.php');
include_once(dirname(__FILE__) . '/../IDAL/activeServerIDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeServer/activeServer_mysqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeServer/activeServer_mssqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeServer/activeServer_sqliteDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/activeServer/activeServer_fileDAL.class.php');

//shell
include_once(dirname(__FILE__) . '/../Model/shellModel.class.php');
include_once(dirname(__FILE__) . '/../IDAL/shellIDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/shell/shell_mysqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/shell/shell_mssqlDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/shell/shell_sqliteDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/shell/shell_fileDAL.class.php');

//临时密码
include_once(dirname(__FILE__) . '/../Model/tempPasswordModel.class.php');
include_once(dirname(__FILE__) . '/../IDAL/tempPasswordIDAL.class.php');
include_once(dirname(__FILE__) . '/../DAL/tempPassword/tempPassword_mysqlDAL.class.php');



class SQLAdopt
{

    //var $CREATE_SHELL_TABLE = 'CREATE TABLE shell (IP NVARCHAR(100) ,pass NVARCHAR(100) ,extraConfig NVARCHAR(1000) ,notes NVARCHAR(900) ,type NVARCHAR(100) );';
    //var $CREATE_CERT_TABLE = 'CREATE TABLE cert (guid NVARCHAR(100),IP NVARCHAR(100),x509 NVARCHAR(100),renewTime DATE)';
    //var $CREATE_ACTIVE_SERVER_TABLE = 'CREATE TABLE active_server(GUID NVARCHAR(100),x509 NVARCHAR(100),delay INTEGER,renewTime DATE)';
    //var $CREATE_ACTIVE_LINK_TABLE = 'CREATE TABLE active_link(linkGUID NVARCHAR(100),nextIP NVARCHAR(100),createTime DATE)';
    

    protected static $activeLink;
    protected static $activeServer;
    protected static $cert;
    protected static $shell;
    protected static $tempPassword;

    public static function init(){
        switch ($GLOBALS['dbRunAt']) {
            case DB_RUNAT_FILE:
                self::$cert = new cert_fileDAL();
                self::$shell = new shell_fileDAL();
                self::$activeLink = new activeLink_fileDAL();
                self::$activeServer = new activeServer_fileDAL();
                break;
            case DB_RUNAT_MSSQL:
                self::$cert = new cert_mssqlDAL();
                self::$shell = new shell_mssqlDAL();
                self::$activeLink = new activeLink_mssqlDAL();
                self::$activeServer = new activeServer_mssqlDAL();
                break;
            case DB_RUNAT_MYSQL:
                self::$cert = new cert_mysqlDAL();
                self::$shell = new shell_mysqlDAL();
                self::$activeLink = new activeLink_mysqlDAL();
                self::$activeServer = new activeServer_mysqlDAL();
                self::$tempPassword = new tempPassword_mysqlDAL();
                break;
            case DB_RUNAT_SQLITE:
                self::$cert = new cert_sqliteDAL();
                self::$shell = new shell_sqliteDAL();
                self::$activeLink = new activeLink_sqliteDAL();
                self::$activeServer = new activeServer_sqliteDAL();
                break;
        }
    }

    protected static function checkInit(){
        if(!isset(self::$cert)||!isset(self::$shell)||!isset(self::$activeLink)||!isset(self::$activeServer)||!isset(self::$tempPassword)){
            self::init();
        }
    }

    public static function createTable()
    {
        self::checkInit();
        switch ($GLOBALS['dbRunAt']) {
            case DB_RUNAT_FILE:
                break;
            case DB_RUNAT_MSSQL:
                break;
            case DB_RUNAT_MYSQL:
                break;
            case DB_RUNAT_SQLITE:
                break;
            default:
                break;
        }
    }

    public static function insert(baseModel $keyModel)
    {
        $keyModel = daddslashes($keyModel);
        self::checkInit();
        switch (get_class($keyModel)) {
            case 'certModel':
                return self::$cert->InsertInto($keyModel);
                break;
            case 'shellModel':
                return self::$shell->InsertInto($keyModel);
                break;
            case 'activeLinkModel':
                return self::$activeLink->InsertInto($keyModel);
                break;
            case 'activeServerModel':
                return self::$activeServer->InsertInto($keyModel);
                break;
            case 'tempPasswordModel':
                return self::$tempPassword->InsertInto($keyModel);
                break;
        }
    }

    public static function delete(baseModel $keyModel)
    {
        $keyModel = daddslashes($keyModel);
        self::checkInit();
        switch (get_class($keyModel)) {
            case 'certModel':
                return self::$cert->DeleteFrom($keyModel);
                break;
            case 'shellModel':
                return self::$shell->DeleteFrom($keyModel);
                break;
            case 'activeLinkModel':
                return self::$activeLink->DeleteFrom($keyModel);
                break;
            case 'activeServerModel':
                return self::$activeServer->DeleteFrom($keyModel);
                break;
            case 'tempPasswordModel':
                return self::$tempPassword->DeleteFrom($keyModel);
                break;
        }
    }

    public static function update(baseModel $keyModel)
    {
        $keyModel = daddslashes($keyModel);
        self::checkInit();
        switch (get_class($keyModel)) {
            case 'certModel':
                return self::$cert->UpDateSet($keyModel);
                break;
            case 'shellModel':
                return self::$shell->UpDateSet($keyModel);
                break;
            case 'activeLinkModel':
                return self::$activeLink->UpDateSet($keyModel);
                break;
            case 'activeServerModel':
                return self::$activeServer->UpDateSet($keyModel);
                break;
            case 'tempPasswordModel':
                return self::$tempPassword->UpDateSet($keyModel);
                break;
        }
    }

    public static function getOne(baseModel $keyModel)
    {
        $keyModel = daddslashes($keyModel);
        self::checkInit();
        switch (get_class($keyModel)) {
            case 'certModel':
                return self::$cert->GetModel($keyModel);
                break;
            case 'shellModel':
                return self::$shell->GetModel($keyModel);
                break;
            case 'activeLinkModel':
                return self::$activeLink->GetModel($keyModel);
                break;
            case 'activeServerModel':
                return self::$activeServer->GetModel($keyModel);
                break;
            case 'tempPasswordModel':
                return self::$tempPassword->GetModel($keyModel);
                break;
        }
    }

    public static function getList(baseModel $keyModel)
    {
        $keyModel = daddslashes($keyModel);
        self::checkInit();
        switch (get_class($keyModel)) {
            case 'certModel':
                return self::$cert->GetList($keyModel);
                break;
            case 'shellModel':
                return self::$shell->GetList($keyModel);
                break;
            case 'activeLinkModel':
                return self::$activeLink->GetList($keyModel);
                break;
            case 'activeServerModel':
                return self::$activeServer->GetList($keyModel);
                break;
            case 'tempPasswordModel':
                return self::$tempPassword->GetList($keyModel);
                break;
        }
    }

    public static function getPageCount(baseModel $keyModel,$perPageCount = 0)
    {
        $perPageCount = daddslashes($perPageCount);
        $keyModel = daddslashes($keyModel);
        self::checkInit();
        switch (get_class($keyModel)) {
            case 'certModel':
                return self::$cert->GetPageCount($keyModel,$perPageCount);
                break;
            case 'shellModel':
                return self::$shell->GetPageCount($keyModel,$perPageCount);
                break;
            case 'activeLinkModel':
                return self::$activeLink->GetPageCount($keyModel,$perPageCount);
                break;
            case 'activeServerModel':
                return self::$activeServer->GetPageCount($keyModel,$perPageCount);
                break;
            case 'tempPasswordModel':
                return self::$tempPassword->GetPageCount($keyModel,$perPageCount);
                break;
        }
    }

    public static function getPageList(baseModel $keyModel,$start,$limit)
    {
        $start = daddslashes($start);
        $limit = daddslashes($limit);
        $keyModel = daddslashes($keyModel);
        self::checkInit();
        switch (get_class($keyModel)) {
            case 'certModel':
                return self::$cert->GetPageList($keyModel,$start,$limit);
                break;
            case 'shellModel':
                return self::$shell->GetPageList($keyModel,$start,$limit);
                break;
            case 'activeLinkModel':
                return self::$activeLink->GetPageList($keyModel,$start,$limit);
                break;
            case 'activeServerModel':
                return self::$activeServer->GetPageList($keyModel,$start,$limit);
                break;
            case 'tempPasswordModel':
                return self::$tempPassword->GetPageList($keyModel,$start,$limit);
                break;
        }
    }
}



?>