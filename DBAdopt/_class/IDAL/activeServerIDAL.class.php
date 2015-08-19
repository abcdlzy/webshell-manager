<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午9:09
 */

interface activeServerIDAL {

    //插入记录
    function  InsertInto(activeServerModel $model);
    //修改记录
    function  UpDateSet(activeServerModel $model);
    //删除记录
    function  DeleteFrom(activeServerModel $model);
    //获取一条记录
    function  GetModel(activeServerModel $model);
    //获取列表
    function  GetList(activeServerModel $model);
    //获取翻页列表
    function  GetPageCount(activeServerModel $model,$perPageCount);
    //获取指定数量列表
    function  GetPageList(activeServerModel $model,$start,$limit);
}
?>