<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午8:15
 */

class shellModel extends baseModel {

    public $url;
    public $pass;
    public $extraConfig;
    public $notes;
    public $type;//php asp.net jsp



    //构造函数
    public function __construct($urlstr,$passstr,$exconfigstr,$notesstr,$typestr)
    {
        $this->url=$urlstr;
        $this->pass=$passstr;
        $this->extraConfig=$exconfigstr;
        $this->notes=$notesstr;
        $this->type=$typestr;

    }


}
?>