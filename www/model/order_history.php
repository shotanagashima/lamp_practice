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