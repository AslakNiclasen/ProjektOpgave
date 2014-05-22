SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE ads (
  id int(11) NOT NULL AUTO_INCREMENT,
  ad_name text NOT NULL,
  file_name text NOT NULL,
  max_impressions int(11) DEFAULT NULL,
  number_of_impressions int(11) DEFAULT '0',
  ad_deadline timestamp NULL DEFAULT NULL,
  site_id int(11) NOT NULL,
  zone_id int(11) NOT NULL,
  ad_active tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;
