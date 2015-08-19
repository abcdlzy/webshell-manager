<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/16
 * Time: 下午6:12
 */

include_once(dirname(__FILE__).'/../../DataTransport.php');
header("Access-Control-Allow-Origin:*");
?>
<div class="col-md-12">

<section class="tile color transparent-black">

    <!-- tile header -->
    <div class="tile-header">
        <h1><strong>eval</strong> PHP代码</h1>
        <div class="controls">
            <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <!-- /tile header -->

    <!-- tile body -->
    <div class="tile-body">

        <form class="form-horizontal" role="form">

            需要eval的代码
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea class="form-control" id="evalcode" rows="6" style="white-space: pre!important;margin: 0px -0.9375px 0px 0px;width: 100%;"></textarea>
                </div>
            </div>



            <div class="form-group form-footer">
                <div class="col-sm-12" >
                    <button type="button" class="btn btn-primary" onclick="doEval(this)"  style="float: right;">提交</button>
                    <button type="reset" class="btn btn-default">重置</button>
                </div>
            </div>

        </form>

    </div>
    <!-- /tile body -->


</section>


<section class="tile color transparent-white">


    <!-- tile header -->
    <div class="tile-header">
        <h1><strong>eval结果</strong>
        <div class="controls">
            <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>

        </div>
    </div>
    <!-- /tile header -->

    <!-- tile body -->
    <div class="tile-body">
        <div class="form-horizontal">
            <div class="row">
                <textarea  class="form-control" id="evalReturn" rows="5" style="white-space: pre!important;margin: 0px -0.9375px 0px 0px;width: 100%;"></textarea>
            </div>
        </div>
    </div>
    <!-- /tile body -->



</section>

    </div>