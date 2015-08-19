<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/10
 * Time: 下午12:51
 */

class baseModel {
//__get()方法用来获取私有属性
    public  function __get($property_name)
    {
        if(isset($this->$property_name))
        {
            return($this->$property_name);
        }else{
            return(NULL);
        }
    }

    //__set()方法用来设置私有属性
    public  function __set($property_name,$value)
    {
        $this->$property_name=$value;
    }

    //__isset()方法
    public  function __isset($nm)
    {
        //echo"isset()函数测定私有成员时，自动调用";
        return isset($this->$nm);
    }

    //__unset()方法
    public  function __unset($nm)
    {
        //echo"当在类外部使用unset()函数来删除私有成员时自动调用的";
        unset($this->$nm);
    }

}
?>