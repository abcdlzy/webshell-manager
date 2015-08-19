<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午9:09
 */

interface certIDAL {

    //插入记录
    function  InsertInto(certModel $model);
    //修改记录
    function  UpDateSet(certModel $model);
    //删除记录
    function  DeleteFrom(certModel $model);
    //获取一条记录
    function  GetModel(certModel $model);
    //获取列表
    function  GetList(certModel $model);
    //获取翻页列表
    function  GetPageCount(certModel $model,$perPageCount);
    //获取指定数量列表
    function  GetPageList(certModel $model,$start,$limit);
}
?>