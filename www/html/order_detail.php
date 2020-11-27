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
$order_id = get_post('order_id');
$order_date = get_post('order_date');
$total_price = get_post('total_price');

$order_details = get_order_detail($db, $order_id);

$subtotal_price = subtotal_detail($order_details);


include_once VIEW_PATH . 'order_detail_view.php';