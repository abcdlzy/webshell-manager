<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/16
 * Time: 下午6:11
 */
header("Access-Control-Allow-Origin:*");
?>
<div class="row">
    <!-- col 12 -->
    <div class="col-md-12">
        <!-- tile -->
        <section class="tile color transparent-black">
            <!-- tile header -->
            <div class="tile-header">
                <h1>端口扫描</h1>
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body">

                <form class="form-horizontal" role="form">

                    <div class="form-group">
                        <label for="input01" class="col-sm-1 control-label">IP</label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="portScanIP" value="127.0.0.1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input02" class="col-sm-1 control-label">Port</label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="portScanPort" value="21,80,135,139,445,1433,3306,3389,5631,43958">
                        </div>
                    </div>

                    <div class="form-group form-footer">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" onclick="doPortScan()" style="float: right;">运行</button>
                            <button type="reset" class="btn btn-default" >重置</button>
                        </div>
                    </div>

                </form>

            </div>
            <!-- /tile body -->
        </section>
        <!-- /tile -->

    </div>
    <!-- /col 6 -->

</div>

<div class="row" id="portScanResult" style="display: none;">
    <!-- col 12 -->
    <div class="col-md-12">
        <!-- tile -->
        <section class="tile color transparent-black">
            <!-- tile header -->
            <div class="tile-header">
                <h1>端口扫描结果</h1>
            </div>
            <!-- /tile header -->
            <!-- tile body -->
            <div class="tile-body" >
                <form class="form-horizontal" role="form" id="portScanResShow">
                数据请求中……
                    </form>
            </div>
            <!-- /tile body -->
        </section>
        <!-- /tile -->
    </div>
    <!-- /col 6 -->
</div>