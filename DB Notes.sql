CREATE TABLE `abstracts` ( 
	`abstract_id` int(11) NOT NULL auto_increment, 
	`date` varchar(40) NOT NULL default '', 
	`name` varchar(100) NOT NULL default 'none', 
	`clinic` varchar(100) NOT NULL default 'none',
	`address` varchar(100) NOT NULL default 'none',
	`city` varchar(100) NOT NULL default 'none',
	`state` char(2) NOT NULL default 'none',
	`zip` varchar(10) NOT NULL default 'none',
	`email` varchar(60) NOT NULL default 'none',
	`phone` varchar(30) NOT NULL default 'none',
	`title` varchar(255) NOT NULL default 'none', 
	`length` varchar(20) NOT NULL default 'none', 
	`summary` text NOT NULL, `gap` text NOT NULL, 
	`need` text NOT NULL, `change` text NOT NULL, 
	`presentation` varchar(80) NOT NULL default 'none', 
	`disclosure` varchar(80) NOT NULL default 'none', 
	`word_count` int(3) NOT NULL default '0', 
	`master_status` varchar(40) NOT NULL default 'Unfiled', 
	`scholarship` varchar(20) NOT NULL, 
	`last_edit` varchar(50) NOT NULL, 
	PRIMARY KEY  (`abstract_id`)
	) 
ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1418 ;

CREATE TABLE `abstracts` ( 
	`abstract_id` int(11) NOT NULL auto_increment, 
	`date` varchar(40) NOT NULL default '', 
	`name` varchar(100) NOT NULL default 'none', 
	`clinic` varchar(100) NOT NULL default 'none',
	`address` varchar(100) NOT NULL default 'none',
	`city` varchar(100) NOT NULL default 'none',
	`state` char(2) NOT NULL default 'none',
	`zip` varchar(10) NOT NULL default 'none',
	`email` varchar(60) NOT NULL default 'none',
	`phone` varchar(30) NOT NULL default 'none',
	`title` varchar(255) NOT NULL default 'none', 
	`length` varchar(20) NOT NULL default 'none', 
	`summary` text NOT NULL default 'none', 
	`gap` text NOT NULL default 'none', 
	`need` text NOT NULL default 'none', 
	`change` text NOT NULL default 'none', 
	`presentation` varchar(80) NOT NULL default 'none', 
	`disclosure` varchar(80) NOT NULL default 'none', 
	`word_count` int(3) NOT NULL default '0', 
	`master_status` varchar(40) NOT NULL default 'Unfiled', 
	`scholarship` varchar(20) NOT NULL, 
	`last_edit` varchar(50) NOT NULL, 
	PRIMARY KEY  (`abstract_id`)
	) 
ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1418 ;

CREATE TABLE `disclosure` (
	`disclosure_id` int(11) NOT NULL auto_increment,
	`activity` varchar(100) NOT NULL default '',
	`activity_date` varchar(40) NOT NULL default '',
	`activity_role` varchar(90) NOT NULL default '',
--	`interest_id` int(11) ---- FORGIN KEY,
	`interest` int(1) NOT NULL default '',
	`commercial_prod` int(1) NOT NULL default '',
--	`commerical_prod_ID` int(11)  ---- FORGIN KEY,
	`signature` varchar(80) NOT NULL default '',
	`sig_date` varchar(40) NOT NULL default ''
	PRIMARY KEY (`disclosure_id`)
	)
ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `interest` (
	`interest_id` int(11) NOT NULL auto_increment,
	`disclosure_id` int(11) NOT NULL,
	`interest` varchar(100) NOT NULL default '',
	`compensation` varchar(100) NOT NULL default '',
	`role` text NOT NULL default '',
	PRIMARY KEY (`interest_id`)
	FOREIGN KEY (disclosure_id) REFERENCES disclosure (disclosure_id)
	)
ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `commercial_product` (
	`commercial_prod_id` int(11) NOT NULL auto_increment,
	`disclosure_id` int(11) NOT NULL,
	`product` varchar(120) NOT NULL default '',
	`description` text NOT NULL default '',
	PRIMARY KEY (`commerical_prod_id`)
	FOREIGN KEY (disclosure_id) REFERENCES disclosure (disclosure_id)
	)
ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;