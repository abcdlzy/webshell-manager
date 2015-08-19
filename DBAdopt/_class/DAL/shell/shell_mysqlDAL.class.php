<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午8:54
 */


class shell_mysqlDAL implements shellIDAL {

    public function __construct()
    {
        $this->mysqlHelper=new mysqlHelper();
    }

    public function __destruct()
    {
        $this->mysqlHelper->close();
    }

    function  InsertInto(shellModel $model)
    {
        // TODO: Implement InsertInto() method.
        $this->mysqlHelper->insert("insert into shell (url,pass,extraConfig,notes,type) VALUES ('".$model->url."','".$model->pass."','".$model->extraConfig."','".$model->notes."','".$model->type."')");
    }

    function  UpDateSet(shellModel $model)
    {
        // TODO: Implement UpDateSet() method.
        $this->mysqlHelper->update("update shell set pass='".$model->pass."',extraConfig='".$model->extraConfig."',notes='".$model->notes."',type='".$model->type."' where url='".$model->url."'");

    }

    function  DeleteFrom(shellModel $model)
    {
        // TODO: Implement DeleteFrom() method.
        $buildStr='where 1=1 ';
        if(!empty($model->url)) {
            $buildStr .= " and url='" . $model->url . "' ";
        }
        if(!empty($model->pass)){
            $buildStr.=" and pass='".$model->pass."' ";
        }
        if(!empty($model->extraConfig)){
            $buildStr.=" and extraConfig='".$model->extraConfig."' ";
        }
        if(!empty($model->notes)){
            $buildStr.=" and notes='".$model->notes."' ";
        }
        if(!empty($model->type)){
            $buildStr.=" and type='".$model->type."' ";
        }
        if(empty($model->url)&&empty($model->pass)&&empty($model->extraConfig)&&empty($model->notes)&&empty($model->type)){
            echo 'empty';
        }
        else
        {
            $this->mysqlHelper->delete("delete from shell ".$buildStr);
        }
    }

    function  GetModel(shellModel $model)
    {
        // TODO: Implement GetModel() method.
        $rs=$this->GetList($model);
        if(count($rs)>0){
            return $rs[0];
        }
    }

    function  GetList(shellModel $model)
    {
        // TODO: Implement GetList() method.
        $buildStr='where 1=1 ';
        if(!empty($model->url)) {
            $buildStr .= " and url='" . $model->url . "' ";
        }
        if(!empty($model->pass)){
            $buildStr.=" and pass='".$model->pass."' ";
        }
        if(!empty($model->extraConfig)){
            $buildStr.=" and extraConfig='".$model->extraConfig."' ";
        }
        if(!empty($model->notes)){
            $buildStr.=" and notes='".$model->notes."' ";
        }
        if(!empty($model->type)){
            $buildStr.=" and type='".$model->type."' ";
        }
        if(empty($model->url)&&empty($model->pass)&&empty($model->extraConfig)&&empty($model->notes)&&empty($model->type)){
            $all=$this->mysqlHelper->getRecords('select url,pass,extraConfig,notes,type from shell ORDER BY url asc ');
        }
        else
        {
            $all=$this->mysqlHelper->getRecords('select url,pass,extraConfig,notes,type from shell '.$buildStr.' ORDER BY url asc ');
        }

        $rtn=array();
        if(is_array($all)){
            foreach($all as $row=>$rowValue){
                if(is_array($rowValue)){
                    $model=new shellModel('','','','','');
                    foreach($rowValue as $key=>$value){
                        $model->$key=$value;
                    }
                    $rtn[]=$model;
                }
            }
        }

        return $rtn;
    }

    function  GetPageCount(shellModel $model, $perPageCount)
    {
        // TODO: Implement GetPageCount() method.
        $buildStr='where 1=1 ';
        if(!empty($model->url)) {
            $buildStr .= " and url='" . $model->url . "' ";
        }
        if(!empty($model->pass)){
            $buildStr.=" and pass='".$model->pass."' ";
        }
        if(!empty($model->extraConfig)){
            $buildStr.=" and extraConfig='".$model->extraConfig."' ";
        }
        if(!empty($model->notes)){
            $buildStr.=" and notes='".$model->notes."' ";
        }
        if(!empty($model->type)){
            $buildStr.=" and type='".$model->type."' ";
        }
        if(empty($model->url)&&empty($model->pass)&&empty($model->extraConfig)&&empty($model->notes)&&empty($model->type)){
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from shell');
        }
        else
        {
            $rowsCount=$this->mysqlHelper->getRows('select COUNT(*) from shell '.$buildStr);
        }

        return $perPageCount==0?$rowsCount:$rowsCount/$perPageCount;
    }

    function  GetPageList(shellModel $model, $start, $limit)
    {
        // TODO: Implement GetPageList() method.
        $buildStr='where 1=1 ';
        if(!empty($model->url)) {
            $buildStr .= " and url='" . $model->url . "' ";
        }
        if(!empty($model->pass)){
            $buildStr.=" and pass='".$model->pass."' ";
        }
        if(!empty($model->extraConfig)){
            $buildStr.=" and extraConfig='".$model->extraConfig."' ";
        }
        if(!empty($model->notes)){
            $buildStr.=" and notes='".$model->notes."' ";
        }
        if(!empty($model->type)){
            $buildStr.=" and type='".$model->type."' ";
        }
        if(empty($model->url)&&empty($model->pass)&&empty($model->extraConfig)&&empty($model->notes)&&empty($model->type)){
            $all = $this->mysqlHelper->getRecords('select url,pass,extraConfig,notes,type from shell ORDER BY url DESC limit ' . $start . ',' . $limit);
        } else {
            $all = $this->mysqlHelper->getRecords('select url,pass,extraConfig,notes,type from shell ' . $buildStr . ' ORDER BY url DESC limit ' . $start . ',' . $limit);
        }

        $rtn = array();
        if (is_array($all)) {
            foreach ($all as $row => $rowValue) {
                if (is_array($rowValue)) {
                    $model = new shellModel('', '', '', '','');
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