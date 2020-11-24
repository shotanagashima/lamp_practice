<?php

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