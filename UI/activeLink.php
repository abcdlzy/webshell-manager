<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/4
 * Time: 下午5:56
 */


include_once(dirname(__FILE__).'/../DBAdopt/_class/BLL/operator.php');
include_once(dirname(__FILE__).'/../common.php');


$nowPage=1;
@$jumpPage=$_POST["page"];

if(isset($jumpPage)){
$nowPage=$jumpPage;
}


$activeLinkmodelnull=new activeLinkModel('','','');

$ALRowsCount=SQLAdopt::GetPageCount($activeLinkmodelnull);





if(!isset($jumpPage)) {
?>
<div class="row" style="margin: 30px 0px 0px 0px;">
    <div class="eight columns">
        <h1>活动链路状态管理</h1>
    </div>
</div>

<div class="twelve columns"><hr></div>

<div id="activeLinkList" name="list">
    <?php
    }
    ?>



    <div class="twelve columns">

    </div>

    <div class="twelve columns"><hr></div>
    <div class="twelve columns" style="height: 43px;">
        <div class="page-selector-paging">
            <?php
            buildPageSeletor('activeLink',$ALRowsCount,$perPageCount,$nowPage,'activeLinkList');
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