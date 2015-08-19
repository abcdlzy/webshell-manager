<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午6:50
 */

class mysqlHelper{
    var $host;
    var $user;
    var $password;
    var $conn;
    var $db;


    function mysqlHelper(){
        $this->host=$GLOBALS['mysql_host'];
        $this->user=$GLOBALS['mysql_username'];
        $this->password=$GLOBALS['mysql_password'];
        $this->db=$GLOBALS['mysql_database'];
        $this->conn=mysqli_connect($this->host,$this->user,$this->password,$this->db)
        or die("connect error:".mysql_error());
    }


    /*
    *构造函数
    *@param $host 主机名
    *@param $user 数据库用户
    *@param $password 数据库密码
    *@param $db 当前使用的数据库名
    */
/*
    function mysqlHelper4($host,$user,$password,$db){
        $this->host=$host;
        $this->user=$user;
        $this->password=$password;
        $this->db=$db;
        $this->conn=mysql_connect($this->host,$this->user,$this->password)
        or die("connect error:".mysql_error());
        mysql_select_db($this->db,$this->conn)
        or die("switch db error:".mysql_error());
        mysql_query("set names utf8",$this->conn);
    }
    /*
    *@param $sql 添加记录的语句
    *用于插入记录
    */
    function insert($sql){
        if(!$this->conn->query($sql))
        echo "insert error:".$this->conn->error;
        //mysql_query($sql,$this->conn) or die("insert error:".mysql_error());
    }
    /*
    *@param $sql 更新记录的语句
    *用于更新记录
    */
    function update($sql){
        $this->conn->query($sql)  or die("update error:".$this->conn->error);
    }
    /*
    *@param $sql 删除记录的语句
    *用于删除记录
    */
    function delete($sql){
        $this->conn->query($sql) or die("delete error:".$this->conn->error);
        //mysql_query($sql,$this->conn) or die("delete error:".mysql_error());
    }
    /*
    *@param $sql 查询记录的语句
    *@return $arrs 以一个数组的形式返回数据库中所有记录的结果集
    *结果如下：Array([0]=>Array(第一条记录) [1]=>Array(第二条记录)...)
    **/
    function getRecords($sql){
        $all=$this->conn->query($sql);
        $i=0;
        $arrs = array();
        
        while($result=mysqli_fetch_array($all,MYSQLI_ASSOC)){
            $arrs[$i]=$result;
            $i++;
        }
        return $arrs;
    }
    /*
    *@param $sql 查询记录的语句
    *@return $arrs 以一个数组的形式返回所有字段的结果集
    *结果如下：Array([0]=>字段名 [1]=>字段名...)
    **/
    function getFields($sql){
        $all=$this->conn->query($sql);
        $i=0;
        while($result=mysqli_fetch_field($all)){
            $arrs[$i]=$result->name;
            $i++;
        }
        return $arrs;
    }

    function getRows($sql){
        $all=$this->conn->query($sql);
        list($cnt)=mysqli_fetch_row($all);
        return $cnt;
    }


    function close(){
        $this->conn->close();
    }
}

?>