--
-- Table structure for table `wwc_wedding`
--

CREATE TABLE `couples` (
  `couple_id` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `groom_first_name` varchar(35) NOT NULL,
  `groom_last_name` varchar(50) NOT NULL,
  `groom_email` varchar(150) NOT NULL,
  `bride_first_name` varchar(35) NOT NULL,
  `bride_last_name` varchar(50) NOT NULL,
  `bride_email` varchar(150) NOT NULL,
  `primary_contact` ENUM('Groom', 'Bride'),
  `couple_address` varchar(100) NOT NULL,
  `couple_city` varchar(50) NOT NULL,
  `couple_state` varchar(2) NOT NULL,
  `couple_zip` varchar(5) NOT NULL,
  `couple_story` LONGTEXT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE `events` (
  `event_id` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `couple_id` int(6) NOT NULL,
  `master_event_id` int(6) NOT NULL DEFAULT 0,
  `name` varchar(250) NOT NULL,
  `type` ENUM('Wedding', 'Reception'),
  `start_date_time` datetime,
  `end_date_time` datetime,
  `reply_by_date` datetime,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY couples_id(`couple_id`) REFERENCES  couples(`couples_id`),
  FOREIGN KEY master_event_id(`master_event_id`) REFERENCES  events(`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE `rsvps` (
  `rsvp_id` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `event_id` int(6) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `events` ENUM('Wedding', 'Reception', 'All Events'),
  `number_in_party` int(6) NOT NULL DEFAULT 1,
  `status` ENUM('Going', 'Not Going'),
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY fk_events_id(`event_id`) REFERENCES  events(`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
