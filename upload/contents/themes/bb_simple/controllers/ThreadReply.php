<?php

class ThreadReply
{
	public static function index()
	{
		
        if(!preg_match('/\/thread\-(\d+)/i',Configs::$_['uri'],$match))
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

        if(preg_match('/\/post\-(\d+)/i',Configs::$_['uri'],$matchPost))
		{
			$post_id=$matchPost[1];
		}

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

        $theData['ref_post_id']=$post_id;

        $db=new Database(); 


        $theData['thread_data']=$db->query("select forum_id,title,allow_reply,friendly_url from bb_threads_data where thread_id='".$thread_id."'");

        if(count($theData['thread_data'])==0)
        {
            redirect_to(SITE_URL.'notify/notfound');
        }
		
		// Disallow reply
        if((int)$theData['thread_data'][0]['allow_reply']==0)
        {
            redirect_to(SITE_URL.'notify/permission');
        }

        if(isset($theData['ref_post_id'][2]))
        {
            $loadData=$db->query("select a.content,b.username,c.friendly_url as thread_friendly_url from bb_posts_data as a join user_mst as b ON a.user_id=b.user_id join bb_threads_data as c ON a.thread_id=c.thread_id where a.post_id='".$post_id."'");

            $theData['ref_post_content']=$loadData[0]['content'];
            $theData['ref_post_username']=$loadData[0]['username'];
            $theData['thread_friendly_url']=$loadData[0]['thread_friendly_url'];

        }

		$theData['forum_id']=$theData['thread_data'][0]['forum_id'];
		$theData['thread_id']=$thread_id;

		bb_gen_breadcum_forum_data_global($theData['forum_id']);

		// if(strlen($theData['forum_id'])==0)
		// {
		// 	redirect_to(SITE_URL);
		// }

		bb_load_forum_data_by_id($theData['forum_id']);
		$theData['forum_data']=Configs::$_['forum_'.$theData['forum_id']];

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

		Configs::$_['site_title']='Rely thread';	


		echo view('header');
		echo view('thread_reply',$theData);
		echo view('footer');
	}	
}