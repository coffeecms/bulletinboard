<?php

class PostEdit
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
			'ref_post_content'=>'',
			'ref_post_username'=>'',
			'thread_friendly_url'=>'',
		);

		$theData['post_id']='';

        if(preg_match('/\/id\-(\d+)/i',Configs::$_['uri'],$matchPost))
		{
			$post_id=$matchPost[1];

			$theData['post_id']=$post_id;
		}    

		$theData['data_type']='thread';

		$theData['post_data']=[];

		$theData['thread_title']='';

        $db=new Database(); 

		$theData['data_type']='post';
		$theData['post_data']=$db->query("select a.post_id,a.forum_id,a.thread_id,a.content,b.username,c.title as thread_title,c.friendly_url as thread_friendly_url from bb_posts_data as a join user_mst as b ON a.user_id=b.user_id join bb_threads_data as c ON a.thread_id=c.thread_id where a.post_id='".$post_id."'");

		
        if(count($theData['post_data'])==0)
        {
            redirect_to(SITE_URL.'notify/notfound');
        }

		$theData['thread_title']=$theData['post_data'][0]['thread_title'];

		$theData['thread_id']=$thread_id;
		$theData['forum_id']=$theData['post_data'][0]['forum_id'];

		$theData['post_data'][0]['attach_files']=BB_Threads::load_attach_files($post_id);

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

		Configs::$_['site_title']='Edit Post';	

		echo view('header');
		echo view('post_edit',$theData);
		echo view('footer');
	}	
}