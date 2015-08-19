<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/12
 * Time: 上午10:37
 */

include_once(dirname(__FILE__).'/../config.php');
include_once(dirname(__FILE__) . '/../configOperator.php');
?>


    <div class="row">

        <div class="eight columns">

            <h1>系统设置</h1>

        </div>
    </div>

    <div class="twelve columns"><hr></div>
<div class="twelve columns">

    <div class="accordion">

        <div class="accordion-item">
            <div class="accordion-head">
                <div class="accordion-toggler background-color"></div>
                <div class="accordion-title" style="width: auto;">登陆密码修改</div>
            </div>
            <div class="accordion-text text" style="display: none;">
                <div class="row">
                <input type="password" id="oldPwd" name="name" class="gray-box-input comment-text contact-short" placeholder="旧密码" required="">
                </div>
                <div class="row">
                <input type="password" id="newPwd" name="name" class="gray-box-input comment-text contact-short" placeholder="新密码" required="">
                <input type="password" id="renewPwd" name="name" class="gray-box-input comment-text contact-short" placeholder="确认新密码" required="">
                </div>
                <div class="twelve columns">
                    <input type="button" class="background-color gray-box-submit comment-sender" value="修改"
                           onclick="modifyPassword(this)"/>
                </div>

            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-head">
                <div class="accordion-toggler background-color"></div>
                <div class="accordion-title" style="width: auto;">证书授权(Certificate Authority,CA)设置</div>
            </div>
            <div class="accordion-text text" style="display: none;">
                <!--
                <div class="row">
                    <div class="three columns" style="line-height: 30px;">此服务器为CA服务器：</div>
                    <div class="three columns">
                        <input type="checkbox" class="ios-switch green switch" onchange="serverCAStatus(this.checked)" <?php if($isCA){echo 'checked';}  ?> />
                        <div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                </div>
                -->
                <div class="row" id="CAsetting" style="<?php if(!$isCA){echo "display:none;";}  ?>">

                    <div class="row"><div class="twelve columns"><b>CA的私钥默认不会显示，公钥为：</b></div></div>
                    <div class="row">
                        <textarea class="comment-textarea contact-textarea">
                            <?php if($isCA){echo $CAPubX509;}  ?>

                        </textarea>
                    </div>
                    <div class="row"><div class="twelve columns">
                            <input type="button" class="background-color gray-box-submit comment-sender" onclick="remakeCAKey()" value="重新生成双钥"/>
                        </div></div>

                    <div class="row"><div class="twelve columns">
                            <b style="float: right;color: red;">此操作会导致所有之前签发证书不可用，但不会清除颁发记录</b>
                        </div></div>

                </div>

                <div class="row" id="notCAsetting" style="<?php if($isCA){echo "display:none;";}  ?>">
                    <div class="row">
                    <div class="twelve columns">
                        <div class="row">
                            <b>CA服务器的接口URL：</b>
                        </div>
                        <div class="row">

                                <input type="text" class="contact-textarea"  style="width: 97.7% !important;" />

                        </div>
                        <div class="row">
                                <input type="button" class="background-color gray-box-submit comment-sender" value="测试并获取CA公钥"/>
                        </div>
                    </div>
                        </div>

                    <div class="row">
                        <div class="twelve columns">
                            <b>当前使用的CA公钥：</b>
                        </div>
                    </div>
                    <div class="row">
                        <textarea class="comment-textarea contact-textarea">
                            <?php if($isCA){echo $PubX509fromCA;}  ?>

                        </textarea>
                    </div>
                    <div class="row"><br/></div>
                    <div class="row"><div class="twelve columns"><hr/></div></div>
                    <div class="row"><br/></div>
                    <div class="twelve columns">
                        <div class="row">
                            <input type="button" class="background-color gray-box-submit comment-sender" value="从CA申请新的证书"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <b>当前使用的私钥：</b>
                        </div>
                    </div>
                    <div class="row">
                        <textarea class="comment-textarea contact-textarea">
                            <?php echo $privateKey;  ?>

                        </textarea>
                    </div>
                    <div class="row"><br/></div>
                    <div class="row">
                        <div class="twelve columns">
                            <b>当前使用的CA公钥：</b>
                        </div>
                    </div>
                    <div class="row">
                        <textarea class="comment-textarea contact-textarea">
                            <?php echo $publicX509;  ?>

                        </textarea>
                    </div>


                </div>

            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-head">
                <div class="accordion-toggler background-color"></div>
                <div class="accordion-title" style="width: auto;">数据库设置</div>
            </div>
            <div class="accordion-text text" style="display: none;">
                <div class="row">

                    <b>当前使用的数据库类型：</b>
                    <section>
                        <select class="cs-select cs-skin-border" id="SQLTypeSelect" onchange="SQLTypeSetting($(this).val())">
                            <option value="" disabled>选择当前使用的数据库类型</option>
                            <option value="MySQL"  <?php if($dbRunAt==DB_RUNAT_MYSQL) echo 'selected'; ?> >MySQL</option>
                            <!--<option value="MSSQL"  <?php if($dbRunAt==DB_RUNAT_MSSQL) echo 'selected'; ?> >MSSQL</option>
                            <option value="SQLite" <?php if($dbRunAt==DB_RUNAT_SQLITE) echo 'selected'; ?> >SQLite</option>
                            <option value="File"   <?php if($dbRunAt==DB_RUNAT_FILE) echo 'selected'; ?> >File</option>-->
                        </select>
                    </section>

                </div>

                <div class="row" id="MySQLSetting" style="<?php if($dbRunAt!=DB_RUNAT_MYSQL) echo 'display:none'; ?>">

                    <div class="row">
                        <b>MySQL主机：</b>
                    </div>
                    <div class="row">
                        <input type="text" id="mysql_host" value="<?php echo $mysql_host; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>

                    <div class="row">
                        <b>MySQL用户名：</b>
                    </div>

                    <div class="row">
                        <input type="text" id="mysql_username" value="<?php echo $mysql_username; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>

                    <div class="row">
                        <b>MySQL密码：</b>
                    </div>
                    <div class="row">
                        <input type="text" id="mysql_password" value="<?php echo $mysql_password; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>

                    <div class="row">
                        <b>MySQL数据库：</b>
                    </div>
                    <div class="row">
                        <input type="text" id="mysql_database" value="<?php echo $mysql_database; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>
                </div>

                <div class="row" id="MSSQLSetting" style="<?php if($dbRunAt!=DB_RUNAT_MSSQL) echo 'display:none'; ?>" >

                    <div class="row">
                        <b>MSSQL主机：</b>
                    </div>
                    <div class="row">
                        <input type="text" id="mssql_host" value="<?php echo $mssql_host; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>

                    <div class="row">
                        <b>MSSQL用户名：</b>
                    </div>

                    <div class="row">
                        <input type="text" id="mssql_username" value="<?php echo $mssql_username; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>

                    <div class="row">
                        <b>MSSQL密码：</b>
                    </div>
                    <div class="row">
                        <input type="text" id="mssql_password" value="<?php echo $mssql_password; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>

                    <div class="row">
                        <b>MSSQL数据库：</b>
                    </div>
                    <div class="row">
                        <input type="text" id="mssql_database" value="<?php echo $mssql_database; ?>" class="contact-textarea"  style="width: 97.7% !important;" />
                    </div>
                </div>

                <div class="row" id="SQLiteSetting" style="<?php if($dbRunAt!=DB_RUNAT_SQLITE) echo 'display:none'; ?>" >

                    <div class="row">
                        <b>SQLite文件名：</b>
                    </div>
                    <div class="row">

                        <input type="text" id="sqliteFile" value="<?php echo $sqliteFile; ?>" class="contact-textarea"  style="width: 97.7% !important;" />

                    </div>
                </div>

                <div class="row" id="FileSetting" style="<?php if($dbRunAt!=DB_RUNAT_FILE) echo 'display:none'; ?>" >

                    <div class="row">
                        <b>文件名：</b>
                    </div>
                    <div class="row">

                        <input type="text" id="FileSQL" value="<?php echo $FileSQL; ?>" class="contact-textarea"  style="width: 97.7% !important;" />

                    </div>
                </div>

                <div class="twelve columns">
                        <input type="button" class="background-color gray-box-submit comment-sender" onclick="save_sysDB()" value="应用数据库更改"/>
                </div>

            </div>
        </div>
    </div>
</div>



