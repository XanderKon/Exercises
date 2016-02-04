-- Create user table
CREATE TABLE `users` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users';

-- Dump data
INSERT INTO `users` (name) VALUES ("Sasha"), ("Andrey"), ("Sergey"), ("Oleg"), ("Anton");

-- Create relationship
CREATE TABLE `relationship` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `id_user` int,
  `id_friend` int,
  FOREIGN KEY (`id_user`) REFERENCES users(`id`),
  FOREIGN KEY (`id_friend`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users realtionship';

-- Dump data
INSERT INTO `relationship` (`id_user`, `id_friend`) VALUES (1, 2), (2, 1), (1, 5), (2, 4), (4, 2), (4, 5);

-- Users who have more than 5 friends
SELECT u.name
FROM users u
INNER JOIN `relationship` r ON r.id_user = u.id
GROUP BY u.id
HAVING count(u.id) > 5;

-- Best friends :)

-- First
SELECT DISTINCT u.`NAME`, u1.`NAME` as 'Friend'
FROM users u, users u1, (
  SELECT r.id_user, r1.id_friend FROM relationship r
  INNER JOIN relationship r1 ON r.id_user > r1.id_friend AND r1.id_user < r.id_friend
  GROUP BY r.id_user
) rel WHERE u.id = rel.id_user AND u1.id = rel.id_friend;

-- Second (without JOINs)
SELECT u.`NAME`, u1.`NAME` as 'Friend'
FROM
users u, users u1, (
  SELECT DISTINCT r.id_user, r.id_friend
  FROM relationship r
  WHERE NOT EXISTS (
      SELECT * FROM relationship r1 WHERE r.id_user = r1.id_friend AND r1.id_user <> r.id_friend
  )
) rel WHERE u.id = rel.id_user AND u1.id = rel.id_friend;

-- Third
SELECT DISTINCT u.`NAME`, u1.`NAME` as 'Friend' FROM users u, users u1, (
  SELECT r.id_user, r1.id_friend
  FROM relationship r
  INNER JOIN relationship r1 ON r.id_user > r1.id_friend AND r1.id_user < r.id_friend
  GROUP BY r.id_user
) rel WHERE u.id = least(rel.id_user, rel.id_friend) AND u1.id = greatest(rel.id_user, rel.id_friend);
