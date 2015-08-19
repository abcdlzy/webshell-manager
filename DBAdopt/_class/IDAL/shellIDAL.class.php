<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/7
 * Time: 下午9:10
 */

interface shellIDAL {

    //插入记录
    function  InsertInto(shellModel $model);
    //修改记录
    function  UpDateSet(shellModel $model);
    //删除记录
    function  DeleteFrom(shellModel $model);
    //获取一条记录
    function  GetModel(shellModel $model);
    //获取列表
    function  GetList(shellModel $model);
    //获取翻页列表
    function  GetPageCount(shellModel $model,$perPageCount);
    //获取指定数量列表
    function  GetPageList(shellModel $model,$start,$limit);
}
?>