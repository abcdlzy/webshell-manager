<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/14
 * Time: 下午12:09
 */

include_once(dirname(__FILE__).'/../common.php');
include_once(dirname(__FILE__).'/../DBAdopt/_class/BLL/operator.php');

@$getUrl=$_POST["data"];
@$getGUID=$_POST["GUID"];
if(!empty($getUrl)){
    $getModel=SQLAdopt::getOne(new shellModel($getUrl,'','','',''));
}

if(empty($getModel)){
    $getModel=new shellModel('','','','','');
}
?>

<input id="inputShellURL" <?php echo 'value="'.$getModel->url.'"';?>  <?php if(!empty($getModel->url)) echo 'readOnly style="background-color: #F0F0F0;"';?> type="text" name="name" class="text-short-input comment-text contact-long" placeholder="URL" required="">
<div class="row">

</div>
<div class="row">
    <div class="six columns">
        <input id="inputShellPass" <?php echo 'value="'.$getModel->pass.'"';?> type="text" name="name" class="text-short-input comment-text contact-short" style="width: 95%;margin: 5px 0px 5px 0px;" placeholder="pass" required="">
    </div>
    <div class="six columns">
        <section>
            <select class="cs-select cs-skin-border" id="selectShellType" style="width: 255px !important;"  onchange="">
                <option value="" disabled>选择Shell类型</option>
                <option value="PHP" <?php if($getModel->type=='PHP') echo 'selected'; ?>>PHP</option>
                <!--<option value="ASP.NET" <?php if($getModel->type=='ASP.NET') echo 'selected'; ?>>ASP.NET</option>
                <option value="JSP" <?php if($getModel->type=='JSP') echo 'selected'; ?>>JSP</option>
                <option value="other" <?php if($getModel->type=='other') echo 'selected'; ?>>其他</option>-->
            </select>
        </section>
    </div>
</div>
<!--
<div class="row">
    <textarea name="comment" id="textareaShellExtraConfig"  class="comment-textarea contact-textarea" placeholder="extraConfig"><?php echo $getModel->extraConfig;?></textarea>
</div>
-->
<div class="row" >
    <input id="inputShellNotes" <?php echo 'value="'.$getModel->notes.'"';?> type="text" name="name" class="text-short-input comment-text contact-long" placeholder="notes">
</div>

<div class="twelve columns">
    <?php
    if(!empty($getUrl)) {
        ?>
        <input type="button" class="warning-background-color warning-box-submit comment-sender" style="float: left;"
               value="删除" onclick="deleteShell(this,'<?php echo $getGUID;?>','<?php echo $getModel->url;?>')"/>
        <input type="button" class="background-color gray-box-submit comment-sender" value="使用"
               onclick="useShell(this,'<?php echo $getGUID;?>','<?php echo $getModel->url;?>','<?php echo $getModel->pass;?>','<?php echo $getModel->type;?>')"/>
        <input type="button" class="background-color gray-box-submit comment-sender" value="修改"
               onclick="updateShell(this,'<?php echo $getGUID;?>')"/>
    <?php
    }
    else {

        ?>

        <input type="button" class="background-color gray-box-submit comment-sender" value="添加"
               onclick="insertNewShell(this)"/>

    <?php
    }
    ?>
</div>