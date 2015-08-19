<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午9:05
 */

interface activeLinkIDAL {

    //插入记录
    function  InsertInto(activeLinkModel $model);
    //修改记录
    function  UpDateSet(activeLinkModel $model);
    //删除记录
    function  DeleteFrom(activeLinkModel $model);
    //获取一条记录
    function  GetModel(activeLinkModel $model);
    //获取列表
    function  GetList(activeLinkModel $model);
    //获取翻页列表
    function  GetPageCount(activeLinkModel $model,$perPageCount);
    //获取指定数量列表
    function  GetPageList(activeLinkModel $model,$start,$limit);
}
?>