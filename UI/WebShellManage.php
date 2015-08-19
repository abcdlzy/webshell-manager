<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午5:56
 */
include_once(dirname(__FILE__).'/../common.php');
include_once(dirname(__FILE__).'/../DBAdopt/_class/BLL/operator.php');

header('Content-type: text/html; charset=utf8');

@$jumpPage=$_POST["page"];
$perPage=5;
$nowPage=1;
if(isset($jumpPage)){
    $nowPage=$jumpPage;
}

$shellModeNull=new shellModel('','','','','');

$shellCount=SQLAdopt::getPageCount($shellModeNull);

$maxPage=ceil($shellCount/$perPage);

$shellModelList=SQLAdopt::getPageList(new shellModel('','','','',''),($nowPage-1)*$perPage,$perPage);
if(!isset($jumpPage)){
?>
<div class="row">

    <div class="nine columns">

        <h1>WebShell管理</h1>

    </div>


</div><!-- Site Heading Title ENDS -->

<div class="row">

    <div class="three columns" id="shellLeftArea">
<?php
}
?>
<div class="row">
        <div id="shell_list">


            <div class="shell-list-item" id="shellListNewItem" style="width: 184px;" onclick="changeShellPanel();">
                <div class="shell-list-title" style="width: 100%;">
                    <div class="one columns">
                    </div>
                    <div class="four columns">
                        <i class="fa fa-plus-square-o" style="font-size: 24px;"></i>
                    </div>
                    <div class="seven columns" style="margin-top: 2px;">新增</div>
                </div>

                <div class="shell-list-item-bg background-color"></div>
            </div>


            <?php
            if(!empty($shellModelList)) foreach($shellModelList as $model){
                $tempGUID=create_guid();
                ?>

            <div class="shell-list-item" id="<?php echo $tempGUID;?>" style="width: 184px;" onclick="changeShellPanel('<?php echo $model->url; ?>','<?php echo $tempGUID;?>')">
                <a href="#" class="shell-list-title" style="width: 124px;"><?php echo $model->url; ?></a>
                <div class="shell-list-descr" style="width: 124px;"><?php echo $model->notes; ?></div>
                <div class="shell-list-item-bg background-color"></div>
            </div>

            <?php
            }

            ?>





        </div>
</div>
    <div class="row">
        <div class="">
            <?php if($nowPage!=1){ ?>
            <input type="button" class="background-color gray-box-submit comment-sender" value="上一页"
                   onclick="$('#shellRightArea').fadeOut();$('#shellRightArea').html('');jumpPage('WebShellManage',<?php echo ($nowPage-1); ?>,'shellLeftArea');" style="float: left;"/>
            <?php }?>
            <?php if($nowPage!=$maxPage&&$maxPage!=0){?>
            <input type="button" class="background-color gray-box-submit comment-sender" value="下一页"
                   onclick="$('#shellRightArea').fadeOut();$('#shellRightArea').html('');jumpPage('WebShellManage',<?php echo ($nowPage+1); ?>,'shellLeftArea');"/>
            <?php } ?>
            <?php

            ?>
        </div>
</div>


        <?php
if(!isset($jumpPage))
{
        ?>
    </div>

    <div class="nine columns" id="shellRightArea">
<div style="text-align: center;
font-size: large;
border-radius: 10px;
background-color: rgb(29, 204, 93);
color: white;
height: 50px;
line-height: 50px;">
    请在左侧选择要操作的对象
</div>

    </div>


</div>
<?php
}
?>