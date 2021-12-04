<?php

require_once(PLUGINS_PATH.'bulletinboard/core.php');

function frontend_api()
{
    $api_nm=addslashes(getGet('api_nm'));
    $apiLibsPath=PLUGINS_PATH.'bulletinboard/api_libs/'.$api_nm.'.php';

    if(!file_exists($apiLibsPath))
    {
        return $apiLibsPath;
    }

    $result='';

    require_once($apiLibsPath);

    if(function_exists($api_nm))
    {
        $result=$api_nm();
    }

    return $result;
}

function bb_add_new_forum()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $forum_id=newID(12);

    $parent_id=addslashes(getPost('parent_id'));

    $forum_type=strtoupper(addslashes(getPost('forum_type')));

    $external_url='';
    $short_content=addslashes(getPost('short_content'));

    if($forum_type=='URL')
    {
        $external_url=$short_content;

        $short_content='';
    }

    $insertData=array(
        'forum_id'=>$forum_id,
        'title'=>addslashes(getPost('title')),
        'parent_id'=>$parent_id,
        'friendly_url'=>friendlyString(getPost('title'),'_')."_".$forum_id,
        'descriptions'=>addslashes(getPost('descriptions')),
        'thumbnail'=>addslashes(getPost('thumbnail')),
        'forum_type'=>addslashes(getPost('forum_type')),
        'external_url'=>$external_url,
        'short_content'=>$short_content,
        'allow_create_thread'=>addslashes(getPost('allow_create_thread')),
        'keywords'=>addslashes(getPost('keywords')),
        'status'=>addslashes(getPost('status')),
        'user_id'=>$username
    );    


    $db=new Database(); 


    $loadData=$db->query("select MAX(sort_order) as sort_order from bb_forum_data where ifnull(parent_id,'')='".$parent_id."'");

    $sort_order=0;

    if(count($loadData))
    {
        $sort_order=(int)$loadData[0]['sort_order']+1;

        $insertData['sort_order']=$sort_order;
    }


    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_forum_data',$insertData);

    // $db->nonquery("update bb_forum_data set sort_order=sort_order+1 where ifnull(parent_id,'')='".$parent_id."'");

    $db->nonquery($queryStr);

    $savePath=BB_CACHES_PATH.'breadcum_data.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }


    // Can view forum
    $queryStr=" insert into bb_forum_usergroup_permission_data";
    $queryStr.=" SELECT '".$forum_id."',group_c,'BB10001',NOW()";
    $queryStr.=" FROM user_group_mst";
    $db->nonquery($queryStr);

    //Can publish thread after submit
    $queryStr=" insert into bb_forum_usergroup_permission_data";
    $queryStr.=" SELECT '".$forum_id."',group_c,'BB10007',NOW()";
    $queryStr.=" FROM user_group_mst where group_c NOT IN ('11016017','11016014')";
    $db->nonquery($queryStr);


    if($forum_type=='PRIVATE')
    {
        $queryStr=" insert into bb_forum_usergroup_permission_data";
        $queryStr.=" SELECT '".$forum_id."',group_c,'BB20001',NOW()";
        $queryStr.=" FROM user_group_mst where group_c<>'11016011';";
        
        $queryStr.=" insert into bb_forum_usergroup_permission_data";
        $queryStr.=" SELECT '".$forum_id."',group_c,'BB20003',NOW()";
        $queryStr.=" FROM user_group_mst where group_c<>'11016011';";

        $queryStr.=" insert into bb_forum_usergroup_permission_data";
        $queryStr.=" SELECT '".$forum_id."',group_c,'BB20004',NOW()";
        $queryStr.=" FROM user_group_mst where group_c<>'11016011';";

        $queryStr.=" insert into bb_forum_usergroup_permission_data";
        $queryStr.=" SELECT '".$forum_id."',group_c,'BB20006',NOW()";
        $queryStr.=" FROM user_group_mst where group_c<>'11016011';";

        $queryStr.=" insert into bb_forum_usergroup_permission_data";
        $queryStr.=" SELECT '".$forum_id."',group_c,'BB20014',NOW()";
        $queryStr.=" FROM user_group_mst where group_c<>'11016011';";

        $db->nonquery($queryStr);
    }


    if(file_exists(BB_CACHES_PATH.'forums.php'))
    {
        unlink(BB_CACHES_PATH.'forums.php');
    }

    saveActivities('bb_forum_add','Add new forum '.$insertData['title'],$username);



    return 'OK';

}

function bb_add_ranks()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $rank_id=newID(12);



    $img=addslashes(getPost('img'));
    $img=str_replace(SITE_URL,'',$img);

    $splitIMG=explode('.',$img);

    $newImgPath='public/bb_contents/'.newID(10).'.'.$splitIMG[count($splitIMG)-1];

    if(file_exists(ROOT_PATH.$img))
    {
        copy(ROOT_PATH.$img,ROOT_PATH.$newImgPath);
        unlink(ROOT_PATH.$img);
    }

    $insertData=array(
        'rank_id'=>$rank_id,
        'title'=>addslashes(getPost('title')),
        'bg_color_c'=>addslashes(getPost('color')),
        'status'=>addslashes(getPost('status')),
        'left_str'=>addslashes(getPost('left_str')),
        'right_str'=>addslashes(getPost('right_str')),
        'image'=>$newImgPath,
        'user_id'=>$username
    );    


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_ranks_data',$insertData);

    $db->nonquery($queryStr);

    saveActivities('bb_ranks_add','Add new rank '.$insertData['title'],$username);

    return 'OK';

}

function bb_add_new_annoucement()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $id=newID(12);

    $insertData=array(
        'a_id'=>$id,
        'title'=>addslashes(getPost('title')),
        'forum_id'=>addslashes(getPost('forum_id')),
        'group_id'=>addslashes(getPost('usergroup_id')),
        'content'=>addslashes(getPost('content')),
        'user_id'=>$username
    );    


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_annoucement_data',$insertData);

    $db->nonquery($queryStr);
    
    $savePath=BB_CACHES_PATH.'annoucement.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

    saveActivities('bb_annoucement_add','Add new annoucement '.$insertData['title'],$username);

    return 'OK';

}

function bb_add_new_htmlglobal()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $forum_id=newID(12);

    $html_c=addslashes(getPost('code'));

    $insertData=array(
        'html_c'=>$html_c,
        'title'=>addslashes(getPost('title')),
        'content'=>addslashes(getPost('content')),
        'user_id'=>$username
    );    


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_html_global_data',$insertData);

    $db->nonquery("delete from bb_html_global_data where html_c='".$html_c."'");
    $db->nonquery($queryStr);

    saveActivities('bb_html_global_add','Add new html global '.$insertData['title'],$username);

    return 'OK';

}

function bb_add_post_prefix()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $prefix_id=newID(6);

    $insertData=array(
        'prefix_id'=>$prefix_id,
        'title'=>addslashes(getPost('title')),
        'bg_color_c'=>addslashes(getPost('color')),
        'status'=>addslashes(getPost('status')),
        'user_id'=>$username
    );    


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_post_prefix_data',$insertData);

    $db->nonquery($queryStr);

    if(file_exists(BB_CACHES_PATH.'post_prefix.php'))
    {
        unlink(BB_CACHES_PATH.'post_prefix.php');
    }

    saveActivities('bb_post_prefix_add','Add new post prefix '.$insertData['title'],$username);

    return 'OK';

}

function bb_forum_sort_up()
{
    $forum_id=addslashes(getPost('forum_id'));
    $parent_id=addslashes(getPost('parent_id'));
    $sort_order=addslashes(getPost('sort_order'));

    $db=new Database(); 

    $loadTargetData=$db->query("select * from bb_forum_data  where ifnull(parent_id,'')='".$parent_id."' AND sort_order<'".$sort_order."' order by parent_id,sort_order desc limit 0,1 ");

    if(is_array($loadTargetData) && count($loadTargetData) > 0)
    {
        $db->nonquery("update bb_forum_data set sort_order='".$sort_order."' where forum_id='".$loadTargetData[0]['forum_id']."'");  
        $db->nonquery("update bb_forum_data set sort_order='".$loadTargetData[0]['sort_order']."' where forum_id='".$forum_id."'");  
    }

    if(file_exists(BB_CACHES_PATH.'forums.php'))
    {
        unlink(BB_CACHES_PATH.'forums.php');
    }

    if(file_exists(BB_CACHES_PATH.'forum_id_'.$forum_id.'.php'))
    {
        unlink(BB_CACHES_PATH.'forum_id_'.$forum_id.'.php');
    }    


    $savePath=BB_CACHES_PATH.'breadcum_data.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

}

function bb_forum_sort_down()
{
    $forum_id=addslashes(getPost('forum_id'));
    $parent_id=addslashes(getPost('parent_id'));
    $sort_order=addslashes(getPost('sort_order'));

    $db=new Database(); 

    $loadTargetData=$db->query("select * from bb_forum_data  where ifnull(parent_id,'')='".$parent_id."' AND sort_order>'".$sort_order."' order by parent_id,sort_order asc limit 0,1 ");

    if(is_array($loadTargetData) && count($loadTargetData) > 0)
    {
        $db->nonquery("update bb_forum_data set sort_order='".$sort_order."' where forum_id='".$loadTargetData[0]['forum_id']."'");  
        $db->nonquery("update bb_forum_data set sort_order='".$loadTargetData[0]['sort_order']."' where forum_id='".$forum_id."'");  
    }

    if(file_exists(BB_CACHES_PATH.'forums.php'))
    {
        unlink(BB_CACHES_PATH.'forums.php');
    }

    if(file_exists(BB_CACHES_PATH.'forum_id_'.$forum_id.'.php'))
    {
        unlink(BB_CACHES_PATH.'forum_id_'.$forum_id.'.php');
    }


    $savePath=BB_CACHES_PATH.'breadcum_data.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }
}

function bb_smile_category_sort_up()
{
    $category_id=addslashes(getPost('category_id'));
    $sort_order=addslashes(getPost('sort_order'));

    $db=new Database(); 

    $loadTargetData=$db->query("select * from bb_smiles_category_data  where sort_order<'".$sort_order."' order by sort_order desc limit 0,1 ");

    if(is_array($loadTargetData) && count($loadTargetData) > 0)
    {
        $db->nonquery("update bb_smiles_category_data set sort_order='".$sort_order."' where category_id='".$loadTargetData[0]['category_id']."'");  
        $db->nonquery("update bb_smiles_category_data set sort_order='".$loadTargetData[0]['sort_order']."' where category_id='".$category_id."'");  
    }

    BB_Smiles::clearCache();

}

function bb_smile_category_sort_down()
{
    $category_id=addslashes(getPost('category_id'));
    $sort_order=addslashes(getPost('sort_order'));

    $db=new Database(); 

    $loadTargetData=$db->query("select * from bb_smiles_category_data  where sort_order>'".$sort_order."' order by sort_order asc limit 0,1 ");

    if(is_array($loadTargetData) && count($loadTargetData) > 0)
    {
        $db->nonquery("update bb_smiles_category_data set sort_order='".$sort_order."' where category_id='".$loadTargetData[0]['category_id']."'");  
        $db->nonquery("update bb_smiles_category_data set sort_order='".$loadTargetData[0]['sort_order']."' where category_id='".$category_id."'");  
    }

    BB_Smiles::clearCache();

}

function bb_update_usergroup_permission()
{
    $group_id=getPost('group_id','');
    $forum_id=getPost('forum_id','');
    $permission_list=getPost('permission_list','');


    $queryStrPer='';

    if(isset($permission_list[1]))
    {
        $split=explode(',', $permission_list);

        $total=count($split);

        $insertPerQuery='';

        for ($i=0; $i < $total; $i++) { 

            if(!isset($split[$i][1]))
            {
                continue;
            }

            $insertPerQuery=array(
                'forum_id'=>$forum_id,
                'group_id'=>$group_id,
                'permission_c'=>$split[$i]
            );                

            $queryStrPer.=arrayToInsertStr('bb_forum_usergroup_permission_data',$insertPerQuery);
        }

        $db=new Database(); 

        $db->nonquery("delete from bb_forum_usergroup_permission_data where group_id='".$group_id."' AND forum_id='".$forum_id."'");   

        $db->nonquery($queryStrPer);   

        $childData=$db->query("select forum_id from bb_forum_data where parent_id='".$forum_id."'");

        $totalChild=count($childData);

        $queryStrPer='';

        for ($k=0; $k < $totalChild; $k++) { 
            $db->nonquery("delete from bb_forum_usergroup_permission_data where group_id='".$group_id."' AND forum_id='".$childData[$k]['forum_id']."'");   
   
            for ($i=0; $i < $total; $i++) { 

                if(!isset($split[$i][1]))
                {
                    continue;
                }
    
                $insertPerQuery=array(
                    'forum_id'=>$childData[$k]['forum_id'],
                    'group_id'=>$group_id,
                    'permission_c'=>$split[$i]
                );                
    
                $queryStrPer.=arrayToInsertStr('bb_forum_usergroup_permission_data',$insertPerQuery);
            }
            
        }

        $db->nonquery($queryStrPer);   
        
    }   
    
    return 'OK';

}

function bb_update_user_permission()
{
    $user_id=getPost('user_id','');
    $forum_id=getPost('forum_id','');
    $permission_list=getPost('permission_list','');


    $queryStrPer='';

    if(isset($permission_list[1]))
    {
        $split=explode(',', $permission_list);

        $total=count($split);

        $insertPerQuery='';

        for ($i=0; $i < $total; $i++) { 

            if(!isset($split[$i][1]))
            {
                continue;
            }

            $insertPerQuery=array(
                'forum_id'=>$forum_id,
                'user_id'=>$user_id,
                'permission_c'=>$split[$i]
            );                

            $queryStrPer.=arrayToInsertStr('bb_forum_user_permission_data',$insertPerQuery);
        }

        $db=new Database(); 

        $db->nonquery("delete from bb_forum_user_permission_data where user_id='".$user_id."' AND forum_id='".$forum_id."'");   

        $db->nonquery($queryStrPer);   

        
    }
    else
    {

        $db=new Database(); 

        $db->nonquery("delete from bb_forum_user_permission_data where user_id='".$user_id."' AND forum_id='".$forum_id."'");   

    }
    
    return 'OK';

}

function bb_add_user_permission()
{
    $username=getPost('username','');
    $forum_id=getPost('forum_id','');
    $permission_list=getPost('permission_list','');


    $queryStrPer='';

    if(isset($permission_list[1]))
    {
        $db=new Database(); 

        $userData=$db->query("select * from user_mst where username='".$username."' OR email='".$username."'");

        $user_id=$userData[0]['user_id'];

        $split=explode(',', $permission_list);

        $total=count($split);

        $insertPerQuery='';

        for ($i=0; $i < $total; $i++) { 

            if(!isset($split[$i][1]))
            {
                continue;
            }

            $insertPerQuery=array(
                'forum_id'=>$forum_id,
                'user_id'=>$user_id,
                'permission_c'=>$split[$i]
            );                

            $queryStrPer.=arrayToInsertStr('bb_forum_user_permission_data',$insertPerQuery);
        }

        $db->nonquery("delete from bb_forum_user_permission_data where user_id='".$user_id."' AND forum_id='".$forum_id."'");


        $db->nonquery($queryStrPer);   

                
        $childData=$db->query("select forum_id from bb_forum_data where  parent_id='".$forum_id."'");

        $totalChild=count($childData);

        $queryStrPer='';

        for ($k=0; $k < $totalChild; $k++) { 
            $db->nonquery("delete from bb_forum_user_permission_data where user_id='".$user_id."' AND forum_id='".$childData[$k]['forum_id']."'");

            for ($i=0; $i < $total; $i++) { 

                if(!isset($split[$i][1]))
                {
                    continue;
                }
    
                $insertPerQuery=array(
                    'forum_id'=>$childData[$k]['forum_id'],
                    'user_id'=>$user_id,
                    'permission_c'=>$split[$i]
                );                
    
                $queryStrPer.=arrayToInsertStr('bb_forum_user_permission_data',$insertPerQuery);
            }
        }

        $db->nonquery($queryStrPer);   
        
    }

    return 'OK';

}

function bb_add_banned_email()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $email=addslashes(strtolower(getPost('email')));

    $insertData=array(
        'data_method'=>'email',
        'username'=>$email,
        'user_id'=>$username
    );    

    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_banned_user_data',$insertData);

    $db->nonquery("delete from bb_banned_user_data where username='".$email."'");
    $db->nonquery($queryStr);

    $hash=md5($email);

    $savePath=PUBLIC_PATH.'bb_contents/firewall/email/'.$hash;

    if(!is_dir($savePath))
    {
        mkdir($savePath);
    }

    saveActivities('bb_banned_email_add','Banned email '.$insertData['username'],$username);

    return 'OK';

}

function bb_add_banned_browser()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $browser=addslashes(strtoupper(getPost('browser')));

    $insertData=array(
        'browser_name'=>$browser,
        'user_id'=>$username
    );    

    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_banned_browser_data',$insertData);

    $db->nonquery("delete from bb_banned_browser_data where browser_name='".$browser."'");
    $db->nonquery($queryStr);

    $savePath=PUBLIC_PATH.'bb_contents/firewall/browser/'.strtoupper($browser);

    if(!is_dir($savePath))
    {
        mkdir($savePath);
    }

    saveActivities('bb_banned_browser_add','Banned browser '.$insertData['browser_name'],$username);

    return 'OK';

}

function bb_add_captcha_question()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $insertData=array(
        'title'=>addslashes(getPost('title')),
        'answer'=>addslashes(getPost('answer')),
        'status'=>addslashes(getPost('status')),
        'user_id'=>$username
    );    

    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_capcha_questions_data',$insertData);

    $db->nonquery($queryStr);

    saveActivities('bb_capcha_questions_add','Add captcha question '.$insertData['title'],$username);

    return 'OK';

}

function bb_add_banned_username()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $email=addslashes(getPost('email'));

    $insertData=array(
        'data_method'=>'username',
        'username'=>$email,
        'user_id'=>$username
    );    

    $db=new Database(); 

    $canUpdate=compareGroupPriorityByUserName(Configs::$_['user_data']['user_id'],$email);

    if($canUpdate==false)
    {
        echo responseData('You not have permission to do this action','yes');die();
    }

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_banned_user_data',$insertData);

    $db->nonquery("delete from bb_banned_user_data where username='".$email."'");
    $db->nonquery($queryStr);

    // $db->nonquery("update user_mst set group_c='".Configs::$_['default_member_banned_groupid']."' where username='".$email."'");

    $savePath=PUBLIC_PATH.'bb_contents/firewall/username/'.md5(strtoupper($email));

    if(!is_dir($savePath))
    {
        mkdir($savePath);
    }


    saveActivities('bb_banned_username_add','Banned username '.$insertData['username'],$username);

    return 'OK';

}

function bb_check_license()
{
    $bb_renew_license=trim(getPost('bb_renew_license',''));


    $response=file_get_contents("http://localhost/lioncms/api/plugin_api?plugin=plugin_notify&plugin_nm=bulletinboard&func=verify_license&key=".$bb_renew_license."&url=".urlencode(SITE_URL));
    // $response=file_get_contents("http://coffeecms.net/api/plugin_api?plugin=plugin_notify&plugin_nm=bulletinboard&func=verify_license&key=".$key."&url=".urlencode(SITE_URL));

    $responseData=json_decode($response);

 
    if($responseData->error=='yes')
    {
        echo responseData('NOTVALID','yes');die();
    }
    else
    {
        if($responseData->data=='EXPIRED' || $responseData->data=='NOTFOUND')
        {
            echo responseData('NOTVALID','yes');die();
        }

        $db=new Database();
    
        $expires_dt=$responseData->data;

        $db->nonquery("update setting_data set key_value='".$bb_renew_license."' where key_c='bb_license_key'");

        $db->nonquery("update setting_data set key_value='".$expires_dt."' where key_c='bb_license_end_dt'");  

        $savePath=PUBLIC_PATH.'caches/system_setting.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

        echo responseData('OK','no');die();  
    }

}
function bb_add_smile_category()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $title=addslashes(getPost('title'));

    $id=newID(12);

    $insertData=array(
        'category_id'=>$id,
        'friendly_url'=>friendlyString(getPost('title')),
        'title'=>$title,
        'status'=>'1',
        'sort_order'=>'0',
        'user_id'=>$username
    );    

    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_smiles_category_data',$insertData);

    $db->nonquery("update bb_smiles_category_data set sort_order=sort_order+1 ");
    $db->nonquery($queryStr);

    $newPath=ROOT_PATH.'public/bb_contents/smiles/'.$insertData['friendly_url'];

    if(!is_dir($newPath))
    {
        mkdir($newPath);
    }

    BB_Smiles::clearCache();

    saveActivities('bb_smiles_add_category_data','Add smile category '.$insertData['title'],$username);

    
    return 'OK';

}

function bb_add_banned_ipaddress()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $ip=addslashes(getPost('ip'));

    $insertData=array(
        'ip_address'=>$ip,
        'user_id'=>$username
    );    

    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_banned_ip_data',$insertData);

    $db->nonquery("delete from bb_banned_ip_data where ip_address='".$ip."'");
    $db->nonquery($queryStr);

    $savePath=PUBLIC_PATH.'bb_contents/firewall/ip/'.md5($ip);

    if(!is_dir($savePath))
    {
        mkdir($savePath);
    }

    saveActivities('bb_banned_ip_add','Banned ip '.$insertData['ip_address'],$username);

    return 'OK';

}

function bb_add_banned_os()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $os=addslashes(strtoupper(getPost('os')));

    $insertData=array(
        'os_name'=>$os,
        'user_id'=>$username
    );    

    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToInsertStr('bb_banned_os_data',$insertData);

    $db->nonquery("delete from bb_banned_os_data where os_name='".$os."'");
    $db->nonquery($queryStr);

    $savePath=PUBLIC_PATH.'bb_contents/firewall/os/'.strtoupper($os);

    if(!is_dir($savePath))
    {
        mkdir($savePath);
    }

    saveActivities('bb_banned_os_add','Banned operating system '.$insertData['os_name'],$username);

    return 'OK';

}

function bb_reaction_add()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $images=addslashes(getPost('images'));
    $title=addslashes(getPost('title'));
    $textcolor=addslashes(getPost('textcolor'));
    $sortorder=addslashes(getPost('sortorder'));

    $splitImages=explode("||",$images);
    $splitTitle=explode("||",$title);
    $splitTextcolor=explode("||",$textcolor);
    $splitSortOrder=explode("||",$sortorder);

    $total=count($splitImages);

    $queryStr='';

    $db=new Database(); 

    $imgPath='public/bb_contents/reactions/';

    for ($i=0; $i < $total; $i++) { 
        $reaction_id= newID(8);

        if(strlen($splitImages[$i]) > 2)
        {
            copy(ROOT_PATH.str_replace(SITE_URL,"",$splitImages[$i]),ROOT_PATH.$imgPath.basename($splitImages[$i]));

            unlink(ROOT_PATH.str_replace(SITE_URL,"",$splitImages[$i]));
    
            $insertData=array(
                'reaction_id'=>$reaction_id,
                'title'=>$splitTitle[$i],
                'text_color'=>$splitTextcolor[$i],
                'image_path'=>$imgPath.basename($splitImages[$i]),
                'sort_order'=>$splitSortOrder[$i],
                'user_id'=>$username
            );            
    
            $queryStr.=arrayToInsertStr('bb_reaction_data',$insertData);
    
        }

    }

    $db->nonquery($queryStr);

    BB_Reactions::clearCache();


    saveActivities('bb_reaction_add','Add new reaction',$username);

    return 'OK';

}

function bb_smile_add()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }


    $images=addslashes(getPost('images'));
    $textreplace=addslashes(getPost('textreplace'));
    $sortorder=addslashes(getPost('sortorder'));
    $category_id=addslashes(getPost('category_id',''));

    if(!isset($category_id[2]))
    {
        return 'ERROR_05';
    }

    $splitImages=explode("||",$images);
    $splitTitle=explode("||",$textreplace);
    $splitSortOrder=explode("||",$sortorder);

    $total=count($splitImages);

    $queryStr='';
    $text_replace='';

    $db=new Database(); 

    $categoryData=$db->query("select * from bb_smiles_category_data where category_id='".$category_id."'");

    $imgPath='public/bb_contents/smiles/'.$categoryData[0]['friendly_url'].'/';

    if(!is_dir(ROOT_PATH.'public/bb_contents/smiles/'.$categoryData[0]['friendly_url']))
    {
        mkdir(ROOT_PATH.'public/bb_contents/smiles/'.$categoryData[0]['friendly_url']);
    }

    for ($i=0; $i < $total; $i++) { 
        $smile_id= newID(8);

        if(strlen($splitImages[$i]) > 2)
        {
            copy(ROOT_PATH.str_replace(SITE_URL,"",$splitImages[$i]),ROOT_PATH.$imgPath.basename($splitImages[$i]));

            unlink(ROOT_PATH.str_replace(SITE_URL,"",$splitImages[$i]));

            $text_replace=trim($splitTitle[$i]);

            if(strlen($text_replace)==0)
            {
                $text_replace=":".$smile_id.":";
            }
    
            $insertData=array(
                'smile_id'=>$smile_id,
                'category_id'=>$category_id,
                'text_replace'=>$text_replace,
                'image_path'=>$imgPath.basename($splitImages[$i]),
                'sort_order'=>$splitSortOrder[$i],
            );            
    
            $queryStr.=arrayToInsertStr('bb_smiles_data',$insertData);
    
        }

    }

    $db->nonquery($queryStr);

    BB_Smiles::clearCache();

    saveActivities('bb_smiles_add','Add new smile',$username);

    return 'OK';

}

function bb_edit_forum()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $forum_id=getPost('forum_id');


    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'parent_id'=>addslashes(getPost('parent_id')),
        'friendly_url'=>friendlyString(getPost('title'),'_')."_".$forum_id,
        'descriptions'=>addslashes(getPost('descriptions')),
        'thumbnail'=>addslashes(getPost('thumbnail')),
        'forum_type'=>addslashes(getPost('forum_type')),
        'short_content'=>addslashes(getPost('short_content')),
        'allow_create_thread'=>addslashes(getPost('allow_create_thread')),
        'keywords'=>addslashes(getPost('keywords')),
        'status'=>addslashes(getPost('status')),
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'forum_id'=>"='".$forum_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_forum_data',$insertData);

    $db->nonquery($queryStr);

    saveActivities('bb_forum_edit','Update forum '.$updateData['title'],$username);

    if(file_exists(BB_CACHES_PATH.'forums.php'))
    {
        unlink(BB_CACHES_PATH.'forums.php');
    }

    if(file_exists(BB_CACHES_PATH.'forum_id_'.$forum_id.'.php'))
    {
        unlink(BB_CACHES_PATH.'forum_id_'.$forum_id.'.php');
    }
    
    $savePath=BB_CACHES_PATH.'breadcum_data.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

    return 'OK';

}

function bb_edit_annoucement()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $a_id=getPost('a_id');

    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'forum_id'=>addslashes(getPost('forum_id')),
        'group_id'=>addslashes(getPost('usergroup_id')),
        'content'=>addslashes(getPost('content')),
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'a_id'=>"='".$a_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_annoucement_data',$insertData);

    $db->nonquery($queryStr);

    $savePath=BB_CACHES_PATH.'annoucement.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

    saveActivities('bb_annoucement_edit','Update annoucement '.$updateData['title'],$username);

    $savePath=BB_CACHES_PATH.'annoucement.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

    return 'OK';

}

function bb_edit_bbcode()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $bbcode_id=getPost('bbcode_id');


    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'tagname'=>addslashes(getPost('tagname')),
        'replace_data'=>addslashes(getPost('replace_data')),
        'example_str'=>addslashes(getPost('example_str')),
        'descriptions'=>addslashes(getPost('descriptions')),
        'status'=>addslashes(getPost('status')),
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'bbcode_id'=>"='".$bbcode_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_bbcode_data',$insertData);

    $db->nonquery($queryStr);

    saveActivities('bb_bbcode_edit','Update bbcode '.$updateData['title'],$username);

    return 'OK';

}

function bb_edit_user()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');die();
    }

    useClass('EmailSystem');

    $user_id=newID(16);


    $user_c=getPost('user_c');
    $password=getPost('password','');
    $newpassword=getPost('newpassword','');
    $newrepassword=getPost('newrepassword','');
    $rank_id=getPost('rank_id','');

    $updateData=array(
        'fullname'=>addslashes(getPost('fullname','')),
        'email'=>addslashes(getPost('email','')),
        'group_c'=>addslashes(getPost('group_c','')),
        'level_c'=>addslashes(getPost('level_c','')),
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'user_id'=>"='".$user_c."'",
        )

    );

    if(isset($newpassword[1]) && $newpassword<>$newrepassword)
    {
        echo responseData('Your new password not match Confirm password','yes');die();
    }

    $canUpdate=compareGroupPriorityByUserId(Configs::$_['user_data']['user_id'],$user_c);

    if($canUpdate==false)
    {
        echo responseData('You not have permission to do this action','yes');return false;
    }

    // if(!isset(Configs::$_['user_permissions']['menu07']))
    // {
    //     echo responseData('You not have permission do this action','yes');die();
    // }  

    if(isset($newpassword[1]) && $newpassword==$newrepassword)
    {
        $insertData['update']['password']=md5(addslashes(getPost('newpassword','')));
    }

    $queryStr=arrayToUpdateStr('user_mst',$insertData);
    $db=new Database(); 

    $db->nonquery($queryStr);
    
    $updateData=array(
        'website'=>addslashes(getPost('website','')),
        'signature'=>addslashes(getPost('signature','')),
        'about'=>addslashes(getPost('about','')),
        'max_message'=>addslashes(getPost('max_message','')),
        'created_message'=>addslashes(getPost('created_message','')),
        'total_points'=>addslashes(getPost('total_points','')),
        'balance'=>addslashes(getPost('balance','')),
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'user_id'=>"='".$user_c."'",
        )
    );    

    $queryStr=arrayToUpdateStr('bb_user_data',$insertData);
    $db->nonquery($queryStr);

    if(isset($rank_id[5]))
    {
        $db->nonquery("delete from bb_users_rank_data where user_id='".$user_c."'");
        $splitRanks=explode(',',$rank_id);

        $total=count($splitRanks);

        for ($i=0; $i < $total; $i++) { 

            if(strlen(trim($splitRanks[$i]))==0)
            {
                continue;
            }

            $insertData=array(
                'user_id'=>$user_c,
                'rank_id'=>$splitRanks[$i],
            );    
        
            $queryStr=arrayToInsertStr('bb_users_rank_data',$insertData);
            $db->nonquery($queryStr);
        }

        BB_UserRanks::clear_by_userid($user_c);
    }

    load_hook('after_update_user',$updateData);

    saveActivities('user_update','Update user '.$user_c,$username);

    if(isset($newpassword[1]) && $newpassword==$newrepassword)
    {
        EmailSystem::prepare_send_change_password($user_c,$newpassword);
    }


    return 'OK';

}


function bb_get_list_user()
{
        //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $start_date=addslashes(getPost('start_date',''));
    $end_date=addslashes(getPost('end_date',''));
    $user_id=addslashes(getPost('user_id',''));
    $email=addslashes(getPost('email',''));
    $username=addslashes(getPost('username',''));
    $user_id=addslashes(getPost('author_id',''));
    $username=addslashes(getPost('username',''));
    $group_c=addslashes(getPost('group_c',''));
    $level_c=addslashes(getPost('level_c',''));
    $limit=addslashes(getPost('limit','30'));
    $page_no=addslashes(getPost('page_no','1'));
    $ip=addslashes(getPost('ip',''));
    $useragent=addslashes(getPost('useragent',''));

    if((int)$page_no<=0)
    {
        $page_no=1;
    }
    
    if((int)$page_no > 0)
    {
        $page_no=(int)$page_no-1;
    }


    $offset=(int)$page_no*30;

    if($user_id=='all')
    {
        $user_id='';
    }
    if($group_c=='all')
    {
        $group_c='';
    }
    if($level_c=='all')
    {
        $level_c='';
    }


    $queryStr='';

    $queryStr=" SELECT a.*,b.title as group_title, c.title as level_title,";
    $queryStr.=" d.max_message,d.created_message,d.bio,d.website,d.skills,d.job,d.signature,";
    $queryStr.=" ifnull(banned.username,'') as banned";
    $queryStr.=" FROM user_mst a left join user_group_mst b ON a.group_c=b.group_c";
    $queryStr.=" left join user_level_mst c ON a.level_c=c.level_id ";
    $queryStr.=" left join (select username from bb_banned_user_data where data_method='username') banned ON a.username=banned.username ";
    $queryStr.=" left join bb_user_data d ON a.user_id=d.user_id   WHERE a.user_id<>'' AND CAST(a.ent_dt as date) BETWEEN '".$start_date."' AND '".$end_date."' ";

    if(isset($user_id[5]))
    {
        $queryStr.=" AND a.user_id='".$user_id."' ";
    }

    if(isset($useragent[5]))
    {
        $queryStr.=" AND d.last_user_user_agent LIKE '%".$useragent."%' ";
    }

    if(isset($ip[5]))
    {
        $queryStr.=" AND d.last_user_ip_address='".$ip."' ";
    }
    if(isset($username[1]))
    {
        $queryStr.=" AND a.username='".$username."' ";
    }
    if(isset($group_c[5]))
    {
        $queryStr.=" AND a.group_c='".$group_c."' ";
    }
    if(isset($level_c[5]))
    {
        $queryStr.=" AND a.level_c='".$level_c."' ";
    }
    if(isset($email[5]))
    {
        $queryStr.=" AND a.email='".$email."' ";
    }

    $queryStr.=" order by a.upd_dt desc limit ".$offset.",".$limit;

     // echo responseData($queryStr,'yes');die();

    $db=new Database(); 
    $result=$db->query($queryStr);


    echo responseData($result,'no');die();
}

function bb_get_list_resources()
{
        //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $start_date=addslashes(getPost('start_date',''));
    $end_date=addslashes(getPost('end_date',''));
    $sizesmall=addslashes(getPost('sizesmall',''));
    $sizelarge=addslashes(getPost('sizelarge',''));
    $file_type=addslashes(getPost('file_type',''));
    $limit=addslashes(getPost('limit','100'));
    $page_no=addslashes(getPost('page_no','1'));

    if((int)$page_no > 0)
    {
        $page_no=(int)$page_no-1;
    }
    if((int)$page_no<=0)
    {
        $page_no=0;
    }

    if(strlen($sizesmall) > 0 && strlen($sizelarge) > 0)
    {
        $sizelarge='';
    }

    $offset=(int)$page_no*30;

    $queryStr='';

    $queryStr=" select * from bb_attach_files_data ";
    $queryStr.="  WHERE file_id<>'' AND CAST(ent_dt as date) BETWEEN '".$start_date."' AND '".$end_date."'";

    if(isset($file_type[1]))
    {
        $queryStr.=" AND file_type ='".$file_type."' ";
    }
    if(isset($sizesmall[1]))
    {
        $queryStr.=" AND file_size <= '".$sizesmall."' ";
    }
    if(isset($sizelarge[1]))
    {
        $queryStr.=" AND file_size >= '".$sizelarge."' ";
    }

    $queryStr.=" order by ent_dt desc limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);

    echo responseData($result,'no');die();
}


function bb_add_new_user()
{
       //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

   try {
       isValidAccessAPI();
   } catch (\Exception $e) {
       echo responseData($e->getMessage(),'yes');return false;
   }

//    useClass('EmailSystem');

   $user_id=newID(12);

   $insertData=array(
       'user_id'=>$user_id ,
       'group_c'=>addslashes(getPost('group_c')),
       'level_c'=>addslashes(getPost('level_c')),
       'email'=>addslashes(getPost('email')),
       'password'=>md5(addslashes(getPost('password'))),
       'username'=>addslashes(getPost('username')),
       'fullname'=>addslashes(getPost('fullname','')),
       'status'=>'1',
   );

   $queryStr=arrayToInsertStr('user_mst',$insertData);
   $db=new Database(); 
   $db->nonquery($queryStr);   

   $queryStr="insert into bb_user_data(user_id)";
    $queryStr.="select user_id from user_mst where user_id NOT IN (select user_id from bb_user_data);";
    $db->nonquery($queryStr);

   load_hook('after_insert_user',$insertData);

   saveActivities('user_add','Add new user '.$insertData['username'],$username);

//    EmailSystem::prepare_send_newuser($insertData);

   echo responseData('OK');
}


function bb_edit_rank()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $rank_id=getPost('rank_id');
    $group_id=addslashes(getPost('group_id'));

    $img=addslashes(getPost('img'));

    $newImgPath=$img;

    if(isset($img[5]))
    {
        $img=str_replace(SITE_URL,'',$img);

        if(isset($img[2]) && preg_match('/\.\w+$/i',$img))
        {
            $splitIMG=explode('.',$img);

            $newImgPath='public/bb_contents/'.newID(10).'.'.$splitIMG[count($splitIMG)-1];

            if(file_exists(ROOT_PATH.$img))
            {
                copy(ROOT_PATH.$img,ROOT_PATH.$newImgPath);
                unlink(ROOT_PATH.$img);
            }              
        }
      
    }



    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'status'=>addslashes(getPost('status')),
        'left_str'=>addslashes(getPost('left_str')),
        'right_str'=>addslashes(getPost('right_str')),
        'bg_color_c'=>addslashes(getPost('color')),
        'image'=>$newImgPath,
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'rank_id'=>"='".$rank_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_ranks_data',$insertData);

    $db->nonquery($queryStr);

    if(isset($group_id[2]))
    {
        $db->nonquery("delete from bb_usergroup_ranks_data where rank_id='".$rank_id."'");
        $db->nonquery("insert into bb_usergroup_ranks_data(group_id,rank_id) VALUES('".$group_id."','".$rank_id."')");
    }

    saveActivities('bb_ranks_edit','Update rank '.$updateData['title'],$username);

    return 'OK';

}

function bb_edit_captcha_question()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $question_id=getPost('question_id');


    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'answer'=>addslashes(getPost('answer')),
        'status'=>addslashes(getPost('status')),
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'question_id'=>"='".$question_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_capcha_questions_data',$insertData);

    $db->nonquery($queryStr);

    saveActivities('bb_capcha_questions_edit','Update question '.$updateData['title'],$username);

    return 'OK';

}

function bb_edit_post_prefix()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $prefix_id=getPost('prefix_id');


    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'bg_color_c'=>addslashes(getPost('color')),
        'status'=>addslashes(getPost('status')),
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'prefix_id'=>"='".$prefix_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_post_prefix_data',$insertData);

    $db->nonquery($queryStr);

    if(file_exists(BB_CACHES_PATH.'post_prefix.php'))
    {
        unlink(BB_CACHES_PATH.'post_prefix.php');
    }


    saveActivities('bb_post_prefix_edit','Update post prefix '.$updateData['title'],$username);

    return 'OK';

}

function bb_edit_htmlglobal()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $html_c=getPost('code');


    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'content'=>addslashes(getPost('content')),
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'html_c'=>"='".$html_c."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_html_global_data',$insertData);

    $db->nonquery($queryStr);

    $savePath=BB_CACHES_PATH.'php_hook_'.$html_c.'.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }


    saveActivities('bb_html_global_edit','Update html global '.$updateData['title'],$username);

    return 'OK';

}

function bb_reaction_edit()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $reaction_id=getPost('reaction_id');


    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'sort_order'=>addslashes(getPost('sortorder')),
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'reaction_id'=>"='".$reaction_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_reaction_data',$insertData);

    $db->nonquery($queryStr);

    BB_Reactions::clearCache();

    saveActivities('bb_reaction_edit','Update reaction '.$updateData['title'],$username);

    return 'OK';

}

function bb_smiles_item_edit()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $category_id=getPost('category_id');
    $smile_id=getPost('smile_id');


    $updateData=array(
        'text_replace'=>addslashes(getPost('textreplace')),
        'sort_order'=>addslashes(getPost('sortorder')),
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'smile_id'=>"='".$smile_id."'",
            'category_id'=>"='".$category_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_smiles_data',$insertData);

    $db->nonquery($queryStr);

    BB_Smiles::clearCache();

    saveActivities('bb_smiles_edit','Update smile item',$username);

    return 'OK';

}

function bb_update_smile_category()
{
    
    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // print_r(Configs::$_['user_data']);die();

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        return 'ERROR_01';
    }

    $category_id=getPost('category_id');


    $updateData=array(
        'title'=>addslashes(getPost('title')),
        'user_id'=>$username
    );

    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'category_id'=>"='".$category_id."'",
        )

    );  


    $db=new Database(); 

    // $queryStr=arrayToInsertStr('post_data_'.$tableNumber,$insertData);
    $queryStr=arrayToUpdateStr('bb_smiles_category_data',$insertData);

    $db->nonquery($queryStr);

    BB_Smiles::clearCache();

    saveActivities('bb_smiles_edit_category_data','Update smile category '.$updateData['title'],$username);

    return 'OK';

}


function bb_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_forum_id=addslashes(getPost('list_forum_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_forum_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 

        if(strlen($split_post_c[$i]) > 3)
        {
            $reformat_post_c.="'".$split_post_c[$i]."',";

            BB_Forum::updateStats($split_post_c[$i]);
        }

    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_forum_data where forum_id IN (".$reformat_post_c.")";

    }        
    elseif($action=='deactivate')
    {
                        
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_forum_data set status='0' where forum_id IN (".$reformat_post_c.")";
        
    }        
    elseif($action=='activate')
    {
                                    
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_forum_data set status='1' where forum_id IN (".$reformat_post_c.")";

    }

    $db=new Database(); 
    $db->nonquery($queryStr);

    if(file_exists(BB_CACHES_PATH.'forums.php'))
    {
        unlink(BB_CACHES_PATH.'forums.php');
    }

    BB_System::updateStats();

    return 'OK';
}

function bb_annoucement_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_annoucement_data where a_id IN (".$reformat_post_c.")";

    }        
   

    $db=new Database(); 
    $db->nonquery($queryStr);

    $savePath=BB_CACHES_PATH.'annoucement.php';

    if(file_exists($savePath))
    {
        
        unlink($savePath);
    }

    return 'OK';
}

function bb_resources_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_attach_files_data where file_id IN (".$reformat_post_c.")";

    }        
   

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_rank_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_ranks_data where rank_id IN (".$reformat_post_c.")";

    }        
    elseif($action=='deactivate')
    {
                        
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_ranks_data set status='0' where rank_id IN (".$reformat_post_c.")";
        
    }        
    elseif($action=='activate')
    {
                                    
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_ranks_data set status='1' where rank_id IN (".$reformat_post_c.")";

    }

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}



function bb_get_list_threads()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    // try {
    //     isValidAccessAPI();
    // } catch (\Exception $e) {
    //     echo responseData($e->getMessage(),'yes');return false;
    // }

    $forum_id=addslashes(getPost('forum_id',''));
    $post_prefix=addslashes(getPost('post_prefix',''));
    $tags=addslashes(getPost('tags',''));
    $status=addslashes(getPost('status',''));
    $username=addslashes(getPost('username',''));
    $title=addslashes(getPost('title',''));
    $content=addslashes(getPost('content',''));
    $limit=addslashes(getPost('limit','30'));
    $page_no=addslashes(getPost('page_no','1'));
    $order_by=addslashes(getPost('order_by','upd_dt'));
    $order_type=addslashes(getPost('order_type','desc'));

    if((int)$page_no > 0)
    {
        $page_no=(int)$page_no-1;
    }
    if((int)$page_no<=0)
    {
        $page_no=0;
    }

    $offset=(int)$page_no*50;


    if($status=='all')
    {
        $status='';
    }
    if($post_prefix=='all')
    {
        $post_prefix='';
    }



    $queryStr='';

    $addFields=' title,friendly_url,views,status,ent_dt,upd_dt,author,thread_id,forum_id,user_id,author ';

    $queryStr=" select ".$addFields;

    // if(isset($content[5]))
    // {
    //     $queryStr.=" content,";
    // }

    // $queryStr.=" views,category_c,user_id as author_id,ent_dt,upd_dt,b.username as author_username,b.avatar as author_avatar";
    $queryStr.=" from bb_threads_data a";
    $queryStr.=" where title<>'' ";

    if(isset($forum_id[5]))
    {
        $queryStr.=" AND forum_id='".$forum_id."' ";
    }

    if(isset($status[0]))
    {
        $queryStr.=" AND status='".$status."' ";
    }
    if(isset($prefix_id[0]))
    {
        $queryStr.=" AND prefix_id='".$prefix_id."' ";
    }

    if(isset($username[1]))
    {
        $queryStr.=" AND author='".$username."' ";
    }
    if(isset($title[0]))
    {
        $queryStr.=" AND title LIKE N'%".$title."%' ";
    }
    if(isset($content[0]))
    {
        $queryStr.=" AND content LIKE N'%".$content."%' ";
    }
    // if(isset($tags[0]))
    // {
    //     $queryStr.=" AND tags LIKE N'%".$tags."%' ";
    // }

    // if(!isset(Configs::$_['user_permissions']['menu08']))
    // {
    //     $queryStr.=" AND user_id='".$cookie_username."' ";
    // }

    $queryStr.=" order by ".$order_by." ".$order_type." limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);
    
    echo responseData($result,'no');die();
}

function bb_edit_group_ranks()
{
        //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $group_id=getPost('group_id');

    $ranks_list=getPost('ranks_list','');
    $title=getPost('title','');

    $queryStr='';
    $queryStrPer='';

    if(isset($ranks_list[1]))
    {
        $split=explode(',', $ranks_list);

        $total=count($split);

        $insertPerQuery='';

        for ($i=0; $i < $total; $i++) { 

            if(!isset($split[$i][1]))
            {
                continue;
            }

            $insertPerQuery=array(
                'group_id'=>$group_id,
                'rank_id'=>$split[$i]
            );                

            $queryStrPer.=arrayToInsertStr('bb_usergroup_ranks_data',$insertPerQuery);
        }

    }        

    $db=new Database(); 
    $db->nonquery("delete from bb_usergroup_ranks_data where group_id='".$group_id."'");   

    $db->nonquery($queryStr.$queryStrPer);   

    // clear_hook();
    saveActivities('bb_usergroup_ranks_edit','Update user group ranks '.$title,$username);
    // self::system_cache_clear();return;
    return 'OK';
    
}

function bb_captcha_question_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_capcha_questions_data where question_id IN (".$reformat_post_c.")";

    }        
    elseif($action=='deactivate')
    {
                        
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_capcha_questions_data set status='0' where question_id IN (".$reformat_post_c.")";
        
    }        
    elseif($action=='activate')
    {
                                    
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_capcha_questions_data set status='1' where question_id IN (".$reformat_post_c.")";

    }

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_thread_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }
    $db=new Database(); 

    $list_thread_id=addslashes(getPost('list_thread_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_thread_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    $totalThread=0;

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";

        BB_Threads::clearCacheByID($split_post_c[$i]);


    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';

    $queryStr="select forum_id from bb_threads_data where thread_id  IN (".$reformat_post_c.")";

    $loadThreadData=$db->query($queryStr);

    $totalThread=count($loadThreadData);

    for ($k=0; $k < $totalThread; $k++) { 
        BB_Forum::updateStats($loadThreadData[$k]['forum_id']);
    }

    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_threads_data where thread_id  IN (".$reformat_post_c.")";

        BB_System::updateStats();

    }        
    elseif($action=='deactivate')
    {
                        
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_threads_data set status='0' where thread_id  IN (".$reformat_post_c.")";
        
    }        
    elseif($action=='activate')
    {
                                    
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_threads_data set status='1' where thread_id  IN (".$reformat_post_c.")";

    }


    $db->nonquery($queryStr);

    return 'OK';
}

function bb_post_prefix_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_post_prefix_data where prefix_id IN (".$reformat_post_c.")";

    }        
    elseif($action=='deactivate')
    {
                        
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_post_prefix_data set status='0' where prefix_id IN (".$reformat_post_c.")";
        
    }        
    elseif($action=='activate')
    {
                                    
        // if(!isset(Configs::$_['user_permissions']['post06']))
        // {
        //     echo responseData('ERROR_02','yes'); return false;
        // }

        $queryStr="update bb_post_prefix_data set status='1' where prefix_id IN (".$reformat_post_c.")";

    }

    $db=new Database(); 
    $db->nonquery($queryStr);

    if(file_exists(BB_CACHES_PATH.'post_prefix.php'))
    {
        unlink(BB_CACHES_PATH.'post_prefix.php');
    }


    return 'OK';
}

function bb_html_global_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_html_c=addslashes(getPost('list_html_c',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_html_c);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_html_global_data where html_c IN (".$reformat_post_c.")";

    }        

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_reaction_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_reaction_data where reaction_id IN (".$reformat_post_c.")";

    }        
    

    $db=new Database(); 

    $loadData=$db->query("select * from bb_reaction_data where reaction_id IN (".$reformat_post_c.")");

    $total=count($loadData);

    for ($i=0; $i < $total; $i++) { 
        if(file_exists(ROOT_PATH.$loadData[$i]['image_path']))
        {
            unlink(ROOT_PATH.$loadData[$i]['image_path']);
        }
    }

    $db->nonquery($queryStr);

    BB_Reactions::clearCache();



    return 'OK';
}

function bb_smiles_item_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_smiles_data where smile_id IN (".$reformat_post_c.")";

    }        
    

    $db=new Database(); 

    $loadData=$db->query("select * from bb_smiles_data where smile_id IN (".$reformat_post_c.")");

    $total=count($loadData);

    for ($i=0; $i < $total; $i++) { 
        if(file_exists(ROOT_PATH.$loadData[$i]['image_path']))
        {
            unlink(ROOT_PATH.$loadData[$i]['image_path']);
        }
    }

    $db->nonquery($queryStr);

    BB_Smiles::clearCache();


    return 'OK';
}

function bb_banned_email_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_email=addslashes(getPost('list_email',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_email);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";

        if(is_dir(BB_FIREWALL_PATH.'email/'.md5(strtoupper($split_post_c[$i]))))
        {
            unlink(BB_FIREWALL_PATH.'email/'.md5(strtoupper($split_post_c[$i])));
        }
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_banned_user_data where username IN (".$reformat_post_c.") AND data_method='email'";
    }        
  

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_banned_username_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_email=addslashes(getPost('list_email',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_email);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";

        if(strlen($split_post_c[$i]) > 2)
        {
            if(is_dir(BB_FIREWALL_PATH.'username/'.strtoupper($split_post_c[$i])))
            {
                unlink(BB_FIREWALL_PATH.'username/'.strtoupper($split_post_c[$i]));
            }
        }

    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr.="delete from bb_banned_user_data where username IN (".$reformat_post_c.") AND data_method='username';";
        // $queryStr.="update bb_banned_user_data set group_c='".Configs::$_['default_member_groupid']."' where username IN (".$reformat_post_c.") AND data_method='username';";
    }        
  

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_smile_category_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_category_id=addslashes(getPost('list_category_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_category_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_smiles_category_data where category_id IN (".$reformat_post_c.");";
        $queryStr.="delete from bb_smiles_data where category_id IN (".$reformat_post_c.");";
        
    }        

    if($action=='activate')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="update bb_smiles_category_data set status='1' where category_id IN (".$reformat_post_c.")";
    }        

    if($action=='deactivate')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="update bb_smiles_category_data set status='0' where category_id IN (".$reformat_post_c.")";
    }        
  

    $db=new Database(); 
    $db->nonquery($queryStr);

    BB_Smiles::clearCache();

    return 'OK';
}

function bb_banned_ip_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_ip=addslashes(getPost('list_ip',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_ip);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";

        if(is_dir(BB_FIREWALL_PATH.'ip/'.md5($split_post_c[$i])))
        {
            unlink(BB_FIREWALL_PATH.'ip/'.md5($split_post_c[$i]));
        }
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_banned_ip_data where ip_address IN (".$reformat_post_c.")";
    }        
  

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_banned_os_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_os=addslashes(getPost('list_os',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_os);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";

        if(is_dir(BB_FIREWALL_PATH.'os/'.strtoupper($split_post_c[$i])))
        {
            unlink(BB_FIREWALL_PATH.'os/'.strtoupper($split_post_c[$i]));
        }
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_banned_os_data where os_name IN (".$reformat_post_c.")";
    }        
  

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_banned_browser_action_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_browser=addslashes(getPost('list_browser',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_browser);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";

        if(is_dir(BB_FIREWALL_PATH.'browser/'.strtoupper($split_pbrowsert_c[$i])))
        {
            unlink(BB_FIREWALL_PATH.'browser/'.strtoupper($split_post_c[$i]));
        }
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_banned_browser_data where browser_name IN (".$reformat_post_c.")";
    }        
  

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}

function bb_forum_user_permission_apply()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false


    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_user_id=addslashes(getPost('list_user_id',''));
    $forum_id=addslashes(getPost('forum_id',''));
    $action=addslashes(getPost('action',''));

    $split_post_c=explode(',', $list_user_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    

    $queryStr='';


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="delete from bb_forum_user_permission_data where forum_id='".$forum_id."' AND user_id IN (".$reformat_post_c.")";

    }        
  

    $db=new Database(); 
    $db->nonquery($queryStr);

    return 'OK';
}