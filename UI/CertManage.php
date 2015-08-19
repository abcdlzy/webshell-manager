<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/3
 * Time: 下午7:42
 */
include_once(dirname(__FILE__).'/../CASignCert.php');
include_once(dirname(__FILE__).'/../config.php');
include_once(dirname(__FILE__).'/../DBAdopt/_class/BLL/operator.php');
include_once(dirname(__FILE__).'/../common.php');


$nowPage=1;
@$jumpPage=$_POST["page"];

if(isset($jumpPage)){
    $nowPage=$jumpPage;
}



$certmodelnull=new certModel('','','','');

$certRowsCount=SQLAdopt::GetPageCount($certmodelnull);





if(!isset($jumpPage)) {
    ?>
    <div class="row" style="margin: 30px 0px 0px 0px;">

        <div class="eight columns">

            <h1>证书管理</h1>

        </div>
        <div class="four columns">

            <div class="message-box processing-bg" style=" margin-top: -10px;">
                <div class="bg-with-icon processing-icon-bg aboutus-icon"></div>
                <div class="message-text" style="width: 160px;">
                    <span id="toast_notice_text" style="white-space:nowrap;float: left;display: inline;">
                    <?php
                    if ($isCA == true) {
                       ?>
                        <i class="fa fa-cog fa-spin" ></i>当前运行在CA状态下&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                    } else {
                        echo '当前运行在非CA状态下';
                    }
                    ?>
</span>
                </div>
            </div>

        </div>
    </div>

    <div class="twelve columns"><hr></div>

    <div class="twelve columns">
        <div class="accordion">

            <div class="accordion-item">
                <div class="accordion-head">
                    <div class="accordion-toggler background-color"></div>
                    <div class="accordion-title" style="">CA根证书信息(x509)</div>
                </div>
                <div class="accordion-text text" style="display: none;">
            <textarea name="comment" class="comment-textarea contact-textarea" placeholder="Message" required="">
                <?php
                echo $CAPubX509;
                ?>
            </textarea>

                </div>
            </div>
        </div>
    </div>
    <div class="twelve columns"><hr></div>
    <div id="signCertList" name="list">
<?php
}
?>



<div class="twelve columns">
    <i class="fa fa-check fa-2x" style="color: rgb(29, 204, 93);"></i>  已签发并在有效期内的证书（共<span id='signActiveCount'><?php echo $certRowsCount; ?></span>个）：
    <div class="accordion">

        <?php

        $rs=SQLAdopt::getPageList($certmodelnull,($nowPage-1)*$perPageCount,$perPageCount);
        if(is_array($rs)) {

        foreach($rs as $model){
            if($model instanceof baseModel) {


                ?>

                <div class="accordion-item" id="<?php echo $model->GUID; ?>">
                    <div class="accordion-head">
                        <div class="accordion-toggler background-color"></div>
                        <div class="accordion-title" style="">

                            <div style="width: 400px;float: left;">
                                <?php echo 'GUID:'.$model->GUID; ?>
                            </div>
                            <div style="width: 160px;float: left;">
                                <?php echo 'IP:'.$model->IP; ?>
                            </div>
                            <div style="width: 300px;float: left;">
                                <?php echo '更新时间:'.$model->renewTime; ?>
                            </div>

                        </div>
                    </div>
                    <div class="accordion-text text" style="display: none;">
                        <textarea name="comment" class="comment-textarea contact-textarea" placeholder="Message" required="">
                            <?php
                            echo $model->x509;
                            ?>
                        </textarea>
                            <button   onclick="javascript:deleteSignCert(this,'<?php echo $model->GUID; ?>');" class="background-color gray-box-submit comment-sender fa-2x" style="margin-right: 32px;"><i class="fa fa-trash-o"></i> 删除</button>

                    </div>
                </div>
            <?php
            }
        };
    }

        ?>

        </div>
    </div>

<div class="twelve columns"><hr></div>
<div class="twelve columns" style="height: 43px;">
    <div class="page-selector-paging">
<?php
buildPageSeletor('CertManage',$certRowsCount,$perPageCount,$nowPage,'signCertList');
?>
    </div>
</div>
<div class="twelve columns"><br/></div>
<?php
if(!isset($jumpPage)) {
    ?>

    </div>
<?php
}
?>