<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午8:54
 */



class tempPassword_mysqlDAL implements tempPasswordIDAL {

    var $mysqlHelper;

    public function __construct()
    {
        $this->mysqlHelper=new mysqlHelper();
    }

    public function __destruct()
    {
        $this->mysqlHelper->close();
    }

    function  InsertInto(tempPasswordModel $model)
    {
        // TODO: Implement InsertInto() method.
        $this->mysqlHelper->insert("insert into tempPassword (GUID,password,way,renewTime) VALUES ('".$model->GUID."','".$model->password."','".$model->way."',now())");
    }

    function  UpDateSet(tempPasswordModel $model)
    {
        // TODO: Implement UpDateSet() method.
        $this->mysqlHelper->update("update tempPassword set password='".$model->password."',way='".$model->way."',renewTime=now() where GUID='".$model->GUID."'");

    }

    function  DeleteFrom(tempPasswordModel $model)
    {
        // TODO: Implement DeleteFrom() method.

        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.="and GUID='".$model->GUID."' ";
        }
        if(!empty($model->password)){
            $buildStr.="and password='".$model->password."' ";
        }
        if(!empty($model->way)){
            $buildStr.="and way='".$model->way."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.="and renewTime='".$model->renewTime."' ";
        }
        if(empty($model->GUID)&&empty($model->password)&&empty($model->way)&&empty($model->renewTime)){
            echo 'empty';
        }
        else
        {
            $this->mysqlHelper->delete("delete from tempPassword ".$buildStr);
        }
    }

    function  GetModel(tempPasswordModel $model)
    {
        // TODO: Implement GetModel() method.
        $rs=$this->GetList($model);
        if(count($rs)>0){
            return $rs[0];
        }

    }

    function  GetList(tempPasswordModel $model)
    {
        // TODO: Implement GetList() method.

        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.="and GUID='".$model->GUID."' ";
        }
        if(!empty($model->password)){
            $buildStr.="and password='".$model->password."' ";
        }
        if(!empty($model->way)){
            $buildStr.="and way='".$model->way."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.="and renewTime='".$model->renewTime."' ";
        }

        if(empty($model->GUID)&&empty($model->password)&&empty($model->way)&&empty($model->renewTime)){
            $all=$this->mysqlHelper->getRecords('select GUID,password,way,renewTime from tempPassword ORDER BY renewTime DESC ');
        }
        else
        {
            $all=$this->mysqlHelper->getRecords('select GUID,password,way,renewTime from tempPassword '.$buildStr.' ORDER BY renewTime DESC ');
        }

        $rtn=array();
        if(is_array($all)){
            foreach($all as $row=>$rowValue){
                if(is_array($rowValue)){
                    $model=new tempPasswordModel('','','','');
                    foreach($rowValue as $key=>$value){
                        $model->$key=$value;
                    }
                    $rtn[]=$model;
                }
            }
        }

        return $rtn;
    }

    function  GetPageCount(tempPasswordModel $model,$perPageCount=0)
    {
        // TODO: Implement GetPageCount() method.

        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.="and GUID='".$model->GUID."' ";
        }
        if(!empty($model->password)){
            $buildStr.="and password='".$model->password."' ";
        }
        if(!empty($model->way)){
            $buildStr.="and way='".$model->way."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.="and renewTime='".$model->renewTime."' ";
        }

        if(empty($model->GUID)&&empty($model->password)&&empty($model->way)&&empty($model->renewTime)){
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from tempPassword');
        }
        else
        {
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from tempPassword '.$buildStr);
        }

        return $perPageCount==0?$rowsCount:$rowsCount/$perPageCount;

    }

    function  GetPageList(tempPasswordModel $model,$start, $limit)
    {
        // TODO: Implement GetPageList() method.
        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.="and GUID='".$model->GUID."' ";
        }
        if(!empty($model->password)){
            $buildStr.="and password='".$model->password."' ";
        }
        if(!empty($model->way)){
            $buildStr.="and way='".$model->way."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.="and renewTime='".$model->renewTime."' ";
        }

        if(empty($model->GUID)&&empty($model->password)&&empty($model->way)&&empty($model->renewTime)){
            $all=$this->mysqlHelper->getRecords('select GUID,password,way,renewTime from tempPassword ORDER BY renewTime DESC limit '.$start.','.$limit);
        }
        else
        {
            $all=$this->mysqlHelper->getRecords('select GUID,password,way,renewTime from tempPassword '.$buildStr.' ORDER BY renewTime DESC limit '.$start.','.$limit);
        }

        $rtn=array();
        if(is_array($all)){
            foreach($all as $row=>$rowValue){
                if(is_array($rowValue)){
                    $model=new tempPasswordModel('','','','');
                    foreach($rowValue as $key=>$value){
                        $model->$key=$value;
                    }
                    $rtn[]=$model;
                }
            }
        }

        return $rtn;
    }

}
?>