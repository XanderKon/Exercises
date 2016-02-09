CREATE TABLE `houses` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Houses';

INSERT INTO `houses` (name) VALUES ("House1"), ("House2"), ("House3"), ("House4"), ("House5");

CREATE TABLE `floor` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `id_house` int,
  `floor_number` varchar(255),
   FOREIGN KEY (`id_house`) REFERENCES houses(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Floor';

INSERT INTO `floor` (id_house, floor_number) VALUES (1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (2, 1), (2, 2), (2, 3), (2, 4), (2, 5), (3, 1), (3, 2), (4, 1), (5, 1), (5, 2)

CREATE TABLE `stairs` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `id_house` int,
   FOREIGN KEY (`id_house`) REFERENCES houses(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stairs';

INSERT INTO `stairs` (id_house) VALUES (1), (2), (3), (4), (5)

CREATE TABLE `floor_stairs` (
  `id_stairs` int,
  `id_floor` int,
   FOREIGN KEY (`id_floor`) REFERENCES floor(`id`),
   FOREIGN KEY (`id_stairs`) REFERENCES stairs(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Floor/Stairs';

INSERT INTO `floor_stairs` (id_stairs, id_floor) VALUES (1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (2, 1), (2, 2), (2, 3), (2, 4), (2, 5), (3, 1), (3, 2), (4, 1), (5, 1), (5, 2)

-- query
SELECT DISTINCT h.`NAME` FROM houses h
INNER JOIN floor f ON h.id = f.id_house
INNER JOIN stairs s ON h.id = s.id_house
INNER JOIN floor_stairs fs ON fs.id_stairs = s.id
WHERE f.floor_number = 1 OR f.floor_number = 5
GROUP BY h.id
HAVING count(h.id) > 2
