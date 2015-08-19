/**
 * Created by abcdlzy on 15/3/9.
 */

//
function buildSQLQueryPostCode(host,user,pwd,dbname,sql,fetchKey){
    var postcode="$link=@mysql_connect('"+host+"', '"+user+"', '"+pwd+"', 1) or die('Failed: '.mysql_error());"
    postcode+="mysql_select_db('"+dbname+"', $link) or die ('Failed: '.mysql_error());";
    postcode+="$query = @mysql_query('"+sql+"', $link);"
    postcode+="while($row=@mysql_fetch_array($query,MYSQL_ASSOC)){echo $row['"+fetchKey+"'].',';}";
    postcode+="@mysql_close($link);";
    return postcode;
}

function buildSQLQueryPostCode_ReturnJson(host,user,pwd,dbname,sql){
    var postcode="$link=@mysql_connect('"+host+"', '"+user+"', '"+pwd+"', 1) or die('Failed: '.mysql_error());"
    postcode+="mysql_select_db('"+dbname+"', $link) or die ('Failed: '.mysql_error());";
    postcode+="$query = @mysql_query('"+sql+"', $link);"
    postcode+="$results = array();while($row=@mysql_fetch_array($query,MYSQL_ASSOC)){$results[] = $row;}echo json_encode($results);";
    postcode+="@mysql_close($link);";
    return postcode;
}

function MYSQLQuery(sql,fetchKey,returnFunction){
    var host=$('#SQLHost').val();
    var user=$('#SQLUser').val();
    var password=$('#SQLPassword').val();
    var selectDB=$('#selectDB').val();
    doEvalCode(buildSQLQueryPostCode(host,user,password,selectDB,sql,fetchKey),returnFunction);
}

function MYSQLQuery_RetrunJson(sql,returnFunction){
    var host=$('#SQLHost').val();
    var user=$('#SQLUser').val();
    var password=$('#SQLPassword').val();
    var selectDB=$('#selectDB').val();
    doEvalCode(buildSQLQueryPostCode_ReturnJson(host,user,password,selectDB,sql),returnFunction);

}

function SelectDataBase(){
    MYSQLQuery_RetrunJson('select TABLE_NAME,TABLE_ROWS,DATA_LENGTH,CREATE_TIME,UPDATE_TIME,`ENGINE`,TABLE_COLLATION from information_schema.tables where table_schema="'+$('#selectDB').val()+'" and table_type="base table";',function (data){
        if(data!='[]'){
            $('#mysqlSelectDBWarning').hide();
            selectDBsuccessRes(data);
            $('#tipsQuerySQLCode').html('select TABLE_NAME ,TABLE_ROWS ,DATA_LENGTH ,CREATE_TIME ,UPDATE_TIME ,`ENGINE` ,TABLE_COLLATION from information_schema.tables where table_schema="'+$('#selectDB').val()+'" and table_type="base table";');
            $('#MYSQLQueryCode').val($('#tipsQuerySQLCode').html());
            document.getElementById('tipsSelectedDB').innerHTML='<a style="color: #ffffff;text-decoration:underline;" href="javascript:SelectDataBase();"> '+$('#selectDB').val()+'</a>';
        }
        else{
            $('#mysqlSelectDBWarning').html('<strong>⚠</strong>   数据库 '+$('#selectDB').val()+' 选择失败，可能是权限不足。');
            $('#mysqlSelectDBWarning').show();
        }

    });
}

function doMYSQLQuery(){
    MYSQLQuery_RetrunJson($('#MYSQLQueryCode').val(),function (data){
        if(data!='[]'){
            $('#mysqlQueryResWarning').hide();
            successRes(data);
            $('#tipsQuerySQLCode').html($('#MYSQLQueryCode').val());
        }
        else{
            $('#mysqlQueryResWarning').html('<strong>⚠</strong> 无数据返回');
            $('#mysqlQueryResWarning').show();

        }

    });
}

function selectTable(table){
    $('#MYSQLQueryCode').val('select * from '+table+' limit 0,30');
    doMYSQLQuery();
}


function successRes(data) {
    var keys=[];
    var jsonObject=eval(data);
    for(var p in jsonObject[0])
    {
        keys.push(p);        //解析出列名，如果MYSQL_ASSOC参数此处解析出的不是列名
    }

    var aoColumnsStr="[";

    var numofcol=keys.length;
    for(var j = 0; j < numofcol; j++){
        aoColumnsStr+='{ "sTitle":"'+keys[j]+'" }'+(j<numofcol-1?',':'');
    }
    aoColumnsStr+=']';


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
    $('#basicDataTable').dataTable({
        "sDom":
        "<'row'<'col-md-4'l><'col-md-4 text-center sm-left'T C><'col-md-4'f>r>"+
        "t"+
        "<'row'<'col-md-4 sm-center'i><'col-md-4'><'col-md-4 text-right sm-center'p>>",
        "oLanguage": {
            "sSearch": ""
        },
        "aaSorting": [ [0,'asc'], [1,'asc'] ],
        "aoColumns": eval(aoColumnsStr) ,
        "oTableTools": {
            "sSwfPath": "assets/js/vendor/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends":    "collection",
                    "sButtonText": '保存<span class="caret" />',
                    "aButtons":    [ "csv", "xls", "pdf" ]
                }
            ]
        },
        "oColVis": {
            "buttonText": '<i class="fa fa-eye"></i>'
        },
        "fnInitComplete": function(oSettings, json) {
            $('.dataTables_filter input').attr("placeholder", "搜索");
        }
    });


    for(var i = 0; i < jsonObject.length; i++){
        var arr=[];

        for(var j = 0; j < numofcol; j++){
            arr.push(jsonObject[i][keys[j]]);
        }
        $('#basicDataTable').dataTable().fnAddData(arr);
    }
}

function selectDBsuccessRes(data) {
    var keys=[];
    var jsonObject=eval(data);
    for(var p in jsonObject[0])
    {
        keys.push(p);        //解析出列名，如果MYSQL_ASSOC参数此处解析出的不是列名
    }

    var aoColumnsStr="[";

    var numofcol=keys.length;
    for(var j = 0; j < numofcol; j++){
        aoColumnsStr+='{ "sTitle":"'+keys[j]+'" }'+(j<numofcol-1?',':'');
    }
    aoColumnsStr+=']';


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
    $('#basicDataTable').dataTable({
        "sDom":
        "<'row'<'col-md-4'l><'col-md-4 text-center sm-left'T C><'col-md-4'f>r>"+
        "t"+
        "<'row'<'col-md-4 sm-center'i><'col-md-4'><'col-md-4 text-right sm-center'p>>",
        "oLanguage": {
            "sSearch": ""
        },
        "aaSorting": [ [0,'asc'], [1,'asc'] ],
        "aoColumns": eval(aoColumnsStr) ,
        "oTableTools": {
            "sSwfPath": "assets/js/vendor/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends":    "collection",
                    "sButtonText": '保存<span class="caret" />',
                    "aButtons":    [ "csv", "xls" ]
                }
            ]
        },
        "oColVis": {
            "buttonText": '<i class="fa fa-eye"></i>'
        },
        "fnInitComplete": function(oSettings, json) {
            $('.dataTables_filter input').attr("placeholder", "搜索");
        }
    });


    for(var i = 0; i < jsonObject.length; i++){
        var arr=[];

        arr.push('<a style="color: #ffffff;text-decoration:underline;" href="javascript:selectTable(\''+jsonObject[i][keys[0]]+'\')">'+jsonObject[i][keys[0]]+'</a>');

        for(var j = 1; j < numofcol; j++){
            arr.push(jsonObject[i][keys[j]]);
        }
        $('#basicDataTable').dataTable().fnAddData(arr);
    }
}