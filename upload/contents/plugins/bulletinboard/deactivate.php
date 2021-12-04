<?php

$db=new Database();

$db->nonquery("delete from group_permission_data where permission_c IN (select permission_c from permissions_mst where LEFT(permission_c,2)='BB')");

$db->nonquery("delete from permissions_mst where LEFT(permission_c,2)='BB'");

$db->nonquery("delete from setting_data where LEFT(key_c,2)='bb'");

$dbPath=PLUGINS_PATH.'bulletinboard/sql_uninstall.sql';

if(file_exists($dbPath))
{
    $content=file_get_contents($dbPath);

    if(isset($content[5]))
    {
         $db->nonquery(trim($content));   
    } 
}       

clear_hook();


// if(file_exists(ROOT_PATH.'public/system/autoloads_class/BB_Captcha_Image.php'))
// {
//     unlink(ROOT_PATH.'public/system/autoloads_class/BB_Captcha_Image.php');
// }