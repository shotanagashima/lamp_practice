CREATE TABLE `order_histories` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `orderdate` datetime NOT NULL,
  PRIMARY KEY(order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `order_details` (
  `details_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY(details_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;