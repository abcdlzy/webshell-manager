<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午8:54
 */

class activeLink_mysqlDAL implements activeLinkIDAL {

    public function __construct()
    {
        $this->mysqlHelper=new mysqlHelper();
    }

    public function __destruct()
    {
        $this->mysqlHelper->close();
    }

    function  InsertInto(activeLinkModel $model)
    {
        // TODO: Implement InsertInto() method.
        $this->mysqlHelper->insert("insert into activeLink (linkGUID,nextIP,createTime) VALUES ('".$model->linkGUID."','".$model->nextIP."',now())");
    }

    function  UpDateSet(activeLinkModel $model)
    {
        // TODO: Implement UpDateSet() method.
        $this->mysqlHelper->update("update activeLink set nextIP='".$model->nextIP."' where GUID='".$model->linkGUID."'");

    }

    function  DeleteFrom(activeLinkModel $model)
    {
        // TODO: Implement DeleteFrom() method.
        $buildStr='where 1=1 ';
        if(!empty($model->linkGUID)) {
            $buildStr .= " and linkGUID='" . $model->linkGUID . "' ";
        }
        if(!empty($model->nextIP)){
            $buildStr.=" and nextIP='".$model->nextIP."' ";
        }
        if(!empty($model->createTime)){
            $buildStr.=" and createTime='".$model->createTime."' ";
        }
        if(empty($model->linkGUID)&&empty($model->nextIP)&&empty($model->createTime)){
            echo 'empty';
        }
        else
        {
            $this->mysqlHelper->delete("delete from activeLink ".$buildStr);
        }
    }

    function  GetModel(activeLinkModel $model)
    {
        // TODO: Implement GetModel() method.
        $rs=$this->GetList($model);
        if(count($rs)>0){
            return $rs[0];
        }
    }

    function  GetList(activeLinkModel $model)
    {
        // TODO: Implement GetList() method.
        $buildStr='where 1=1 ';
        if(!empty($model->linkGUID)) {
            $buildStr .= " and linkGUID='" . $model->linkGUID . "' ";
        }
        if(!empty($model->nextIP)){
            $buildStr.=" and nextIP='".$model->nextIP."' ";
        }
        if(!empty($model->createTime)){
            $buildStr.=" and createTime='".$model->createTime."' ";
        }
        if(empty($model->linkGUID)&&empty($model->nextIP)&&empty($model->createTime)){
            $all=$this->mysqlHelper->getRecords('select linkGUID,nextIP,createTime from activeLink ORDER BY createTime DESC ');
        }
        else
        {
            $all=$this->mysqlHelper->getRecords('select linkGUID,nextIP,createTime from activeLink '.$buildStr.' ORDER BY createTime DESC ');
        }

        $rtn=array();
        if(is_array($all)){
            foreach($all as $row=>$rowValue){
                if(is_array($rowValue)){
                    $model=new activeLinkModel('','','','');
                    foreach($rowValue as $key=>$value){
                        $model->$key=$value;
                    }
                    $rtn[]=$model;
                }
            }
        }

        return $rtn;
    }

    function  GetPageCount(activeLinkModel $model, $perPageCount)
    {
        // TODO: Implement GetPageCount() method.
        $buildStr='where 1=1 ';
        if(!empty($model->linkGUID)) {
            $buildStr .= " and linkGUID='" . $model->linkGUID . "' ";
        }
        if(!empty($model->nextIP)){
            $buildStr.=" and nextIP='".$model->nextIP."' ";
        }
        if(!empty($model->createTime)){
            $buildStr.=" and createTime='".$model->createTime."' ";
        }
        if(empty($model->linkGUID)&&empty($model->nextIP)&&empty($model->createTime)){
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from activeLink');
        }
        else
        {
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from activeLink '.$buildStr);
        }

        return $perPageCount==0?$rowsCount:$rowsCount/$perPageCount;
    }

    function  GetPageList(activeLinkModel $model, $start, $limit)
    {
        // TODO: Implement GetPageList() method.
        $buildStr='where 1=1 ';
        if(!empty($model->linkGUID)) {
            $buildStr .= " and linkGUID='" . $model->linkGUID . "' ";
        }
        if(!empty($model->nextIP)){
            $buildStr.=" and nextIP='".$model->nextIP."' ";
        }
        if(!empty($model->createTime)){
            $buildStr.=" and createTime='".$model->createTime."' ";
        }
        if(empty($model->linkGUID)&&empty($model->nextIP)&&empty($model->createTime)){
            $all = $this->mysqlHelper->getRecords('select linkGUID,nextIP,createTime from activeLink ORDER BY createTime DESC limit ' . $start . ',' . $limit);
        } else {
            $all = $this->mysqlHelper->getRecords('select linkGUID,nextIP,createTime from activeLink ' . $buildStr . ' ORDER BY createTime DESC limit ' . $start . ',' . $limit);
        }

        $rtn = array();
        if (is_array($all)) {
            foreach ($all as $row => $rowValue) {
                if (is_array($rowValue)) {
                    $model = new activeLinkModel('', '', '', '');
                    foreach ($rowValue as $key => $value) {
                        $model->$key = $value;
                    }
                    $rtn[] = $model;
                }
            }
        }

        return $rtn;
    }


}
?>