SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";

-- ------
DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
	`ul_partner_id` SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`ul_name` VARCHAR(100) NOT NULL ,
	`ul_phone` BIGINT(15) UNSIGNED NOT NULL ,
	`ul_email` VARCHAR(50) NULL ,
	`ul_doj` DATE NULL ,
	`ul_address` VARCHAR(100) NULL,
	PRIMARY KEY (`ul_partner_id`)
) ENGINE = InnoDB COMMENT 'Partners Data';
INSERT INTO `partners` (`ul_partner_id`, `ul_name`, `ul_phone`, `ul_email`, `ul_doj`, `ul_address`) VALUES
	(1, 'Indo Hightech', 9205978182, 'info@indocrm.space', '2017-10-01', 'Indo Hightech, 6th Floor, Crown Heights, Near Rithala Metro, New Delhi - 110076');


-- ------
DROP TABLE IF EXISTS `partners_centers`;
CREATE TABLE `partners_centers` (
	`ul_center_id` SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`ul_partner_id` SMALLINT UNSIGNED ZEROFILL NOT NULL DEFAULT 1,
	`ul_code` VARCHAR(20) NULL ,
	`ul_name` VARCHAR(100) NOT NULL ,
	`ul_phone1` BIGINT(15) UNSIGNED NOT NULL ,
	`ul_phone2` BIGINT(15) UNSIGNED NULL ,
	`ul_email` VARCHAR(100) NULL ,
	`ul_doj` DATE NULL ,
	`ul_expiry` DATE NOT NULL DEFAULT '2049-01-01',
	`ul_address` VARCHAR(200) NULL ,
	`ul_gstin` VARCHAR(20) NULL ,
	`ul_city` VARCHAR(100) NOT NULL ,
	`ul_city_pin` MEDIUMINT(6) NULL ,
	`ul_center_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_center_id`),
	INDEX (`ul_partner_id`),
	INDEX (`ul_city`),
	UNIQUE (`ul_code`),
	CONSTRAINT fk_partners_centers FOREIGN KEY (`ul_partner_id`) REFERENCES `partners` (`ul_partner_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Vendors Data';
INSERT INTO `partners_centers` (`ul_center_id`, `ul_partner_id`, `ul_code`, `ul_name`, `ul_phone1`, `ul_phone2`, `ul_email`, `ul_doj`, `ul_address`, `ul_city`, `ul_city_pin`, `ul_center_timestamp`) VALUES
	(1, 1, 'HeadOffice', 'Indo Hightech', 9205978182, 9205978182, 'info@indocrm.space', '2017-10-01', 'Indo Hightech, 6th Floor, Crown Heights, Near Rithala Metro, New Delhi - 110076', 'Delhi', 110076, NOW());

-- -------
DROP TRIGGER IF EXISTS update_center_code;
DELIMITER $$
	CREATE TRIGGER update_center_code
	BEFORE INSERT ON `partners_centers` FOR EACH ROW
	BEGIN
	    DECLARE next_id SMALLINT;
	    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA='mycrmkva_indocrm' AND TABLE_NAME='partners_centers');
	    IF NEW.ul_code is NULL OR NEW.ul_code = ''
	    THEN
	        SET NEW.ul_code=next_id;
	    END IF;
	END;
	$$
DELIMITER ;


-- ------
DROP TABLE IF EXISTS `users_personal`;
CREATE TABLE `users_personal` (
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
	`ul_center_id` SMALLINT UNSIGNED ZEROFILL NOT NULL,
	`ul_name` VARCHAR(100) NOT NULL ,
	`ul_father` VARCHAR(100) NOT NULL ,
	`ul_address` VARCHAR(100) NOT NULL ,
	`ul_mobile` BIGINT(11) UNSIGNED NOT NULL ,
	`ul_email` VARCHAR(100) NOT NULL,
	`ul_designation` VARCHAR (20) NULL,
	`ul_dob` VARCHAR(100) NULL ,
	`ul_aadhar` VARCHAR(20) NULL ,
	`ul_pan` VARCHAR(20) NULL ,
	`ul_jobs` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
	`ul_run_km_balance` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ul_user_id`),
	INDEX (`ul_center_id`),
	UNIQUE (`ul_email`),
	UNIQUE (`ul_mobile`),
	CONSTRAINT fk_users_center FOREIGN KEY (`ul_center_id`) REFERENCES `partners_centers` (`ul_center_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Users Personal Data';
INSERT INTO `users_personal` (`ul_user_id`, `ul_center_id`, `ul_name`, `ul_father`, `ul_address`, `ul_mobile`, `ul_email`, `ul_designation`, `ul_jobs`) VALUES
	(1, 1, 'Santosh Ojha', 'Sarvesh Ojha', 'Ater Road Bhind', 9718181389, 'santoshe61@gmail.com', 'Developer', 1),
	(2, 1, 'Mr. Admin', 'NA', 'Indo Hightech, 6th Floor, Crown Heights, Near Rithala Metro, New Delhi - 110076', 8888888888, 'admin@indocrm.space', 'Admin', 1),
	(3, 1, 'Rohit Arora', 'Mr. Lalit Arora', 'Kp - 23 pitam pura new delhi - 110035', 9990294294, 'arora.rohit.apple@gmail.com', 'MD', NULL);



-- -------
DROP TABLE IF EXISTS `users_login`;
CREATE TABLE `users_login` (
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL ,
	`ul_pass` CHAR(128) NOT NULL ,
	`ul_salt` CHAR(128) NOT NULL ,
	`ul_level` TINYINT UNSIGNED NOT NULL DEFAULT 1,
	`ul_status` TINYINT(1) NOT NULL DEFAULT 1 ,
	PRIMARY KEY (`ul_user_id`),
	INDEX (`ul_status`),
	CONSTRAINT fk_users_login FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Users Login Data';
INSERT INTO `users_login` (`ul_user_id`, `ul_pass`, `ul_salt`, `ul_level`, `ul_status`) VALUES
	(1, '00aa72022b95c5d5ededc4af35a4845ba7d7d0f9290aa8c40f0814d6e24c9f1640f2482c354886547815a7d4f6b018f77ab46d8088a5b8f3db1200ee2f27eeaf', '27fd96fc39bd266edd032bea961afaeea0654923655daa35d75faf19430798c2640f71f629edfc388fb5f5f33522c8441839566bf67f00c77839a2803bb9b1ce', 9, 1),
	(2, '00aa72022b95c5d5ededc4af35a4845ba7d7d0f9290aa8c40f0814d6e24c9f1640f2482c354886547815a7d4f6b018f77ab46d8088a5b8f3db1200ee2f27eeaf', '27fd96fc39bd266edd032bea961afaeea0654923655daa35d75faf19430798c2640f71f629edfc388fb5f5f33522c8441839566bf67f00c77839a2803bb9b1ce', 8, 1),
	(3, 'dbd9425d484b7cac34be3d95714da8516ba6861c8d32f21b187f43e18e5f886100fb28adcdedf632b33f6133c4c93bd9065fbda929d8f26598754c5bfaa1fb70', 'f0004b6e3d0af1c11909e7562ab1bfe00a5d4c8287e60319ce1e206c0d4179e0b8e5a33b1b573d997f06228172a034a86c89e293c584fac8954064ff93420310', 8, 1);

-- -------
CREATE OR REPLACE VIEW user_login_details AS SELECT
	p.ul_user_id user,
	p.ul_email email,
	p.ul_mobile mobile,
	p.ul_name name,
	p.ul_designation designation,
	p.ul_center_id center_id,
	l.ul_pass password,
	l.ul_salt salt,
	l.ul_level azz_level,
	l.ul_status status,
	c.ul_name center,
	c.ul_code center_code
	FROM users_personal p
	INNER JOIN users_login l ON l.ul_user_id = p.ul_user_id
	LEFT JOIN partners_centers c ON c.ul_center_id = p.ul_center_id;


-- -------
CREATE OR REPLACE VIEW login_detail_partner AS SELECT
	c.ul_center_id center_id,
	c.ul_name center,
	c.ul_expiry expiry,
	c.ul_code center_code,
	p.ul_partner_id partner_id,
	p.ul_name partner
	FROM partners_centers c
	LEFT JOIN partners p ON p.ul_partner_id = c.ul_partner_id;


-- --------------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL ,
	`ul_attempt_time` INT UNSIGNED NOT NULL,
	`ul_attempt_status` TINYINT(1) NOT NULL ,
	`ul_logout_time` TIMESTAMP on update CURRENT_TIMESTAMP NULL ,
	`ul_attempt_ip` INT NULL ,
	INDEX (`ul_user_id`, `ul_attempt_time`, `ul_attempt_status`),
	CONSTRAINT fk_login_attempts
	FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT = '-1 = Failed attempt // 0 = logged in // 1 = Logged Out';


-- ----------
DROP TABLE IF EXISTS `login_invalid_users`;
CREATE TABLE `login_invalid_users` (
  `ul_attempt_username` VARCHAR(50) NOT NULL,
  `ul_attempt_ip` INT NULL,
  `ul_attempt_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX(`ul_attempt_time`)
) ENGINE=InnoDB COMMENT 'Users Invalid Login Try';


-- ------  set status for only failed a
DROP TABLE IF EXISTS `events_log`;
CREATE TABLE `events_log` (
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL ,
	`ul_event` TEXT NOT NULL ,
	`ul_event_status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`ul_event_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	INDEX (`ul_user_id`),
	INDEX(`ul_event_timestamp`)
) ENGINE = InnoDB COMMENT = 'user ID \'00000\' describe unregistered user';


-- ------
DROP TABLE IF EXISTS `client_messages_texts`;
CREATE TABLE `client_messages_texts` (
	`ul_message_text_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_subject` TEXT NOT NULL ,
	`ul_text` TEXT NOT NULL ,
	PRIMARY KEY (`ul_message_text_id`)
) ENGINE = InnoDB COMMENT 'Message Texts';

-- ------
DROP TABLE IF EXISTS `client_messages`;
CREATE TABLE `client_messages` (
	`ul_message_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_sender` MEDIUMINT UNSIGNED NOT NULL,
	`ul_receiver` MEDIUMINT UNSIGNED NOT NULL,
	`ul_type` ENUM('SMS', 'Email', 'Internal Message'),
	`ul_message_text_id` MEDIUMINT UNSIGNED NOT NULL ,
	`ul_status` TINYINT(1) NOT NULL DEFAULT '-1',
	`ul_read_time` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL ,
	`ul_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_message_id`),
	INDEX(`ul_sender`),
	INDEX(`ul_receiver`)
) ENGINE = InnoDB COMMENT 'Messages';


-- -----------------------------------------------------------------------------------------------
-- ----------------------      CLIENT Tables           --------------------------------------
-- -----------------------------------------------------------------------------------------------

-- --------
DROP TABLE IF EXISTS `partners_centers_users`;
CREATE TABLE `partners_centers_users` (
	`ul_centers_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
	`ul_center_id` SMALLINT UNSIGNED ZEROFILL NOT NULL,
	`ul_name` VARCHAR(100) NOT NULL ,
	`ul_mobile` BIGINT(11) UNSIGNED NOT NULL ,
	`ul_jobs` SMALLINT UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_run_km_balance` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ul_centers_user_id`),
	INDEX (`ul_center_id`),
	UNIQUE (`ul_mobile`),
	CONSTRAINT fk_centers_users_center FOREIGN KEY (`ul_center_id`) REFERENCES `partners_centers` (`ul_center_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Centers Users Data';


-- ------
DROP TABLE IF EXISTS `client_products`;
CREATE TABLE `client_products` (
	`ul_product_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_warranty` TINYINT UNSIGNED NOT NULL COMMENT 'in months',
	`ul_code` VARCHAR(20) NOT NULL,
	`ul_category` VARCHAR(20) NOT NULL ,
	`ul_name` VARCHAR(50) NOT NULL ,
	`ul_variant` VARCHAR(50) NOT NULL ,
	`ul_description` VARCHAR(200) NULL ,
	`ul_status` TINYINT UNSIGNED NOT NULL DEFAULT 1 ,
	PRIMARY KEY (`ul_product_id`)
) ENGINE = InnoDB COMMENT 'Products Data';
INSERT INTO `client_products` (`ul_product_id`, `ul_warranty`, `ul_code`, `ul_category`, `ul_name`, `ul_variant`) VALUES
	(1, 12, 'INDBC001', 'Ceiling Fan', 'Indo Fan', 'Heavy');


-- ------
DROP TABLE IF EXISTS `complaints_users`;
CREATE TABLE `complaints_users` (
	`ul_customer_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_name` VARCHAR(50) NOT NULL ,
	`ul_company` VARCHAR(50) NULL ,
	`ul_mobile` BIGINT(15) UNSIGNED NOT NULL ,
	`ul_alternate_mobile` BIGINT(15) UNSIGNED NULL ,
	`ul_email` VARCHAR(50) NULL ,
	`ul_pin` VARCHAR(100) NULL ,
	`ul_address` VARCHAR(100) NULL ,
	`ul_landmark` VARCHAR(100) NULL ,
	`ul_km_run` DECIMAL(5,2) UNSIGNED NULL ,
	PRIMARY KEY (`ul_customer_id`),
	INDEX (`ul_mobile`),
	INDEX (`ul_alternate_mobile`),
	INDEX (`ul_email`),
	INDEX (`ul_pin`)
) ENGINE = InnoDB COMMENT 'Customers Data';

-- ------
DROP TABLE IF EXISTS `complaints_user_products`;
CREATE TABLE `complaints_user_products` (
	`ul_customer_product_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_customer_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_product_id` SMALLINT UNSIGNED NOT NULL ,
	`ul_warranty_status` ENUM('Under Warranty', 'Out Of Warranty', 'Under AMC', 'Stock Piece', 'Status Unknown') NULL ,
	`ul_purchase_date` DATE NULL ,
	`ul_purchased_from` ENUM('Dealer/Channel Partner', 'Online From Vendor', 'Online From Indo', 'Directly From Indo', 'Other') NULL ,
	PRIMARY KEY (`ul_customer_product_id`),
	INDEX (`ul_product_id`),
	INDEX (`ul_customer_id`),
	CONSTRAINT fk_user_products_product FOREIGN KEY (`ul_product_id`) REFERENCES `client_products` (`ul_product_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_user_products_customer FOREIGN KEY (`ul_customer_id`) REFERENCES `complaints_users` (`ul_customer_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Customers Product Data';

-- ------
DROP TABLE IF EXISTS `complaints_data`;
CREATE TABLE `complaints_data` (
	`ul_complaint_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_customer_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_customer_product_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_qty` TINYINT UNSIGNED NOT NULL ,
	`ul_code` VARCHAR(20) NULL ,
	`ul_center_id` SMALLINT UNSIGNED ZEROFILL NOT NULL,
	`ul_centers_user_id` MEDIUMINT UNSIGNED ZEROFILL NULL,
	`ul_details` TEXT NULL ,
	`ul_est_resolution_date` DATE NULL,
	`ul_otp` SMALLINT(4) UNSIGNED ZEROFILL NOT NULL,
	`ul_status` TINYINT(1) NOT NULL DEFAULT -1,
	`ul_user_id` SMALLINT UNSIGNED ZEROFILL NOT NULL COMMENT 'ERM User detail',
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_complaint_id`),
	UNIQUE (`ul_code`),
	INDEX (`ul_customer_product_id`),
	INDEX (`ul_customer_id`),
	INDEX (`ul_center_id`),
	INDEX (`ul_est_resolution_date`),
	INDEX (`ul_status`, `ul_timestamp`),
	CONSTRAINT fk_complaint_customer FOREIGN KEY (`ul_customer_id`) REFERENCES `complaints_users` (`ul_customer_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_complaint_customer_product FOREIGN KEY (`ul_customer_product_id`) REFERENCES `complaints_user_products` (`ul_customer_product_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_complaint_center FOREIGN KEY (`ul_center_id`) REFERENCES `partners_centers` (`ul_center_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Complaints Data';


-- -------
DROP TRIGGER IF EXISTS update_complain_code;
DELIMITER $$
CREATE TRIGGER update_complain_code
BEFORE INSERT ON `complaints_data` FOR EACH ROW
begin
    DECLARE next_id MEDIUMINT;
    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA='mycrmkva_indocrm' AND TABLE_NAME='complaints_data');
    IF NEW.ul_code is NULL OR NEW.ul_code = ''
    THEN
        SET NEW.ul_code=next_id;
    END IF;
END;
$$
DELIMITER ;


-- ------
DROP TABLE IF EXISTS `complaints_jobs`;
CREATE TABLE `complaints_jobs` (
	`ul_job_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_complaint_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_attender_name` VARCHAR(50) NULL,
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL,
	`ul_km_run` DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0,
	`ul_complaint_priority` ENUM('High', 'Medium', 'Low', '') NULL,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`ul_status_brief_customer` TEXT NULL ,
	`ul_status_brief_internal` TEXT NULL ,
	`ul_bill` VARCHAR(20) NULL,
	`ul_type` ENUM ('Onsite', 'Service Center', 'Canceled' , 'Closed by Admin', 'Other') NOT NULL,
	`ul_status` TINYINT NOT NULL,
	PRIMARY KEY (`ul_job_id`),
	INDEX (`ul_complaint_id`),
	INDEX (`ul_user_id`),
	CONSTRAINT fk_jobs_complaint FOREIGN KEY (`ul_complaint_id`) REFERENCES `complaints_data` (`ul_complaint_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_job_user FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -------
DROP TRIGGER IF EXISTS update_complaint_after_job;
DELIMITER $$
	CREATE TRIGGER update_complaint_after_job
	AFTER INSERT ON `complaints_jobs` FOR EACH ROW
	BEGIN
	    IF ( NEW.ul_type = 'Onsite' OR NEW.ul_type = 'Closed by Admin' ) AND NEW.ul_km_run > 0 THEN
    		UPDATE `users_personal` SET `ul_jobs` = `ul_jobs` + 1, `ul_run_km_balance` = `ul_run_km_balance` + NEW.ul_km_run WHERE `ul_user_id` = NEW.ul_user_id LIMIT 1;
    		UPDATE `partners_centers_users` SET `ul_jobs` = `ul_jobs` + 1, `ul_run_km_balance` = `ul_run_km_balance` + NEW.ul_km_run WHERE `ul_centers_user_id` = (SELECT ul_centers_user_id FROM complaints_data WHERE `ul_complaint_id` = NEW.ul_complaint_id LIMIT 1) LIMIT 1;
    	END IF;

    	IF NEW.ul_status = 1 OR NEW.ul_status = 2  THEN
	    	UPDATE `complaints_data` SET `ul_status` = NEW.ul_status, `ul_est_resolution_date` = CURDATE() WHERE `ul_complaint_id` = NEW.ul_complaint_id LIMIT 1;
	    END IF;
	END;
	$$
DELIMITER ;

-- ------
DROP TABLE IF EXISTS `user_transactions`;
CREATE TABLE `user_transactions` (
	`ul_transaction_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL,
	`ul_for_km` DECIMAL(5,2) NOT NULL,
	`ul_amount` DECIMAL(7,2) UNSIGNED NOT NULL,
	`ul_description` VARCHAR (100) NOT NULL,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_transaction_id`),
	INDEX (`ul_user_id`),
	CONSTRAINT fk_transaction_user FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Transaction Data';