<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用
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