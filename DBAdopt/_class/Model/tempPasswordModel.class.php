<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午8:15
 */

class tempPasswordModel extends baseModel {

    public $GUID;
    public $password;
    public $way;//in是对方out是自己
    public $renewTime;



    //构造函数
    public function __construct($GUIDstr,$passwordstr,$waystr,$renewTimesstr)
    {
        $this->GUID=$GUIDstr;
        $this->password=$passwordstr;
        $this->way=$waystr;
        $this->renewTime=$renewTimesstr;

    }


}
?>