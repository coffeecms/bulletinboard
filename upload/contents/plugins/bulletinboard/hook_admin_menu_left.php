<?php

isLogined();

$subMenu = '';
$subMenuADS = '';
$subMenuFirewall = '';

if (isset(Configs::$_['user_permissions']['BB30014'])) {
	$subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=dashboard" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Dashboard</p>
  </a>
  </li>
';
}


if (isset(Configs::$_['user_permissions']['BB30030'])) {
	$subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=annoucements" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Annoucements</p>
  </a>
</li>
';
}
if (isset(Configs::$_['user_permissions']['BB30015'])) {
	$subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=forums" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Forums</p>
  </a>
  </li>
';
}
if (isset(Configs::$_['user_permissions']['BB30016'])) {
	$subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=threads" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Threads</p>
  </a>
</li>
';
}
if (isset(Configs::$_['user_permissions']['BB30031'])) {
  $subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=captchaquestion" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Captcha questions</p>
  </a>
</li>
';
}

if (isset(Configs::$_['user_permissions']['BB30028'])) {
  $subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=postprefix" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Post Prefix</p>
  </a>
  </li>
';
}



if (isset(Configs::$_['user_permissions']['BB30017'])) {
	$subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=reactions" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Reactions</p>
  </a>
</li>
';
}

if (isset(Configs::$_['user_permissions']['BB30018'])) {
  $subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=smiles" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Smiles</p>
  </a>
</li>
';
}
if (isset(Configs::$_['user_permissions']['BB30029'])) {
  $subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=ranks" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Ranks</p>
  </a>
  </li>
';
}
if (isset(Configs::$_['user_permissions']['BB30026'])) {
  $subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=users" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Users</p>
  </a>
  </li>
';
}


if (isset(Configs::$_['user_permissions']['BB30019'])) {
	$subMenuFirewall .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=banned_users" class="nav-link">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
  <p>Banned users</p>
  </a>
</li>
';
}
if (isset(Configs::$_['user_permissions']['BB30020'])) {
	$subMenuFirewall .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=banned_email" class="nav-link">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
  <p>Banned emails</p>
  </a>
</li>
';
}
if (isset(Configs::$_['user_permissions']['BB30021'])) {
	$subMenuFirewall .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=banned_ip" class="nav-link">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
  <p>Banned ip address</p>
  </a>
  </li>
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=banned_browser" class="nav-link">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
  <p>Banned browser</p>
  </a>
  </li>
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=banned_os" class="nav-link">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
  <p>Banned operating system</p>
  </a>
  </li>

';
}

if (isset(Configs::$_['user_permissions']['BB30023'])) {
	$subMenu .= '



  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=settings" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Settings</p>
  </a>
</li>
';
}


if (isset(Configs::$_['user_permissions']['BB30023'])) {
	$subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=htmlglobal" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>PHP Hook</p>
  </a>
</li>
';
}
if (isset(Configs::$_['user_permissions']['BB30023'])) {
	$subMenu .= '
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=clean" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Clean Data</p>
  </a>
  </li>  
  <li class="nav-item">
  <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=report" class="nav-link">
  <i class="nav-icon fas fa-tag"></i>
  <p>Reports</p>
  </a>
  </li>
';
}

$subMenuFirewall = '
<li class="nav-item menu-cf-bulletinboard">
  <a href="#" class="nav-link">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-shield-alt"></i>
    <p>
    Firewall <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview" style="display: none;">
    <!--<li class="nav-item">
    <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=dashboardfirewall" class="nav-link">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
    <p>Dashboard</p>
    </a>
    </li>-->

    ' . $subMenuFirewall . '
  </ul>
</li>
';

$str = '



<li class="nav-item menu-cf-bulletinboard">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-chalkboard"></i>
    <p>
    Bulletin Board <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview" style="display: none;">
    ' . $subMenu . '

  </ul>
</li>


' . $subMenuFirewall . '


<li class="nav-item menu-cf-bulletinboard">
  <a href="#" class="nav-link">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-file-alt"></i>
    <p>
    Resources <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview" style="display: none;">
    <!--<li class="nav-item">
    <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=dashboardresources" class="nav-link">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
    <p>Dashboard</p>
    </a>
    </li>-->

    <li class="nav-item">
    <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=resources" class="nav-link">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
    <p>All resources</p>
    </a>
    </li>
  </ul>
</li>

<!--<li class="nav-item menu-cf-bulletinboard">
  <a href="#" class="nav-link">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-money-check-alt"></i>
    <p>
    Payments <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview" style="display: none;">

    <li class="nav-item">
    <a href="' . SITE_URL . 'admin/plugin_page_url?plugin=bulletinboard&page=payments" class="nav-link">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tag"></i>
    <p>All Payments</p>
    </a>
    </li>
  </ul>
</li>-->

';

if (!isset(Configs::$_['admin_panel_after_menu_11011011'])) {
	Configs::$_['admin_panel_after_menu_11011011'] = [];
}

array_push(Configs::$_['admin_panel_after_menu_11011011'], $str);