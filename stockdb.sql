CREATE TABLE IF NOT EXISTS `Data` (
    `product_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(256) NOT NULL,
    `stock` int(11) NOT NULL,
    `created_date` datetime NOT NULL,
    PRIMARY KEY (`product_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19;

CREATE TABLE IF NOT EXISTS `Error` (
    `code` int(11) NOT NULL AUTO_INCREMENT,
    `msg` varchar(256) NOT NULL,
    PRIMARY KEY (`code`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19;