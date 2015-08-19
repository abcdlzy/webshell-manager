<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午9:09
 */

interface tempPasswordIDAL {

    //插入记录
    function  InsertInto(tempPasswordModel $model);
    //修改记录
    function  UpDateSet(tempPasswordModel $model);
    //删除记录
    function  DeleteFrom(tempPasswordModel $model);
    //获取一条记录
    function  GetModel(tempPasswordModel $model);
    //获取列表
    function  GetList(tempPasswordModel $model);
    //获取翻页列表
    function  GetPageCount(tempPasswordModel $model,$perPageCount);
    //获取指定数量列表
    function  GetPageList(tempPasswordModel $model,$start,$limit);
}
?>