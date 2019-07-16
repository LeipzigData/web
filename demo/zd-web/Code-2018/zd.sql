
CREATE TABLE `besuche` (
  `tid` varchar(20) DEFAULT NULL,
  `vid` varchar(5) DEFAULT NULL
);
CREATE TABLE `veranstaltungen` (
  `id` varchar(5) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `modul` varchar(50) DEFAULT NULL,
  `veranstalter` varchar(50) DEFAULT NULL,
  `ort` text DEFAULT NULL,
  `datum` varchar(10) DEFAULT NULL,
  `anmerkung` text DEFAULT NULL,
  `uri` varchar(20) DEFAULT NULL
);
CREATE TABLE `teilnehmer` (
  `id` varchar(20) DEFAULT NULL,
  `hash` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `info` text DEFAULT NULL
); 
