<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入履歴</h1>
    <div class="container">

        <?php include VIEW_PATH . 'templates/messages.php'; ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>注文番号</th>
                    <th>購入日時</th>
                    <th>当該の注文の合計金額</th>
                    <th>購入明細</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_histories as $order_history) { ?>
                    <tr>
                        <td><?php print(h($order_history['order_id'])); ?></td>
                        <td><?php print(h($order_history['order_date'])); ?></td>
                        <td><?php print(number_format(h($order_history['total_price']))); ?>円</td>
                        <td>
                        <form method="post" action="order_detail.php">
                            <input type="submit" value="購入明細" class="btn btn-danger delete">
                            <input type="hidden" name="order_id" value="<?php print(h($order_history['order_id'])); ?>">
                            <input type="hidden" name="order_date" value="<?php print(h($order_history['order_date'])); ?>">
                            <input type="hidden" name="total_price" value="<?php print(h($order_history['total_price'])); ?>">
                        </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</body>

</html>