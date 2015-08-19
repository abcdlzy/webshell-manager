<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午8:28
 */

class activeLinkModel extends baseModel {

    public $linkGUID;
    public $nextIP;
    public $createTime;

    //构造函数
    public function __construct($linkguidstr,$nextipstr,$ctimestr)
    {
        $this->createTime=$ctimestr;
        $this->linkGUID=$linkguidstr;
        $this->nextIP=$nextipstr;

    }



}
?>