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

CREATE VIEW `wedding_list` AS select `b`.`couple_id` AS `couple_id`,`a`.`event_id` AS `event_id`,concat(`b`.`groom_first_name`,' and ',`b`.`bride_first_name`,' ',`a`.`city`,', ',`a`.`state`) AS `couple` from (`events` `a` join `couples` `b`) where ((`a`.`couple_id` = `b`.`couple_id`) and (`a`.`type` = 'Wedding'));
ALTER TABLE `rsvps` ADD UNIQUE( `event_id`, `email`);

-- Dumping data for table `couples`
--

INSERT INTO `couples` (`couple_id`, `groom_first_name`, `groom_last_name`, `groom_email`, `bride_first_name`, `bride_last_name`, `bride_email`, `primary_contact`, `couple_address`, `couple_city`, `couple_state`, `couple_zip`, `couple_story`, `create_date`, `last_update_date`) VALUES
(1, 'Al', 'Bundy', 'albundy@example.com', 'Peggy', 'Lucky', 'peggielucky@example.com', 'Groom', '12 Main st', 'Chicago', 'IL', '60007', 'You all know us. And we all know you. We are getting married lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2019-09-24 23:08:03', '2019-09-24 23:08:03'),
(2, 'Fred', 'Flinestone', 'fredflinestone@example.com', 'Wilma', 'Lucky', 'wilmalucky@example.com', 'Groom', '1 Ace ln', 'Atlanta', 'GA', '65462', 'You all know Fred and I. And we all know you. We are getting married lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2019-09-25 19:15:57', '2019-09-25 19:15:57'),
(3, 'Jamie', 'Doe', 'jamiedoe@example.com', 'Sue', 'Lucky', 'suelucky@example.com', 'Bride', '1 Ace ln', 'Atlanta', 'GA', '65462', 'You all know Jamie and I. And we all know you. We are getting married lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2019-09-26 00:56:52', '2019-09-26 00:56:52');

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `couple_id`, `master_event_id`, `name`, `type`, `start_date_time`, `end_date_time`, `reply_by_date`, `address`, `city`, `state`, `zip`, `create_date`, `last_update_date`) VALUES
(1, 1, 0, 'Church of Christ', 'Wedding', '2020-07-12 15:00:00', '2020-07-12 18:00:00', '2020-05-01 18:00:00', '12 Chapel ln', 'Dallas', 'TX', '75200', '2019-09-24 23:11:36', '2019-09-24 23:11:36'),
(2, 1, 1, 'Reception Hall', 'Reception', '2020-07-12 18:00:00', '2020-07-12 21:00:00', '2020-05-01 18:00:00', '12 Chapel ln', 'Dallas', 'TX', '75200', '2019-09-24 23:12:16', '2019-09-24 23:12:16'),
(3, 2, 0, 'Fred & Wilma Forever', 'Wedding', '2020-07-12 18:00:00', '2020-07-12 21:00:00', '2020-05-01 18:00:00', '12 Chapel ln', 'Atlanta', 'GA', '65462', '2019-09-25 19:17:56', '2019-09-25 19:17:56'),
(4, 2, 1, 'Fred & Wilma Forever', 'Reception', '2020-07-12 18:00:00', '2020-07-12 21:00:00', '2020-05-01 18:00:00', '12 Chapel ln', 'Atlanta', 'GA', '65462', '2019-09-25 19:18:42', '2019-09-25 19:18:42');
