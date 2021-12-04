<?php

class AttachFile
{
    public static function index()
	{
        if(!preg_match('/attach_file\/file\-(\d+)/i',Configs::$_['uri'],$match))
		{
			// redirect to 404 page
			redirect_to(SITE_URL.'notify/notfound');
		}

        if((int)Configs::$_['bb_allow_guest_download_attach_files']==0 AND Configs::$_['user_data']['user_id']=='GUEST')
        {
            redirect_to(SITE_URL.'notify/permission');
        }

        $file_id=$match[1];

        $user_id=Configs::$_['user_data']['user_id'];
        $group_c=Configs::$_['user_data']['group_c'];

        $db=new Database(); 

        $fileData=[];

        $queryStr="";
        $forum_id="";

        
        $queryStr.="select file_path,file_name,data_type,post_id  from bb_thread_attach_files_data where file_id='".$file_id."'";

        $fileData=$db->query($queryStr);

        if(count($fileData)==0)
        {
            redirect_to(SITE_URL.'notify/notfound');
        }

        if($fileData[0]['data_type']=='thread')
        {
            $loadData=$db->query("select forum_id from bb_threads_data where thread_id='".$fileData[0]['post_id']."'");
            
            $forum_id=$loadData[0]['forum_id'];
        }
        elseif($fileData[0]['data_type']=='post')
        {
            $loadData=$db->query("select forum_id from bb_posts_data where post_id='".$fileData[0]['post_id']."'");
            
            $forum_id=$loadData[0]['forum_id'];
        }

        // Detect user group has permission BB20014 Disallow download attach files
        $queryStr=" SELECT *";
        $queryStr.=" FROM user_mst";
        $queryStr.=" where user_id='".$user_id."' AND group_c IN (select group_c";
        $queryStr.=" from group_permission_data";
        $queryStr.=" where group_c='".$group_c."' AND permission_c='BB20014')";

        $loadData=$db->query($queryStr);

        if(count($loadData) > 0)
        {
            redirect_to(SITE_URL.'notify/notfound');
        }

        if(isset($forum_id[2]))
        {
            // Detect user group has permission BB20014 Disallow download attach files in forum 
            $queryStr=" SELECT *";
            $queryStr.=" FROM user_mst";
            $queryStr.=" where user_id='".$user_id."' AND group_c IN (select group_id";
            $queryStr.=" from bb_forum_usergroup_permission_data";
            $queryStr.=" where group_id='".$group_c."' AND forum_id='".$forum_id."' AND permission_c='BB20014')";

            $loadData=$db->query($queryStr);

            if(count($loadData) > 0)
            {
                redirect_to(SITE_URL.'notify/notfound');
            }

            // Detect user has permission BB20014 Disallow download attach files in forum 
            $queryStr=" SELECT *";
            $queryStr.=" FROM user_mst";
            $queryStr.=" where user_id='".$user_id."' AND user_id IN (select user_id";
            $queryStr.=" from bb_forum_user_permission_data";
            $queryStr.=" where user_id='".$user_id."' AND forum_id='".$forum_id."' AND permission_c='BB20014')";

            $loadData=$db->query($queryStr);

            if(count($loadData) > 0)
            {
                redirect_to(SITE_URL.'notify/notfound');
            }
        }

        download($fileData[0]['file_path'], $fileData[0]['file_name']);
	}	
}