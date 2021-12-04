<?php

function prepare_delete_user_data($listUser=[])
{
    $db=new Database(); 
    
    $total=count($listUser);

    $queryStr='';

    $user_id='';

    for ($i=0; $i < $total; $i++) { 
        if(strlen($listUser) > 2)
        {
            $user_id=trim($listUser[$i]);

            $queryStr.="delete from bb_notifies_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_notifies_user_data where source_user_id='".$user_id."' OR target_user_id='".$user_id."';";
            $queryStr.="delete from bb_notifies_user_data where source_user_id='".$user_id."' OR target_user_id='".$user_id."';";
            $queryStr.="delete from bb_notifies_user_data where source_user_id='".$user_id."' OR target_user_id='".$user_id."';";
            $queryStr.="delete from bb_message_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_poll_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_poll_member_answer_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_posts_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_post_attach_files_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_report_page_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_threads_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_threads_reactions_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_thread_attach_files_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_user_bookmarks_data where user_id='".$user_id."';";
            $queryStr.="delete from bb_user_wall_comment_data where wall_user_id='".$user_id."' OR author_id='".$user_id."';";
        }
    }

    $db->nonquery($queryStr);
}