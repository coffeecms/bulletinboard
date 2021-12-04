<?php

add_hook('before_view_admin','bulletinboardMenu');
add_hook('before_view_admin','bulletinboardCore');
add_hook('before_view_frontend','bulletinboardCore');
add_hook('after_delete_user','bulletinboardDeleteUser');
add_hook('payment_parse_process_data','bulletinboardPaymentProcess');

function bulletinboardMenu()
{

    $filePath=PLUGINS_PATH.'bulletinboard/hook_admin_menu_left.php';

    require_once($filePath);

}

function bulletinboardCore()
{

    $filePath=PLUGINS_PATH.'bulletinboard/core.php';

    require_once($filePath);

}

function bulletinboardDeleteUser($listUser=[])
{
    $filePath=PLUGINS_PATH.'bulletinboard/delete_user_data.php';

    require_once($filePath);

    prepare_delete_user_data($listUser);


}

function bulletinboardPaymentProcess($inputData=[])
{
    $filePath=PLUGINS_PATH.'bulletinboard/payment_process.php';

    require_once($filePath);

    bb_payment_process($inputData);
}

