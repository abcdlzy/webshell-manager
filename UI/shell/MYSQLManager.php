<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/16
 * Time: 下午6:11
 */
header("Access-Control-Allow-Origin:*");
?>
<div class="col-md-12">


    <!-- tile -->
    <section class="tile transparent">


        <!-- tile header -->
        <div class="tile-header transparent">
            <h1><strong>MYSQL</strong> 管理 </h1>
            <div class="controls">
                <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
            </div>
        </div>
        <!-- /tile header -->

        <section class="tile color transparent-black">

            <!-- tile header -->
            <div class="tile-header">
                <h1><strong>连接数据库</strong></h1>
                <div class="controls">
                    <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body">

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-sm-12" >
                            <div class="alert alert-red" id="mysqlConnectWarning" style="display: none;">
                                <strong>⚠注意</strong>: 数据库好像没有链接成功.
                            </div>
                        </div>
                        <div class="col-sm-12" >
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail">数据库主机(host)</label>
                                <input class="form-control" id="SQLHost" placeholder="数据库主机(host)" type="text" value="">
                            </div>
                            <div class="form-group col-sm-3" style="margin-left: 20px;">
                                <label for="exampleInputPassword1">用户名</label>
                                <input class="form-control" id="SQLUser" placeholder="用户名" type="text" value="">
                            </div>
                            <div class="form-group col-sm-3" style="margin-left: 20px;">
                                <label for="exampleInputPassword2">密码</label>
                                <input class="form-control" id="SQLPassword" placeholder="密码" type="password" value="">
                            </div>
                        </div>

                    </div>



                    <div class="form-group form-footer">
                        <div class="col-sm-12" >
                            <button type="button" class="btn btn-primary" onclick="connectSQL(this)" style="float: right;">连接</button>
                            <button type="reset" class="btn btn-default" >重置</button>
                        </div>
                    </div>

                </form>

            </div>


            <!-- /tile body -->

        </section>



        <section class="tile color transparent-black">


            <!-- tile header -->
            <div class="tile-header">
                <h1>数据库查询</h1>
                <div class="controls">
                    <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                    <a href="#" class="remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body">
                <div class="row">
                    <div class="form-group">
                        <label for="input07" class="col-sm-4 control-label">选择数据库</label>
                        <div class="col-sm-8">
                            <select class="chosen-select chosen-transparent form-control" id="selectDB" onchange="SelectDataBase()">
                                <option>请先连接数据库</option>
                            </select>
                        </div>
                        <div class="col-sm-12" >
                            <br/>
                            <div class="alert alert-red" id="mysqlSelectDBWarning" style="display: none;">
                                <strong>⚠注意</strong>: 数据库好像选择成功.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

<hr/>
                    <label for="input07" class="col-sm-4 control-label">当前数据库：</label>
                    <label id="tipsSelectedDB" class="col-sm-8 control-label"  style="color: #ffffff;"></label>
                    </div>
                    <div class="row">
                        <br/>
                </div>


                <form class="form-horizontal" role="form">

                    运行数据库SQL语句查询：
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" id="MYSQLQueryCode" rows="6" style="margin: 0px -0.9375px 0px 0px;width: 100%;"></textarea>
                        </div>

                        <div class="col-sm-12" >
                            <br/>
                            <div class="alert alert-red" id="mysqlQueryResWarning" style="display: none;">
                                <strong>⚠注意</strong>: 数据库好像没有返回.
                            </div>
                        </div>
                    </div>



                    <div class="form-group form-footer">
                        <div class="col-sm-12" >
                            <button type="button" class="btn btn-primary" onclick="doMYSQLQuery()" style="float: right;">运行</button>
                            <button type="reset" class="btn btn-default" >重置</button>
                        </div>
                    </div>

                </form>

            </div>
            <!-- /tile body -->



        </section>

        <!-- tile body -->
        <div class="tile-body color transparent-black rounded-corners">

            <div class="table-responsive">

                <div class="row">
                    <label for="input07" class="col-sm-3 control-label" style="color: #ffffff;">结果集查询语句：</label>
                    <label id="tipsQuerySQLCode" class="col-sm-9 control-label" style="color: #ffffff;"></label>
                    <hr/>
                </div>

                <table  class="table table-datatable table-custom" id="basicDataTable" style="color: #ffffff;">

                </table>
            </div>

        </div>
        <!-- /tile body -->



    </section>
    <!-- /tile -->




</div>




<script>
    $(function(){




    })

</script>