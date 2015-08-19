<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/16
 * Time: 下午6:11
 */
include_once(dirname(__FILE__).'/../../DataTransport.php');
header("Access-Control-Allow-Origin:*");
?>
<div class="col-md-12">

<section class="tile color transparent-black">

    <!-- tile header -->
    <div class="tile-header">
        <h1><strong>命令执行</strong></h1>
        <div class="controls">
            <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <!-- /tile header -->

    <!-- tile body -->
    <div class="tile-body">

        <form class="form-horizontal" role="form">

    命令执行
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea class="form-control" id="execShow" readonly rows="15" style="line-height: normal;white-space: pre!important;background-color: rgba(0, 0, 0, 0.21);color: #FFF;margin: 0px -0.9375px 0px 0px;width: 100%;">命令执行初始化完成.</textarea>
                </div>
            </div>



            <div class="form-group form-footer">
                <div class="col-sm-12" >
                    <h4><strong class="col-sm-2" style="margin-top: 10px;margin-left: -10px;">输入命令</strong></h4>
                    <input type="text" class="col-sm-10" id="execCode" onkeydown="if(event.keyCode==13) {executeCode();return false;}" style="">
                    <button type="button" class="btn btn-primary" onclick="executeCode()"  style="float: right;height: 37px">提交</button>

                </div>
            </div>

        </form>

    </div>
    <!-- /tile body -->


</section>



    </div>
