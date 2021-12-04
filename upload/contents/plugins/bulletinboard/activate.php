<?php

if(!is_dir(ROOT_PATH.'public/bb_contents'))
{
    mkdir(ROOT_PATH.'public/bb_contents');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/captcha'))
{
    mkdir(ROOT_PATH.'public/bb_contents/captcha');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/smiles'))
{
    mkdir(ROOT_PATH.'public/bb_contents/smiles');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/attach_files'))
{
    mkdir(ROOT_PATH.'public/bb_contents/attach_files');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/reactions'))
{
    mkdir(ROOT_PATH.'public/bb_contents/reactions');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/caches'))
{
    mkdir(ROOT_PATH.'public/bb_contents/caches');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/php_hook'))
{
    mkdir(ROOT_PATH.'public/bb_contents/php_hook');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/users'))
{
    mkdir(ROOT_PATH.'public/bb_contents/users');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/threads'))
{
    mkdir(ROOT_PATH.'public/bb_contents/threads');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/thread_replies'))
{
    mkdir(ROOT_PATH.'public/bb_contents/thread_replies');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/forums'))
{
    mkdir(ROOT_PATH.'public/bb_contents/forums');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/forum_ads'))
{
    mkdir(ROOT_PATH.'public/bb_contents/forum_ads');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/notices'))
{
    mkdir(ROOT_PATH.'public/bb_contents/notices');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/firewall'))
{
    mkdir(ROOT_PATH.'public/bb_contents/firewall');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/ip'))
{
    mkdir(ROOT_PATH.'public/bb_contents/firewall/ip');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/email'))
{
    mkdir(ROOT_PATH.'public/bb_contents/firewall/email');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/username'))
{
    mkdir(ROOT_PATH.'public/bb_contents/firewall/username');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/browser'))
{
    mkdir(ROOT_PATH.'public/bb_contents/firewall/browser');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/os'))
{
    mkdir(ROOT_PATH.'public/bb_contents/firewall/os');
}

if(!is_dir(ROOT_PATH.'public/bb_contents/phpcode'))
{
    mkdir(ROOT_PATH.'public/bb_contents/phpcode');
}

copy(PLUGINS_PATH.'bulletinboard/contents/.htaccess',ROOT_PATH.'public/bb_contents/.htaccess');

$db=new Database();

// $db->nonquery("delete from group_permission_data where permission_c IN (select permission_c from permissions_mst where LEFT(permission_c,2)='BB')");

// $db->nonquery("delete from setting_data where LEFT(key_c,2)='bb'");

// $db->nonquery("delete from group_permission_data where LEFT(permission_c,2)='BB'");



$listPers=$db->query("select * from permissions_mst where LEFT(permission_c,3)='BB1' OR LEFT(permission_c,3)='BB3'");
$listGroups=$db->query("select * from user_group_mst");

$total=count($listGroups);
$totalPers=count($listPers);

$insertData=[];

$queryStr='';

// Insert default group permission data
// for ($i=0; $i < $total; $i++) { 

//     for ($j=0; $j < $totalPers; $j++) { 

//         if($listPers[$j]['permission_c']!=null && strlen($listPers[$j]['permission_c'])> 2)
//         {
//             if($listGroups[$i]['group_c']!=null && strlen($listGroups[$i]['group_c']) > 2)
//             {
//                 $insertData=array(
//                     'group_c'=>$listGroups[$i]['group_c'],
//                     'permission_c'=>$listPers[$j]['permission_c'],
//                     'user_id'=>Configs::$_['user_data']['user_id']
//                 );
                
//                 $queryStr=arrayToInsertStr('group_permission_data',$insertData);
        
//                 $db->nonquery($queryStr);
//             }

//         }

//     }


//     // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);

// }

// All group but not: Pending activation user,Guest,Banned User


//Copy reactions data
$listFiles=scandir(PLUGINS_PATH.'bulletinboard/contents/reactions_installed');

$total=count($listFiles);

for ($i=0; $i < $total; $i++) { 
    if(strlen($listFiles[$i]) > 2)
    {
        copy(PLUGINS_PATH.'bulletinboard/contents/reactions_installed/'.$listFiles[$i],ROOT_PATH.'public/bb_contents/reactions/'.basename($listFiles[$i]));
    }
}


if(!is_dir(ROOT_PATH.'public/bb_contents/smiles/Default'))
{
    mkdir(ROOT_PATH.'public/bb_contents/smiles/Default');
}

$listFiles=scandir(PLUGINS_PATH.'bulletinboard/contents/smiles/Default');
$total=count($listFiles);

for ($i=0; $i < $total; $i++) { 
    if(strlen($listFiles[$i]) > 2)
    {
        copy(PLUGINS_PATH.'bulletinboard/contents/smiles/Default/'.$listFiles[$i],ROOT_PATH.'public/bb_contents/smiles/Default/'.basename($listFiles[$i]));
    }
}

$listFiles=scandir(PLUGINS_PATH.'bulletinboard/contents/autoloadclass');
$total=count($listFiles);

for ($i=0; $i < $total; $i++) { 
    if(strlen($listFiles[$i]) > 2)
    {
        copy(PLUGINS_PATH.'bulletinboard/contents/autoloadclass/'.$listFiles[$i],ROOT_PATH.'system/autoloads_class/'.basename($listFiles[$i]));
    }
}

// copy(PLUGINS_PATH.'bulletinboard/contents/reactions_installed/angry_2334516538.png',ROOT_PATH.'public/bb_contents/reactions/angry_2334516538.png');
// copy(PLUGINS_PATH.'bulletinboard/contents/BB_Captcha_Image.php',ROOT_PATH.'system/autoloads_class/BB_Captcha_Image.php');

// $dbPath=PLUGINS_PATH.'bulletinboard/sql_uninstall.sql';

// if(file_exists($dbPath))
// {
//     $content=file_get_contents($dbPath);

//     if(isset($content[5]))
//     {
//          $db->nonquery(trim($content));   
//     } 
// }       

$dbPath=PLUGINS_PATH.'bulletinboard/sql_install.sql';

if(file_exists($dbPath))
{
    $content=file_get_contents($dbPath);

    if(isset($content[5]))
    {
        $db->nonquery(trim($content));   

        // $queryStr="insert into bb_user_data(user_id)";
        // $queryStr.=" select user_id from user_mst where user_id NOT IN (select user_id from bb_user_data);";
        // $db->nonquery($queryStr);
    } 
}       







