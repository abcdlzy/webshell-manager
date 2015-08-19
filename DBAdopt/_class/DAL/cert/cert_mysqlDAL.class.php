<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午8:54
 */



class cert_mysqlDAL implements certIDAL {

    var $mysqlHelper;

    public function __construct()
    {
        $this->mysqlHelper=new mysqlHelper();
    }

    public function __destruct()
    {
        $this->mysqlHelper->close();
    }

    function  InsertInto(certModel $model)
    {
        // TODO: Implement InsertInto() method.
        $this->mysqlHelper->insert("insert into cert (GUID,IP,x509,renewTime) VALUES ('".$model->GUID."','".$model->IP."','".$model->x509."',now())");
    }

    function  UpDateSet(certModel $model)
    {
        // TODO: Implement UpDateSet() method.
        $this->mysqlHelper->update("update cert set IP='".$model->IP."',x509='".$model->x509."',renewTime=now() where GUID='".$model->GUID."'");

    }

    function  DeleteFrom(certModel $model)
    {
        // TODO: Implement DeleteFrom() method.

        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.=" and GUID='".$model->GUID."' ";
        }
        if(!empty($model->IP)){
            $buildStr.=" and IP='".$model->IP."' ";
        }
        if(!empty($model->x509)){
            $buildStr.=" and x509='".$model->x509."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.=" and renewTime='".$model->renewTime."' ";
        }
        if(empty($model->GUID)&&empty($model->IP)&&empty($model->x509)&&empty($model->renewTime)){
            echo 'empty';
        }
        else
        {
            $this->mysqlHelper->delete("delete from cert ".$buildStr);
        }
    }

    function  GetModel(certModel $model)
    {
        // TODO: Implement GetModel() method.
        $rs=$this->GetList($model);
        if(count($rs)>0){
            return $rs[0];
        }

    }

    function  GetList(certModel $model)
    {
        // TODO: Implement GetList() method.

        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.=" and GUID='".$model->GUID."' ";
        }
        if(!empty($model->IP)){
            $buildStr.=" and IP='".$model->IP."' ";
        }
        if(!empty($model->x509)){
            $buildStr.=" and x509='".$model->x509."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.=" and renewTime='".$model->renewTime."' ";
        }

        if(empty($model->GUID)&&empty($model->IP)&&empty($model->x509)&&empty($model->renewTime)){
            $all=$this->mysqlHelper->getRecords('select GUID,IP,x509,renewTime from cert ORDER BY renewTime DESC ');
        }
        else
        {
            $all=$this->mysqlHelper->getRecords('select GUID,IP,x509,renewTime from cert '.$buildStr.' ORDER BY renewTime DESC ');
        }

        $rtn=array();
        if(is_array($all)){
            foreach($all as $row=>$rowValue){
                if(is_array($rowValue)){
                    $model=new certModel('','','','');
                    foreach($rowValue as $key=>$value){
                        $model->$key=$value;
                    }
                    $rtn[]=$model;
                }
            }
        }

        return $rtn;
    }

    function  GetPageCount(certModel $model,$perPageCount=0)
    {
        // TODO: Implement GetPageCount() method.

        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.=" and GUID='".$model->GUID."' ";
        }
        if(!empty($model->IP)){
            $buildStr.=" and IP='".$model->IP."' ";
        }
        if(!empty($model->x509)){
            $buildStr.=" and x509='".$model->x509."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.=" and renewTime='".$model->renewTime."' ";
        }

        if(empty($model->GUID)&&empty($model->IP)&&empty($model->x509)&&empty($model->renewTime)){
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from cert');
        }
        else
        {
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from cert '.$buildStr);
        }

        return $perPageCount==0?$rowsCount:$rowsCount/$perPageCount;

    }

    function  GetPageList(certModel $model,$start, $limit)
    {
        // TODO: Implement GetPageList() method.
        $buildStr='where 1=1 ';
        if(!empty($model->GUID)){
            $buildStr.=" and GUID='".$model->GUID."' ";
        }
        if(!empty($model->IP)){
            $buildStr.=" and IP='".$model->IP."' ";
        }
        if(!empty($model->x509)){
            $buildStr.=" and x509='".$model->x509."' ";
        }
        if(!empty($model->renewTime)){
            $buildStr.=" and renewTime='".$model->renewTime."' ";
        }

        if(empty($model->GUID)&&empty($model->IP)&&empty($model->x509)&&empty($model->renewTime)){
            $all=$this->mysqlHelper->getRecords('select GUID,IP,x509,renewTime from cert ORDER BY renewTime DESC limit '.$start.','.$limit);
        }
        else
        {
            $all=$this->mysqlHelper->getRecords('select GUID,IP,x509,renewTime from cert '.$buildStr.' ORDER BY renewTime DESC limit '.$start.','.$limit);
        }

        $rtn=array();
        if(is_array($all)){
            foreach($all as $row=>$rowValue){
                if(is_array($rowValue)){
                    $model=new certModel('','','','');
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