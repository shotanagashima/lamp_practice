<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'order_history.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
if(is_admin($user) === false){
    redirect_to(LOGIN_URL);
  }
$order_histories = get_all_order_history($db);

include_once VIEW_PATH . 'admin_order_history_view.php';