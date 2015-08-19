<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/2/14
 * Time: 下午6:17
 */
function getUpPath($cwd) {
    $pathdb = explode('/', $cwd);
    $num = count($pathdb);
    if ($num > 2) {
        unset($pathdb[$num-1]);
    }
    $uppath = implode('/', $pathdb).'/';
    $uppath = str_replace('//', '/', $uppath);
    return $uppath;
}
echo getUpPath('/Users/abcdlzy/Documents/GDWeb/CA/1151220136/Data');
?>