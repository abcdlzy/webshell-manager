/**
 * Created by abcdlzy on 15/3/14.
 */
function doPortScan(){
    document.getElementById('portScanResult').style.display='block';
    var postCode="\$ip = '"+$('#portScanIP').val()+"';" +
        "\$port = '"+$('#portScanPort').val()+"';" +
        "\$out=array();\$errno='';\$errstr='';" +
        "foreach(explode(',', \$port) as \$port) {" +
        "\$fp = @fsockopen(\$ip, \$port, \$errno, \$errstr, 1);" +
        "if (!\$fp) {" +
        "\$out[]=[\$ip,\$port,'close'];" +
        "} else {" +
        "\$out[]=[\$ip,\$port,'open'];" +
        "@fclose(\$fp);" +
        "}" +
        "}" +
        "echo json_encode(['resInfo'=>\$out]);";
    doEvalCode(postCode,function(data){
        document.getElementById('portScanResShow').innerHTML="";
        var jsonObj=JSON.parse(data);
        for(var i=0;i<jsonObj.resInfo.length;i++){
            document.getElementById('portScanResShow').innerHTML+='<div class="form-group" style="margin-bottom: 0px;">'+
            '<label class="col-sm-3 control-label">'
            +jsonObj.resInfo[i][0]+':'+jsonObj.resInfo[i][1]+'</lable>'

            +(jsonObj.resInfo[i][2]=='open'?'<span class="label label-success">开放</span>':'<span class="label label-danger">关闭</span>')
            +'</div>';
        }
        document.getElementById('varContainer').innerHTML+='<div class="form-group">';
        document.getElementById('varContainer').innerHTML+='<br/><br/><br/><br/>';
        document.getElementById('varContainer').innerHTML+='</div>';
    });
}