SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE zones (
  id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;
