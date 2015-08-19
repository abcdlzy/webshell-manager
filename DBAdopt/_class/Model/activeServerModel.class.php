<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午8:36
 */

class activeServerModel extends baseModel {
    public $GUID;
    public $interfaceURL;
    public $renewTime;

//构造函数
    public function __construct($guidstr,$interfaceURLstr,$rnTime)
    {
        $this->GUID=$guidstr;
        $this->interfaceURL=$interfaceURLstr;
        $this->renewTime=$rnTime;

    }


}
?>