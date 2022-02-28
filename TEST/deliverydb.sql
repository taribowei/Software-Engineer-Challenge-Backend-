CREATE TABLE `ordertbl` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `distance` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;


INSERT INTO `ordertbl` (`orderid`, `distance`, `status`) VALUES
(1, '50m', 'TAKEN'),
(2, '200m', 'UNASSIGNED' ),
(3, '300m', 'UNASSIGNED'),
(4, '500m', 'TAKEN');

