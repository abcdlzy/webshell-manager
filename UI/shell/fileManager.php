<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/16
 * Time: 下午6:10
 */
header("Access-Control-Allow-Origin:*");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- tile -->
    <section class="tile color transparent-black textured">
        <!-- tile header -->
        <div class="tile-header">
            <h1><strong>文件管理</strong></h1>
            <div class="controls">
                <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
            </div>
        </div>
        <!-- /tile header -->

        <!-- tile widget -->
        <div class="tile-widget">

            <div class="progress-list with-heading">
                <div class="details">
                    <div class="title"><h2><i class="fa fa-hdd-o"></i> 已使用 <span id="diskUsed" class="animate-number" data-value="0" data-animation-duration="1600">0</span> GB</h2></div>
                </div>
                <div class="status pull-right bg-transparent-black-1">
                    <span class="animate-number" id="diskUsedPercentageNum" data-value="0" data-animation-duration="1500">0</span>%
                </div>
                <div class="clearfix"></div>
                <div class="progress progress-little progress-transparent-black" style="margin-bottom: 5px">
                    <div class="progress-bar animate-progress-bar" id="diskUsedProgressBar" data-percentage="0%"></div>
                </div>
            </div>
            <p class="description">在 <strong class="white-text" id="diskTotal">0GB</strong> 的服务器空间上，已经使用了 <strong id="diskUsedText">0GB</strong> </p>

        </div>
        <!-- /tile widget -->


    <!-- tile body -->
    <div class="tile-body">

        <form class="form-horizontal" role="form">


            <div class="form-group">
                <label for="inputCurrentDir" class="col-sm-1 control-label" style="width: 90px;">当前目录</label>
                <div class="col-sm-9">
                    <input class="form-control" id="inputCurrentDir" type="text">
                    <span class="help-block" id="dirInfo"> </span>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" onclick="getCurrentDirInfo()">更改目录</button>
                    </div>
            </div>
        </form>
<hr/>
            <form class="form-horizontal" role="form" >
            <div class="form-group">
                <div class="col-sm-7">
                    <button type="button" class="btn btn-default" style="height: 37px;" onclick="goDir(':webRoot');">网站根目录</button>
                    <button type="button" class="btn btn-default" style="height: 37px;" onclick="goDir(':scriptRoot');">脚本目录</button>
                    <a class="btn btn-default" data-toggle="modal" style="height: 37px;" href="#createDirBox">新建文件夹</a>
                    <a class="btn btn-default" style="height: 37px;" data-toggle="modal"  href="#fileBox" onclick="setFileBox('','')">新建文件</a>

                </div>
                <div class="col-sm-4" style="margin-left: -10px;">
                    <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                  <i class="fa fa-upload"></i><input id="fileManageUploader" name="fileManageUploader" multiple="" type="file">
                                </span>
                              </span>
                        <input class="form-control" readonly="" type="text" onclick="$('#fileManageUploader').click();" style="color: white;">
                    </div>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" style="height: 37px;margin-left: -25px;" onclick="ajaxFileUpload()">上传文件</button>
                </div>
                </form>
        </div>

    <!-- /tile body -->
</section>
</div>
    </div>



<div class="row">


    <!-- col 12 -->
    <div class="col-md-12">
    <section class="tile  color transparent-black textured">


        <!-- tile header -->
        <div class="tile-header">
            <h1>文件操作</h1>
            <div class="controls">
                <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
            </div>
        </div>
        <!-- /tile header -->

        <!-- tile body -->
        <div class="tile-body rounded-corners">

            <div class="table-responsive">
                <table  class="table table-datatable table-custom" id="basicDataTable">
                    <thead>
                    <tr>
                        <th>类型</th>
                        <th>文件名</th>
                        <th>修改日期</th>
                        <th>文件大小</th>
                        <th>权限</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>

        </div>
        <!-- /tile body -->



    </section>

</div>
</div>


<!-- createDir modal -->
<div class="modal fade" id="createDirBox" tabindex="-1" role="dialog" aria-labelledby="new-event-createDir" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">关闭</button>
                <h3 class="modal-title thin" id="new-event-createDir">新建文件夹</h3>

            </div>
            <form role="form" id="add-event-createDir" parsley-validate>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">文件夹名 *</label>
                        <input type="text" class="form-control" id="dirName" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal" aria-hidden="true">取消</button>
                    <button type="button" data-dismiss="modal" class="btn btn-green" onclick="createDir()">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- file modal -->
<div class="modal fade" id="fileBox" style="top: 0px;" tabindex="-1" role="dialog" aria-labelledby="new-event-createDir" aria-hidden="true">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">关闭</button>
                <h3 class="modal-title thin" id="new-event-createDir">文件操作  <span style="font-size: small;">(当前操作文件夹：<span id="fileBoxFilePath"></span>)</span></h3>

            </div>
            <form role="form" id="add-event-createDir" parsley-validate>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">文件名 *</label>
                        <input type="text" class="form-control" id="fileBoxFileName" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>

                    <div class="form-group">
                        <label for="input05" class="control-label">文件内容</label>
                            <textarea class="form-control" id="fileBoxFileData" style="white-space: pre!important;" rows="12"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal" aria-hidden="true">取消</button>
                    <button type="button" data-dismiss="modal" class="btn btn-green" onclick="saveFile()">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 编辑文件属性 modal -->
<div class="modal fade" id="permissionsBox" tabindex="-1" role="dialog" aria-labelledby="new-event-createDir" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">关闭</button>
                <h3 class="modal-title thin" id="new-event-createDir">修改文件属性</h3>

            </div>
            <form role="form" id="add-event-createDir" parsley-validate>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">当前操作对象</label>
                        <input type="text" disabled class="form-control" id="filePremsName" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>

                    <div class="form-group">
                        <label class="control-label">权限值 *</label>
                        <input type="text" class="form-control" id="filePremsValue" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal" aria-hidden="true">取消</button>
                    <button type="button" data-dismiss="modal" class="btn btn-green" onclick="objPermissionsChange()">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 改名 modal -->
<div class="modal fade" id="renameBox" tabindex="-1" role="dialog" aria-labelledby="new-event-createDir" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">关闭</button>
                <h3 class="modal-title thin" id="new-event-createDir">重命名/移动</h3>

            </div>
            <form role="form" id="add-event-createDir" parsley-validate>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">当前操作对象</label>
                        <input type="text" disabled class="form-control" id="fileRenameName" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>

                    <div class="form-group">
                        <label class="control-label">新名 *</label>
                        <input type="text" class="form-control" id="fileRenameValue" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal" aria-hidden="true">取消</button>
                    <button type="button" data-dismiss="modal" class="btn btn-green" onclick="objRename()">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 操作文件时间 modal -->
<div class="modal fade" id="timeBox" tabindex="-1" role="dialog" aria-labelledby="new-event-createDir" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">关闭</button>
                <h3 class="modal-title thin" id="new-event-createDir">修改时间</h3>

            </div>
            <form role="form" id="add-event-createDir" parsley-validate>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">当前操作对象</label>
                        <input type="text" disabled class="form-control" id="fileTimeName" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>

                    <div class="form-group">
                        <label class="control-label">新时间 *</label>
                        <input type="text" class="form-control" id="fileTimeDate"/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal" aria-hidden="true">取消</button>
                    <button type="button" data-dismiss="modal" class="btn btn-green" onclick="objTimeChange()">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 删除 modal -->
<div class="modal fade" id="deleteBox" tabindex="-1" role="dialog" aria-labelledby="new-event-createDir" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">关闭</button>
                <h3 class="modal-title thin" id="new-event-createDir">删除确认</h3>

            </div>
            <form role="form" id="add-event-createDir" parsley-validate>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">当前操作对象</label>
                        <input type="text" class="form-control" id="deleteFileName" name="dirName" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1">
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal" aria-hidden="true">取消</button>
                    <button type="button" data-dismiss="modal" class="btn btn-green" onclick="objsDelete()">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
