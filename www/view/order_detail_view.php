<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入明細</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入明細</h1>
    <?php if (count($order_details) > 0) { ?>
    <h2>注文番号：<?php print(h($order_id))?></h2>
    <h2>購入日時：<?php print(h($order_date))?></h2>
    <h2>合計金額：<?php print(number_format(h($total_price))); ?>円</h2>
    <?php } ?>
    <div class="container">

        <?php include VIEW_PATH . 'templates/messages.php'; ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>商品名</th>
                    <th>購入時の商品価格</th>
                    <th>購入数</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $order_detail) { ?>
                    <tr>
                        <td><?php print(h($order_detail['name'])); ?></td>
                        <td><?php print(number_format(h($order_detail['price']))); ?>円</td>
                        <td><?php print(h($order_detail['amount'])); ?></td>
                        <td><?php print(number_format(h(subtotal_detail($order_detail)))); ?>円</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</body>

</html>