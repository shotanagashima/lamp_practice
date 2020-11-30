<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用
function insert_order_history($db, $user_id, $total_price) {
    $sql = "
      INSERT INTO
        order_histories(
            user_id,
            total_price
        )
      VALUES(?,?);
    ";
    $parameters = [$user_id, $total_price];
    return execute_query($db, $sql, $parameters);
}
function get_order_id($db) {
  return $db->lastInsertId();
}

function insert_order_datail($db, $order_id, $item_id, $item_price, $amount) {
  $sql = "
    INSERT INTO
      order_details(
          order_id,
          item_id,
          item_price,
          amount
      )
    VALUES(?,?,?,?);
  ";
  $parameters = [$order_id, $item_id, $item_price, $amount];
  return execute_query($db, $sql, $parameters);
}

function create_history($db, $carts){
  $user_id = $carts[0]['user_id'];
  $total_price = sum_carts($carts);
  if (insert_order_history($db,$user_id,$total_price) === false){
    set_error('履歴の追加に失敗しました');
    return false;
  }

  $order_id = get_order_id($db);

  foreach ($carts as $cart) {
    if(insert_order_datail($db,$order_id,$cart['item_id'],$cart['price'],$cart['amount']) === false){
      set_error($cart['name'].'の明細追加に失敗しました');
      return false;
    }
  }
  return true;
}

function get_order_history($db, $user_id){
  $sql = "
    SELECT
      order_id,
      order_date,
      total_price
    FROM
      order_histories
    WHERE
      user_id = ?
  ";
  return fetch_all_query($db, $sql, [$user_id]);
}

function get_order_detail($db, $order_id, $user_id = null){
  $parameters = [$order_id];
  $sql = "
    SELECT
      items.name,
      items.price,
      order_details.amount
    FROM
      order_details
    JOIN
      items
    ON
      order_details.item_id = items.item_id  
    WHERE
      order_details.order_id = ?
  ";
  if ($user_id !== null){
    $sql.="and exists(select * from order_histories where order_id = ? and user_id = ?)";
    $parameters[] = $order_id;
    $parameters[] = $user_id;
  }
  return fetch_all_query($db, $sql, $parameters);
}

function subtotal_detail($order_detail){
  $subtotal_price = 0;
  $subtotal_price += $order_detail['price'] * $order_detail['amount'];
  return $subtotal_price;
}

function get_all_order_history($db){
  $sql = "
    SELECT
      order_id,
      order_date,
      total_price
    FROM
      order_histories
  ";
  return fetch_all_query($db, $sql);
}