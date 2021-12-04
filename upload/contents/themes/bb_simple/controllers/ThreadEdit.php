<?php

class ThreadEdit
{
	public static function index()
	{
	
        if(!preg_match('/\/id\-(\d+)/i',Configs::$_['uri'],$match))
		{
			// redirect to 404 page
			redirect_to(SITE_URL.'notify/notfound');
		}
		
		if(Configs::$_['user_data']['user_id']=='GUEST')
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		$thread_id=$match[1];

        $post_id='';

		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);
	
		$theData['post_data']=[];

		$theData['thread_title']='';
		$theData['poll_id']='';

        $db=new Database(); 

        $theData['post_data']=$db->query("select * from bb_threads_data where thread_id='".$thread_id."'");		
			
        if(count($theData['post_data'])==0)
        {
            redirect_to(SITE_URL.'notify/notfound');
        }

		$theData['forum_data']=$db->query("select * from bb_forum_data where forum_id='".$theData['post_data'][0]['forum_id']."'");		


        $theData['post_attach_files_data']=$db->query("select * from bb_thread_attach_files_data where data_type='thread' AND post_id='".$thread_id."'");

        $theData['post_poll_data']=$db->query("select * from bb_poll_data where thread_id='".$thread_id."'");

        $theData['post_poll_answer_data']=[];		

        if(count($theData['post_poll_data']) > 0)
        {
            $theData['poll_id']=$theData['post_poll_data'][0]['poll_id'];

            $theData['post_poll_answer_data']=$db->query("select * from bb_poll_answer_data where poll_id='".$theData['post_poll_data'][0]['poll_id']."' order by sort_order asc");		
        }

		$theData['thread_id']=$thread_id;
		$theData['forum_id']=$theData['post_data'][0]['forum_id'];

		bb_gen_breadcum_forum_data_global($theData['forum_id']);

		// if(strlen($theData['forum_id'])==0)
		// {
		// 	redirect_to(SITE_URL);
		// }

		bb_load_all_post_prefix();

		BB_Smiles::load();

		if((int)Configs::$_['bb_enable_captcha_quick_reply']==1)
		{
			$db->nonquery("delete from bb_captcha_session_data where ent_dt > NOW() - INTERVAL 1 DAY");
			$db->nonquery("delete from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

			if(Configs::$_['bb_system_captcha_method']=='text')
			{
				$theData['captcha_data']=bb_captcha_load_question_text();
			
			}
			elseif(Configs::$_['bb_system_captcha_method']=='image')
			{
				$theData['captcha_data']=BB_Captcha_Image::make(6);
	
			}
		}

		Configs::$_['site_title']='Edit Thread';	

		echo view('header');
		echo view('thread_edit',$theData);
		echo view('footer');
	}	
}