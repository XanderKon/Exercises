-- Create Ticks table
CREATE TABLE `ticks` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `symbol` varchar(255),
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `value` decimal(13, 6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ticks';

-- Dump data
INSERT INTO `ticks` (symbol, `value`) VALUES ('EURUSD', 1.4), ('GBPUSD', 1.2), ('USDJPY', 100.22), ('EURCHF', 1.3), ('NZDUSD', 0.86);
INSERT INTO `ticks` (symbol, `date`, `value`) VALUES ('AUDUSD', '2016-02-12 07:09:33', 0.72), ('EURUSD', '2016-02-12 09:19:32', 1.39), ('NZDUSD', '2016-02-12 19:19:32', 0.85);
INSERT INTO `ticks` (symbol, `date`, `value`) VALUES ('EURUSD', '2016-02-14 09:19:32', 1.44), ('NZDUSD', '2016-02-14 19:19:32', 0.89);
INSERT INTO `ticks` (symbol, `date`, `value`) VALUES ('EURUSD', '2016-09-13 14:22:02', 1.65), ('NZDUSD', '2016-08-30 05:22:31', 0.92);

SELECT t.symbol, t.`value` FROM ticks t
INNER JOIN (
  SELECT t.symbol, max(date) as max_date FROM ticks t
  GROUP BY t.symbol
) s ON t.`date` = s.max_date AND t.symbol = s.symbol
GROUP BY t.symbol;

SELECT t.symbol, t.`value` FROM ticks t WHERE (t.symbol, t.date) in
( SELECT t.symbol, max(t.date) as max_date FROM ticks t
  GROUP BY t.symbol
  ORDER BY max(t.date) DESC
);