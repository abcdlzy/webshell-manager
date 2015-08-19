<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午8:54
 */

class activeServer_mysqlDAL implements activeServerIDAL {

    public function __construct()
    {
        $this->mysqlHelper=new mysqlHelper();
    }

    public function __destruct()
    {
        $this->mysqlHelper->close();
    }

    function  InsertInto(activeServerModel $model)
    {
        // TODO: Implement InsertInto() method.
        $this->mysqlHelper->insert("insert into activeServer (GUID,interfaceURL,renewTime) VALUES ('".$model->GUID."','".$model->interfaceURL."',now())");
    }

    function  UpDateSet(activeServerModel $model)
    {
        // TODO: Implement UpDateSet() method.
        $this->mysqlHelper->update("update activeServer set interfaceURL='".$model->interfaceURL."',renewTime=now() where GUID='".$model->GUID."'");

    }

    function  DeleteFrom(activeServerModel $model)
    {
        // TODO: Implement DeleteFrom() method.
        $buildStr = 'where 1=1 ';
        if (!empty($model->GUID)) {
            $buildStr .= " and GUID='" . $model->GUID . "' ";
        }
        if(!empty($model->interfaceURL)){
            $buildStr.=" and interfaceURL='".$model->interfaceURL."' ";
        }

        if (!empty($model->renewTime)) {
            $buildStr .= " and renewTime='" . $model->renewTime . "' ";
        }

        $this->mysqlHelper->delete("delete from activeServer ".$buildStr);

    }

    function  GetModel(activeServerModel $model)
    {
        // TODO: Implement GetModel() method.
        $rs=$this->GetList($model);
        if(count($rs)>0){
            return $rs[0];
        }
    }

    function  GetList(activeServerModel $model)
    {
        // TODO: Implement GetList() method.
        if (!empty($model->GUID)) {
            if ($model->GUID == 'rand') {
                $all = $this->mysqlHelper->getRecords('SELECT * FROM activeserver ORDER BY RAND() LIMIT 1');
            }
        }
        else {
            $buildStr = 'where 1=1 ';
            if (!empty($model->GUID)) {
                if ($model->GUID == 'rand') {
                    $all = $this->mysqlHelper->getRecords('SELECT * FROM activeserver ORDER BY RAND() LIMIT 1');
                }
                $buildStr .= " and GUID='" . $model->GUID . "' ";
            }
            if (!empty($model->interfaceURL)) {
                $buildStr .= " and interfaceURL='" . $model->interfaceURL . "' ";
            }

            if (!empty($model->renewTime)) {
                $buildStr .= " and renewTime='" . $model->renewTime . "' ";
            }
            if (empty($model->GUID) && empty($model->renewTime) && empty($model->interfaceURL)) {
                $all = $this->mysqlHelper->getRecords('select GUID,interfaceURL,renewTime from activeServer ORDER BY renewTime DESC ');
            } else {
                $all = $this->mysqlHelper->getRecords('select GUID,interfaceURL,renewTime from activeServer ' . $buildStr . ' ORDER BY renewTime DESC ');
            }
        }

        $rtn=array();
        if(is_array($all)){
            foreach($all as $row=>$rowValue){
                if(is_array($rowValue)){
                    $model=new activeServerModel('', '', '', '','');
                    foreach($rowValue as $key=>$value){
                        $model->$key=$value;
                    }
                    $rtn[]=$model;
                }
            }
        }

        return $rtn;
    }

    function  GetPageCount(activeServerModel $model, $perPageCount)
    {
        // TODO: Implement GetPageCount() method.
        $buildStr = 'where 1=1 ';
        if (!empty($model->GUID)) {
            $buildStr .= " and GUID='" . $model->GUID . "' ";
        }
        if(!empty($model->interfaceURL)){
            $buildStr.=" and interfaceURL='".$model->interfaceURL."' ";
        }

        if (!empty($model->renewTime)) {
            $buildStr .= " and renewTime='" . $model->renewTime . "' ";
        }
        if(empty($model->GUID)&&empty($model->renewTime)&& empty($model->interfaceURL)){
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from activeServer');
        }
        else
        {
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from activeServer '.$buildStr);
        }

        return $perPageCount==0?$rowsCount:$rowsCount/$perPageCount;
        }

    function  GetPageList(activeServerModel $model, $start, $limit)
    {
        // TODO: Implement GetPageList() method.
        $buildStr = 'where 1=1 ';
        if (!empty($model->GUID)) {
            $buildStr .= " and GUID='" . $model->GUID . "' ";
        }
        if(!empty($model->interfaceURL)){
            $buildStr.=" and interfaceURL='".$model->interfaceURL."' ";
        }

        if (!empty($model->renewTime)) {
            $buildStr .= " and renewTime='" . $model->renewTime . "' ";
        }
        if(empty($model->GUID)&&empty($model->renewTime)&& empty($model->interfaceURL)){
            $all = $this->mysqlHelper->getRecords('select GUID,interfaceURL,renewTime from activeServer ORDER BY renewTime DESC limit ' . $start . ',' . $limit);
        } else {
            $all = $this->mysqlHelper->getRecords('select GUID,nterfaceURL,renewTime from activeServer ' . $buildStr . ' ORDER BY renewTime DESC limit ' . $start . ',' . $limit);
        }

        $rtn = array();
        if (is_array($all)) {
            foreach ($all as $row => $rowValue) {
                if (is_array($rowValue)) {
                    $model = new activeServerModel('', '', '', '','');
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