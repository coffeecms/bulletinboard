<?php

function bb_change_thread_status()
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

        
    $db=new Database(); 


    if($action=='delete')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }


        $db->nonquery("delete from bb_post_reactions_data where type='post' AND post_id IN (select post_id from bb_posts_data where thread_id IN (".$reformat_post_c."))");   

        $db->nonquery("delete from bb_post_reactions_data where type='thread' AND post_id IN (".$reformat_post_c.")");   
  

        $queryStr="select file_path from bb_thread_attach_files_data where data_type='thread' AND post_id IN (".$reformat_post_c.")";
     
        $loadData=$db->query($queryStr);

        $total=count($loadData);

        for ($i=0; $i < $total; $i++) { 
            if(file_exists(ROOT_PATH.$loadData[$i]['file_path']))
            {
                unlink(ROOT_PATH.$loadData[$i]['file_path']);
            }
        }

        $queryStr="delete from bb_thread_attach_files_data where data_type='thread' AND post_id IN (".$reformat_post_c.")";
        $db->nonquery($queryStr);
        

        $queryStr="delete from bb_thread_tag_data where thread_id IN (".$reformat_post_c.")";
        $db->nonquery($queryStr);

                
        $pollData=$db->query("select * from bb_poll_data where thread_id IN (".$reformat_post_c.") ");

        $total=count($pollData);

        if($total > 0)
        {
            
            for ($i=0; $i < $total; $i++) { 
                $db->nonquery("delete from bb_poll_answer_data where poll_id='".$pollData[$i]['poll_id']."' ");
                $db->nonquery("delete from bb_poll_member_answer_data where poll_id='".$pollData[$i]['poll_id']."' ");
            }

            $db->nonquery("delete from bb_poll_data where thread_id IN (".$reformat_post_c.") ");

        }
        

        //    Replies
        $repliesAttachData=$db->query("select file_path from bb_thread_attach_files_data where data_type='post' AND post_id IN (select post_id from bb_posts_data where thread_id IN (".$reformat_post_c.") ) ");

        $total=count($repliesAttachData);

        for ($i=0; $i < $total; $i++) { 
            if(file_exists(ROOT_PATH.$repliesAttachData[$i]['file_path']))
            {
                unlink(ROOT_PATH.$repliesAttachData[$i]['file_path']);
            }
        }

        $db->nonquery("delete from bb_thread_attach_files_data where data_type='post' AND post_id IN (select post_id from bb_posts_data where thread_id IN (".$reformat_post_c.") ) ");

        $db->nonquery($queryStr);   

        $queryStr="delete from bb_threads_data where thread_id IN (".$reformat_post_c.");";
        $queryStr.="delete from bb_posts_data where thread_id IN (".$reformat_post_c.");";

        $db->nonquery($queryStr);
        
    }        

    if($action=='activate')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="update bb_threads_data set status='1' where thread_id IN (".$reformat_post_c.")";

    }        

    if($action=='deactivate')
    {
        // if(!isset(Configs::$_['user_permissions']['post09']))
        // {
        //     echo responseData('ERROR_01','yes'); return false;
        // }

        $queryStr="update bb_threads_data set status='0' where thread_id IN (".$reformat_post_c.")";

    }      


    $db->nonquery($queryStr);

    BB_System::updateStats();

    $savePath=BB_CACHES_PATH.'forums.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }
    
    return 'OK';

}