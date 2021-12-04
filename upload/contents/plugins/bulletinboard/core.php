<?php

require_once(PLUGINS_PATH.'bulletinboard/configs.php');

// Function global
// Frontend & Backend

// 1.Load all data from caches
// 2. Check permission of user:
// Priority: User permission -> forum user permission -> forum group user permission -> Group user permission

// Begin load forum

bb_prepare_visitor_data();
function bb_prepare_visitor_data() {
	// isLogined();
	if (!isLogined()) {
		Configs::$_['user_data'] = [];
		Configs::$_['user_data']['user_id'] = 'GUEST';
		Configs::$_['user_data']['username'] = 'GUEST';
		Configs::$_['user_data']['fullname'] = 'GUEST';
		Configs::$_['user_data']['group_c'] = Configs::$_['default_guest_groupid'];
		Configs::$_['user_data']['level_c'] = '0';
		Configs::$_['user_data']['group_title'] = 'GUEST';
		Configs::$_['user_data']['level_title'] = 'GUEST';
	}
	else
	{
		bb_load_user_data();
	}


	if (preg_match('/^admin/i', Configs::$_['uri'])) {

		return false;
	}

	// Step 1: Detect visitor info
	// Step 2: Firewall working or not
	// Step 3: Insert visitor session info to db
	// Step 4: Load visitor permissions: home page, forums, threads,posts

	if (!isLogined()) {

		$session_id = Configs::$_['visitor_data']['session_id'];

		bb_firewall_detect_session();

		useClass('UserAgent');
		useClass('Mobile_Detect');

		$useragent = UserAgentFactory::analyze($_SERVER['HTTP_USER_AGENT']);

		$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$referrer = is_null($referrer) ? '' : $referrer;
		$referrer = isset($referrer[5]) ? $referrer : 'direct';

		$referrer_site = '';

		if (preg_match('/^http/i', $referrer)) {
			$url_data = parse_url($referrer);

			$referrer_site = $url_data['host'];
		}

		$ip_add = $_SERVER['REMOTE_ADDR'];
		$ent_dt = date('Y-m-d H:i:s');
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		$user_agent = is_null($user_agent) ? '' : $user_agent;

		$session_hash = md5($ip_add . $user_agent . $ent_dt);

		$is_mobile = '0';
		$is_tablet = '0';
		$is_windows = '0';
		$is_ios = '0';
		$is_android = '0';
		$detect = new Mobile_Detect;

		if ($detect->isMobile()) {
			$is_mobile = '1';
		}

		if ($detect->isTablet()) {
			$is_tablet = '1';
		}

		if ($detect->isiOS()) {
			$is_ios = '1';
		}

		if ($detect->isAndroidOS()) {
			$is_android = '1';
		}

		if ($detect->isWindowsMobileOS()) {
			$is_windows = '1';
		}

		if ($detect->isWindowsPhoneOS()) {
			$is_windows = '1';
		}

		$os_title = $useragent->platform['name'];
		$os_version = $useragent->platform['version'];
		$browser_title = $useragent->browser['name'];
		$browser_version = $useragent->browser['version'];
		// $browser_version=$useragent->browser['name'];

		if (strtoupper($os_title) == 'WINDOWS') {
			$is_windows = '1';
		}

		$referrer_type = 'website';

		$page_url = current_url();

		$insertData = array(
			'session_id' => $session_id,
			'ip_address' => Configs::$_['visitor_data']['ip'],
			'user_agent' => Configs::$_['visitor_data']['user_agent'],
			'username' => 'guest',
			'page_url' => $page_url,
			'referrer_url' => $referrer,
			'referrer_site' => $referrer_site,
			'referrer_type' => $referrer_type,
			'os_title' => $os_title,
			'os_version' => $os_version,
			'browser_title' => $browser_title,
			'browser_version' => $browser_version,
			'is_mobile' => $is_mobile,
			'is_tablet' => $is_tablet,
			'is_ios' => $is_ios,
			'is_android' => $is_android,
			'is_windows' => $is_windows,
		);

		$queryStr = arrayToInsertStr('bb_visitor_views_data', $insertData);

		$db = new Database();
		$db->nonquery($queryStr);
	} else {


		bb_firewall_detect_session();

		BB_Notifies::load(Configs::$_['user_data']['user_id']);

		$session_id = Configs::$_['visitor_data']['session_id'];

		useClass('UserAgent');
		useClass('Mobile_Detect');

		$useragent = UserAgentFactory::analyze($_SERVER['HTTP_USER_AGENT']);

		$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$referrer = is_null($referrer) ? '' : $referrer;
		$referrer = isset($referrer[5]) ? $referrer : 'direct';

		$referrer_site = '';

		if (preg_match('/^http/i', $referrer)) {
			$url_data = parse_url($referrer);

			$referrer_site = $url_data['host'];
		}

		$ip_add = $_SERVER['REMOTE_ADDR'];
		$ent_dt = date('Y-m-d H:i:s');
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		$user_agent = is_null($user_agent) ? '' : $user_agent;

		$session_hash = md5($ip_add . $user_agent . $ent_dt);

		$is_mobile = '0';
		$is_tablet = '0';
		$is_windows = '0';
		$is_ios = '0';
		$is_android = '0';
		$detect = new Mobile_Detect;

		if ($detect->isMobile()) {
			$is_mobile = '1';
		}

		if ($detect->isTablet()) {
			$is_tablet = '1';
		}

		if ($detect->isiOS()) {
			$is_ios = '1';
		}

		if ($detect->isAndroidOS()) {
			$is_android = '1';
		}

		if ($detect->isWindowsMobileOS()) {
			$is_windows = '1';
		}

		if ($detect->isWindowsPhoneOS()) {
			$is_windows = '1';
		}

		$os_title = $useragent->platform['name'];
		$os_version = $useragent->platform['version'];
		$browser_title = $useragent->browser['name'];
		$browser_version = $useragent->browser['version'];
		// $browser_version=$useragent->browser['name'];

		if (strtoupper($os_title) == 'WINDOWS') {
			$is_windows = '1';
		}

		$referrer_type = 'website';

		$page_url = current_url();

		$insertData = array(
			'session_id' => $session_id,
			'ip_address' => Configs::$_['visitor_data']['ip'],
			'user_agent' => Configs::$_['visitor_data']['user_agent'],
			'username' => Configs::$_['user_data']['user_id'],
			'page_url' => $page_url,
			'referrer_url' => $referrer,
			'referrer_site' => $referrer_site,
			'referrer_type' => $referrer_type,
			'os_title' => $os_title,
			'os_version' => $os_version,
			'browser_title' => $browser_title,
			'browser_version' => $browser_version,
			'is_mobile' => $is_mobile,
			'is_tablet' => $is_tablet,
			'is_ios' => $is_ios,
			'is_android' => $is_android,
			'is_windows' => $is_windows,
		);

		$queryStr = arrayToInsertStr('bb_visitor_views_data', $insertData);

		$db = new Database();
		$db->nonquery($queryStr);
		$db->nonquery("update bb_user_data set last_user_online=NOW() where user_id='" . Configs::$_['user_data']['user_id'] . "'");
	}

	// Define uri -> page name
	// if(preg_match('/^f\-/i',Configs::$_['uri']))
	// {
	//     Configs::$_['visitor_data']['page_view_nm']='forum';
	// }
	// elseif(preg_match('/^t\-/i',Configs::$_['uri']))
	// {
	//     Configs::$_['visitor_data']['page_view_nm']='thread';
	// }
	// elseif(preg_match('/^post\-/i',Configs::$_['uri']))
	// {
	//     Configs::$_['visitor_data']['page_view_nm']='thread';
	// }
	// elseif(preg_match('/^profile\-/i',Configs::$_['uri']))
	// {
	//     Configs::$_['visitor_data']['page_view_nm']='thread';
	// }

}

// Gen links
function profile_url($username) {
	$result = SITE_URL . 'profile-' . $username . '.html';

	return $result;
}
function thread_url($friendly_url) {
	$result = SITE_URL . 't-' . $friendly_url;

	return $result;
}
function forum_url($friendly_url) {
	$result = SITE_URL . 'f-' . $friendly_url . '.html';

	return $result;
}
function post_url($thread_friendly_url, $post_id) {
	$result = SITE_URL . 't-' . $thread_friendly_url . '/post-' . $post_id;

	return $result;
}
function message_url($message_id) {
	$result = SITE_URL . 'message/read-' . $message_id;

	return $result;
}
function thread_page_url($thread_friendly_url, $page_no) {
	$result = SITE_URL . 't-' . $thread_friendly_url . '/page-' . $page_no;

	return $result;
}
function attach_file_download_url($file_id) {
	$result = SITE_URL . 'attach_file/file-' . $file_id;

	return $result;
}
function login_url() {
	$result = SITE_URL . 'login';

	return $result;
}
function logout_url() {
	$result = SITE_URL . 'logout';

	return $result;
}
function register_url() {
	$result = SITE_URL . 'register';

	return $result;
}
function newthread_url($forum_id) {
	$result = SITE_URL . 'newthread?forum_id=' . $forum_id;

	return $result;
}
function thread_reply_url($thread_id) {
	$result = SITE_URL . 'threadreply/thread-' . $thread_id;

	return $result;
}
function thread_edit_url($thread_id) {
	$result = SITE_URL . 'threadedit/id-' . $thread_id;

	return $result;
}
function post_edit_url($post_id) {
	$result = SITE_URL . 'postedit/id-' . $post_id;

	return $result;
}

function post_reply_url($thread_id, $post_id) {
	$result = SITE_URL . 'threadreply/thread-' . $thread_id . '/post-' . $post_id;

	return $result;
}

// End Gen links

function isOnline($last_user_online = '') {
	if ($last_user_online == null) {
		$last_user_online = '';
	}

	$to_time = time();
	$from_time = strtotime($last_user_online);

	$mins = $to_time - $from_time;

	if ((int) $mins <= 60) {
		return true;
	}

	$mins = round(abs($mins) / 60);

	if ($mins <= 3) {
		return true;
	}

	return false;
}

function prepare_visitor_online_data($limit = 0) {
	$db = new Database();

	$queryStr = '';

	$url = current_url();

	$queryStr = " SELECT distinct a.username as user_id,b.username";
	$queryStr .= " FROM bb_visitor_views_data as a";
	$queryStr .= " join user_mst as b ON a.username=b.user_id";

	if ($url != SITE_URL) {
		$queryStr .= " WHERE page_url='" . $url . "' AND a.ent_dt >= NOW() - INTERVAL 5 MINUTE";
	} else {
		$queryStr .= " WHERE a.ent_dt >= NOW() - INTERVAL 5 MINUTE";
	}

	if ((int) $limit > 0) {
		$queryStr .= " LIMIT 0," . $limit;
	}

	$loadData = $db->query($queryStr);

	$total = count($loadData);

	Configs::$_['visitor_data']['users_online'] = [];

	Configs::$_['visitor_data']['users_online'] = $loadData;
	Configs::$_['visitor_data']['total_users_online'] = $total;

	$queryStr = " SELECT distinct session_id,user_agent";
	$queryStr .= " FROM bb_visitor_views_data";

	if ($url != SITE_URL) {
		$queryStr .= " WHERE page_url='" . $url . "' AND username='guest' AND ent_dt >= NOW() - INTERVAL 5 MINUTE";

	} else {
		$queryStr .= " WHERE  username='guest' AND ent_dt >= NOW() - INTERVAL 5 MINUTE";

	}

	$loadData = $db->query($queryStr);

	$total = (int) $total + count($loadData);

	Configs::$_['visitor_data']['guest_online'] = [];

	Configs::$_['visitor_data']['guest_online'] = $loadData;
	Configs::$_['visitor_data']['total_guest_online'] = count($loadData);

	Configs::$_['visitor_data']['total_online'] = $total;

}
// End

function bb_load_all_post_prefix() {
	$savePath = BB_CACHES_PATH . 'post_prefix.php';

	$db = new Database();

	if (!file_exists($savePath)) {

		$loadData = $db->query("select * from bb_post_prefix_data where status='1' order by title asc");

		if (!is_array($loadData) || count($loadData) == 0) {
			return false;
		}

		create_file($savePath, "<?php Configs::\$_['list_post_prefix']='" . json_encode($loadData) . "';");
	}

	require_once $savePath;

	Configs::$_['list_post_prefix'] = json_decode(Configs::$_['list_post_prefix'], true);

}

// Captcha

function bb_captcha_compare_answer_text() {
	//  IP + User agent

}

function bb_captcha_load_question_text() {
	$savePath = BB_CACHES_PATH . 'captcha_text.php';

	$result = '';

	$db = new Database();

	if (!file_exists($savePath)) {

		$loadData = $db->query("select * from bb_capcha_questions_data where status='1'");

		if (!is_array($loadData) || count($loadData) == 0) {
			return false;
		}

		create_file($savePath, "<?php Configs::\$_['list_captcha_text']='" . json_encode($loadData) . "';");
	}

	require_once $savePath;

	Configs::$_['list_captcha_text'] = json_decode(Configs::$_['list_captcha_text'], true);

	shuffle(Configs::$_['list_captcha_text']);

	$result = Configs::$_['list_captcha_text'][0];

	// Create session id when visit register page
	//  IP + User agent

	$insertData = array(
		'session_id' => Configs::$_['visitor_data']['session_id'],
		'captcha_id' => $result['question_id'],
		'answer' => $result['answer'],
	);

	$queryStr = arrayToInsertStr('bb_captcha_session_data', $insertData);

	$db->nonquery($queryStr);

	return $result;

}

// End captcha


// HTML Code
function bb_load_php_code_zone($zoneName = '') {
	if (!isset($zoneName[2])) {
		return '';
	}

	$result = '';

	$zoneName = strtolower($zoneName);

	$savePath = BB_PHPCODE_PATH . $zoneName . '.php';

	if (!file_exists($savePath)) {
		$db = new Database();

		$loadData = $db->query("select * from bb_html_global_data where html_c='" . $zoneName . "'");

		if (!is_array($loadData) || count($loadData) == 0) {
			return '';
		}

		create_file($savePath, "<?php Configs::\$_['html_code']=[];Configs::\$_['html_code']['" . $zoneName . "']='" . addslashesd($loadData[0]['content']) . "';");
	}

	require_once $savePath;

	$result = Configs::$_['html_code'][$zoneName];

	return $result;

}

// End HTML Code

// Forum -----------------------------

function bb_forum_has_permission($forum_id, $permission_c = '') {
	$result = false;

	if (!isset(Configs::$_['bb_forum_user_permission'])) {
		bb_load_user_data();
	}

	// print_r(Configs::$_['bb_forum_user_permission']);die();

	// forum user permission
	if (isset(Configs::$_['bb_forum_user_permission'][$forum_id])) {
		if (isset(Configs::$_['bb_forum_user_permission'][$forum_id][$permission_c])) {
			return true;
		}
	}
	// forum user group permission
	if (isset(Configs::$_['bb_forum_usergroup_permission'][$forum_id])) {
		if (isset(Configs::$_['bb_forum_usergroup_permission'][$forum_id][$permission_c])) {
			return true;
		}
	}
	// user group permission
	if (isset(Configs::$_['user_permissions'][$permission_c])) {
		return true;
	}

	return $result;
}

function bb_load_all_forum_data() {
	$savePath = BB_CACHES_PATH . 'forums.php';

	if (!file_exists($savePath)) {
		// BB_Forum::updateAllStats();

		$db = new Database();

		$listForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");

		$listSubForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");

		$listForumUserGroupPers = $db->query("select * from bb_forum_usergroup_permission_data");
		$listForumUserPers = $db->query("select * from bb_forum_user_permission_data");

		// $listForums=bb_genNestedForumData($listForums,$listSubForums);

		$result = array();

		$total = count($listForums);
		$totalSub = count($listSubForums);
		$totalUserGroupPers = count($listForumUserGroupPers);
		$totalUserPers = count($listForumUserPers);

		for ($i = 0; $i < $total; $i++) {

			if (!isset($listForums[$i]['sub_forums'])) {
				$listForums[$i]['sub_forums'] = [];
			}

			if (!isset($listForums[$i]['user_permissions'])) {
				$listForums[$i]['user_permissions'] = [];
			}

			if (!isset($listForums[$i]['usergroup_permissions'])) {
				$listForums[$i]['usergroup_permissions'] = [];
			}

			for ($j = 0; $j < $totalSub; $j++) {
				if ($listForums[$i]['forum_id'] == $listSubForums[$j]['parent_id']) {

					$listForums[$i]['sub_forums'][] = $listSubForums[$j];

					// array_push($result,$listSubCategories[$j]);
				}
			}

			for ($k = 0; $k < $totalUserGroupPers; $k++) {
				if ($listForums[$i]['forum_id'] == $listForumUserGroupPers[$k]['forum_id']) {
					if (!isset($listForums[$i]['usergroup_permissions'][$listForumUserGroupPers[$k]['group_id']])) {
						$listForums[$i]['usergroup_permissions'][$listForumUserGroupPers[$k]['group_id']] = [];
					}

					$listForums[$i]['usergroup_permissions'][$listForumUserGroupPers[$k]['group_id']][] = $listForumUserGroupPers[$k]['permission_c'];
				}
			}

			for ($k = 0; $k < $totalUserPers; $k++) {
				if ($listForums[$i]['forum_id'] == $listForumUserPers[$k]['forum_id']) {
					$listForums[$i]['user_permissions'][$listForumUserPers[$k]['user_id']] = $listForumUserPers[$k]['permission_c'];
				}
			}

			// $result[]=$listForums[$i];
		}

		create_file($savePath, "<?php Configs::\$_['list_forums']='" . json_encode($listForums) . "';");
	}

	require_once $savePath;

	Configs::$_['list_forums'] = json_decode(Configs::$_['list_forums'], true);

}

function bb_load_forum_data_by_id($id) {

	$savePath = BB_CACHES_PATH . 'forum_id_' . $id . '.php';

	$forum_id = $id;
	$friendly_url = '';

	if (!file_exists($savePath)) {
		$db = new Database();

		$content = '';

		$listForums = $db->query("select * from bb_forum_data where forum_id='" . $id . "'");

		if (!is_array($listForums) || count($listForums) == 0) {
			$forum_id = false;
			$friendly_url = false;

			return false;
		}

		$forum_id = $listForums[0]['forum_id'];
		$friendly_url = $listForums[0]['friendly_url'];

		create_file($savePath, "<?php Configs::\$_['forum_friendly_url']='" . $listForums[0]['friendly_url'] . "';");

	}

	require_once $savePath;

	$friendly_url = Configs::$_['forum_friendly_url'];

	$forum_id = bb_load_forum_data_by_friendly_url($friendly_url);

	return $forum_id;
}
function bb_load_forum_data_by_friendly_url($friendly_url) {
	// Forum data
	// Forum user permission
	// Forum group user permission
	// Forum annoucements
	// Forum pinned threads
	// Forum ads threads

	// $hash=md5($friendly_url);

	// $savePath=BB_CACHES_PATH.'forum_'.$hash.'.php';

	$forum_id = '';

	$db = new Database();

	$content = '';

	$listForums = $db->query("select * from bb_forum_data where friendly_url='" . $friendly_url . "'");

	if (!is_array($listForums) || count($listForums) == 0) {
		$forum_id = false;

		return false;
	}

	$forum_id = $listForums[0]['forum_id'];

	$listSubForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')='" . $forum_id . "' order by sort_order asc");

	$listForumUserGroupPers = $db->query("select * from bb_forum_usergroup_permission_data where forum_id='" . $forum_id . "'");
	$listForumUserPers = $db->query("select * from bb_forum_user_permission_data where forum_id='" . $forum_id . "'");

	$content = $listForums[0];

	$totalSub = count($listSubForums);

	$content['sub_forums'] = [];

	for ($j = 0; $j < $totalSub; $j++) {
		$content['sub_forums'][] = $listSubForums[$j];
	}

	$content['usergroup_permissions'] = [];

	$total = count($listForumUserGroupPers);

	for ($i = 0; $i < $total; $i++) {
		if (!isset($content['usergroup_permissions'][$listForumUserGroupPers[$i]['group_id']])) {
			$content['usergroup_permissions'][$listForumUserGroupPers[$i]['group_id']] = [];
		}

		$content['usergroup_permissions'][$listForumUserGroupPers[$i]['group_id']][$listForumUserGroupPers[$i]['permission_c']] = '';
	}

	$content['user_permissions'] = [];

	$total = count($listForumUserPers);

	for ($i = 0; $i < $total; $i++) {
		if (!isset($content['user_permissions'][$listForumUserPers[$i]['user_id']])) {
			$content['user_permissions'][$listForumUserPers[$i]['user_id']] = [];
		}

		$content['user_permissions'][$listForumUserPers[$i]['user_id']][$listForumUserPers[$i]['permission_c']] = '';
	}

	Configs::$_['forum_' . $forum_id] = $content;

	// $forum_id=Configs::$_['forum_id'];

	return $forum_id;
}

function bb_load_thread_of_forum($forum_id, $limit, $page) {

}

// End forum-------------------

// Message
function bb_load_message_of_user($user_id, $limit = 30, $page_no = 0) {
	//Kiểm tra Cookie, nếu ko đăng nhập thì trả về false

	if ((int) $page_no > 0) {
		$page_no = (int) $page_no - 1;
	}
	if ((int) $page_no <= 0) {
		$page_no = 0;
	}

	$offset = (int) $page_no * 30;

	$queryStr = '';

	$queryStr .= " select message_id,subject,ent_dt from bb_message_data ";
	$queryStr .= " where user_id='" . $user_id . "'  ";

	$queryStr .= " order by ent_dt limit " . $offset . "," . $limit;

	$db = new Database();
	$result = $db->query($queryStr);

	echo responseData($result, 'no');die();
}

function bb_load_message_data($message_id) {
	$savePath = BB_CONTENTS_PATH . 'messages/' . $message_id . '.php';

}

// End Message

// User
function bb_load_user_data() {

	// User data
	// User permission data
	// Forum require read thread after login data
	$db = new Database();

	// print_r(Configs::$_['user_data']);die();

	if (!isset(Configs::$_['user_data']['user_id'])) {
		Configs::$_['user_data'] = [];
		Configs::$_['user_data']['user_id'] = 'GUEST';
		Configs::$_['user_data']['username'] = 'GUEST';
		Configs::$_['user_data']['fullname'] = 'GUEST';
		Configs::$_['user_data']['group_c'] = Configs::$_['default_guest_groupid'];
		Configs::$_['user_data']['level_c'] = '0';
		Configs::$_['user_data']['group_title'] = 'GUEST';
		Configs::$_['user_data']['level_title'] = 'GUEST';
	}

	$db->setCache(15);

	// print_r(Configs::$_['cf_u']);die();

	Configs::$_['bb_user_data'] = [];
	// Configs::$_['bb_user_data']['user_id']=isset(Configs::$_['cf_u'])?Configs::$_['cf_u']:'GUEST';

	if (Configs::$_['user_data']['user_id'] != 'GUEST' && isset(Configs::$_['bb_allow_guest_view_forum'])) {
		$loadData = $db->query("select * from bb_user_data where user_id='" . Configs::$_['user_data']['user_id'] . "'");

		Configs::$_['bb_user_data'] = $loadData[0];
		Configs::$_['bb_user_data']['total_notifies'] = 0;
		Configs::$_['bb_user_data']['list_notifies'] = [];
	}

	if(isset(Configs::$_['bb_allow_guest_view_forum']))
	{
		$loadData = $db->query("select * from bb_forum_usergroup_permission_data where group_id='" . Configs::$_['user_data']['group_c'] . "'");

		$total = count($loadData);
	
		// print_r($loadData);die();
	
		Configs::$_['bb_forum_usergroup_permission'] = [];
		Configs::$_['bb_forum_user_permission'] = [];
	
		if ($total > 0) {
			for ($i = 0; $i < $total; $i++) {
				if (!isset(Configs::$_['bb_forum_usergroup_permission'][$loadData[$i]['forum_id']])) {
					Configs::$_['bb_forum_usergroup_permission'][$loadData[$i]['forum_id']] = [];
				}
	
				Configs::$_['bb_forum_usergroup_permission'][$loadData[$i]['forum_id']][$loadData[$i]['permission_c']] = '';
			}
		}
	
		// print_r(Configs::$_['bb_forum_usergroup_permission']);die();
	
		$loadData = $db->query("select * from bb_forum_user_permission_data where user_id='" . Configs::$_['user_data']['user_id'] . "'");
	
		$total = count($loadData);
	
		if ($total > 0) {
			for ($i = 0; $i < $total; $i++) {
				if (!isset(Configs::$_['bb_forum_user_permission'][$loadData[$i]['forum_id']])) {
					Configs::$_['bb_forum_user_permission'][$loadData[$i]['forum_id']] = [];
				}
	
				Configs::$_['bb_forum_user_permission'][$loadData[$i]['forum_id']][$loadData[$i]['permission_c']] = '';
			}
		}
	}


	$db->unsetCache();

	// print_r(Configs::$_['user_data']);die();

}

// End user

// Thread----------------------------

function bb_load_thread_data_by_id($friendly_url) {
	// Thread data
	// Reactions data of thread

	$savePath = BB_CACHES_PATH . 'thread_' . $id . '.php';

	$hash = md5($friendly_url);

	if (!file_exists($savePath)) {
		$db = new Database();

		$listForums = $db->query("select * from bb_threads_data where friendly_url='" . $friendly_url . "'");

		create_file($savePath, "<?php Configs::\$_['thread_" . $hash . "']='" . json_encode($listForums[0]) . "';");
	}

	require_once $savePath;

	Configs::$_['thread_' . $hash] = json_decode(Configs::$_['thread_' . $hash], true);
}

function bb_load_post_of_thread($thread_id, $limit, $page) {

}

// End thread-----------------------

function bb_bb_genNestedForumData($listCategories = array(), $listSubCategories = array()) {

	$result = array();

	$total = count($listCategories);
	$totalSub = count($listSubCategories);

	for ($i = 0; $i < $total; $i++) {
		for ($j = 0; $j < $totalSub; $j++) {
			if ($listCategories[$i]['forum_id'] == $listSubCategories[$j]['parent_id']) {
				if (!isset($listCategories[$i]['sub_forum'])) {
					$listCategories[$i]['sub_forum'] = [];
				}

				$listCategories[$i]['sub_forum'][] = $listSubCategories[$j];

				// array_push($result,$listSubCategories[$j]);
			}
		}

		$result[] = $listCategories[$i];
	}

	return $result;
}

// Firewall---------------------------------------
function bb_firewall_detect_session() {
	// If go to notify page -> disable firewall
	if (preg_match('/^notify/i', Configs::$_['uri'])) {
		return '';
	}

	if ((int) Configs::$_['bb_banned_ip_status'] == 1) {
		$hash = md5(Configs::$_['visitor_data']['ip']);

		if (is_dir(BB_FIREWALL_PATH . 'ip/' . $hash)) {
			redirect_to(SITE_URL . 'notify/block_ip');
		}
		// redirect_to(SITE_URL.'notify/block_browser');

	}

	if ((int) Configs::$_['bb_banned_browsers_status'] == 1) {
		useClass('UserAgent');

		$useragent = UserAgentFactory::analyze($_SERVER['HTTP_USER_AGENT']);

		$os_title = isset($useragent->platform['name'])?$useragent->platform['name']:'';
		$os_version = isset($useragent->platform['version'])?$useragent->platform['version']:'';
		$browser_title = isset($useragent->browser['name'])?$useragent->browser['name']:'';
		$browser_version = isset($useragent->browser['version'])?$useragent->browser['version']:'';

		if (is_dir(BB_FIREWALL_PATH . 'browser/' . strtoupper($browser_title))) {
			redirect_to(SITE_URL . 'notify/block_browser');
		}

		// redirect_to(SITE_URL.'notify/block_browser');

	}
	if ((int) Configs::$_['bb_banned_os_status'] == 1) {
		useClass('UserAgent');

		$useragent = UserAgentFactory::analyze($_SERVER['HTTP_USER_AGENT']);

		$os_title = isset($useragent->platform['name'])?$useragent->platform['name']:'Windows';
		$os_version = isset($useragent->platform['version'])?$useragent->platform['version']:'';

		$detect = new Mobile_Detect;

		if ($detect->isMobile()) {
			if (is_dir(BB_FIREWALL_PATH . 'os/MOBILE')) {
				redirect_to(SITE_URL . 'notify/block_os');
			}
		}

		if ($detect->isTablet()) {
			if (is_dir(BB_FIREWALL_PATH . 'os/TABLET')) {
				redirect_to(SITE_URL . 'notify/block_os');
			}
		}

		if ($detect->isiOS()) {
			if (is_dir(BB_FIREWALL_PATH . 'os/IOS')) {
				redirect_to(SITE_URL . 'notify/block_os');
			}
		}

		if ($detect->isAndroidOS()) {
			if (is_dir(BB_FIREWALL_PATH . 'os/ANDROID')) {
				redirect_to(SITE_URL . 'notify/block_os');
			}
		}

		if ($detect->isWindowsMobileOS()) {
			if (is_dir(BB_FIREWALL_PATH . 'os/WINDOWSMOBILE')) {
				redirect_to(SITE_URL . 'notify/block_os');
			}
		}

		if ($detect->isWindowsPhoneOS()) {
			if (is_dir(BB_FIREWALL_PATH . 'os/WINDOWSPHONE')) {
				redirect_to(SITE_URL . 'notify/block_os');
			}
		}

		if (is_dir(BB_FIREWALL_PATH . 'os/' . strtoupper($os_title))) {
			redirect_to(SITE_URL . 'notify/block_os');
		}

		// redirect_to(SITE_URL.'notify/block_os');

	}
	if ((int) Configs::$_['bb_banned_users_status'] == 1) {
		$hash = md5(strtoupper(Configs::$_['user_data']['username']));

		if (is_dir(BB_FIREWALL_PATH . 'username/' . $hash)) {
			redirect_to(SITE_URL . 'notify/block_username');
		}

	}
}

function bb_is_banned_email($email) {
	$result = false;
	if ((int) Configs::$_['bb_banned_email_status'] == 1) {
		$email = addslashes(strtolower($email));

		$hash = md5($email);

		$savePath = PUBLIC_PATH . 'bb_contents/firewall/email/' . $hash;

		if (is_dir($savePath)) {
			$result = true;
		}
	}

	return $result;
}

function bb_is_banned_username($username) {
	$result = false;
	if ((int) Configs::$_['bb_banned_users_status'] == 1) {
		$username = addslashes(strtoupper($username));

		$savePath = PUBLIC_PATH . 'bb_contents/firewall/username/' . $username;

		if (is_dir($savePath)) {
			$result = true;
		}
	}

	return $result;
}

// End firewall

function bb_gen_breadcum_forum_data_global($forum_id) {
	$listCategories = array();

	if (!isset(Configs::$_['forum_breadcum_data'])) {
		Configs::$_['forum_breadcum_data'] = [];

		$savePath = BB_CACHES_PATH . 'breadcum_data.php';

		Configs::$_['forum_breadcum_data'] = [];

		if (!file_exists($savePath)) {
			$db = new Database();

			$listCategories = $db->query("select forum_id,title,parent_id,friendly_url from bb_forum_data ");

			create_file($savePath, "<?php Configs::\$_['list_breadcum_data']='" . json_encode($listCategories) . "';");
		}

		require_once $savePath;
	}

	$listCategories = json_decode(Configs::$_['list_breadcum_data'], true);

	// print_r($listCategories);die();

	$total = count($listCategories);

	for ($i = 0; $i < $total; $i++) {
		if ($forum_id == $listCategories[$i]['forum_id']) {
			array_push(Configs::$_['forum_breadcum_data'], $listCategories[$i]);

			bb_gen_breadcum_forum_data_global($listCategories[$i]['parent_id'], $listCategories);
		}
	}
}
