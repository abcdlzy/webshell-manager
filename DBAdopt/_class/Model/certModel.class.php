<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午8:01
 */

class certModel extends baseModel {

    public $GUID;
    public $IP;
    public $x509;
    public $renewTime;

    //构造函数
    public function __construct($guidstr,$ipstr,$x509str,$rnTime)
    {
        $this->GUID=$guidstr;
        $this->IP=$ipstr;
        $this->x509=$x509str;
        $this->renewTime=$rnTime;

    }

}
?>