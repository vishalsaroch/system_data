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
	(1, 'Relaxo Home Appliances Pvt. Ltd.', 9999393803, 'info@relaxocrm.space', '2018-01-01', 'Relaxo Home Appliances Pvt. Ltd., A8, Mangolpuri Industrial Area, Mangolpuri - Delhi 110083');


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
	`ul_expiry` DATE NULL,
	`ul_address` VARCHAR(200) NULL ,
	`ul_type` ENUM ('Center', 'Party', 'Other') DEFAULT 'Center' NOT NULL,
	`ul_gstin` VARCHAR(20) NULL ,
	`ul_city` VARCHAR(100) NOT NULL ,
	`ul_city_pin` MEDIUMINT(6) NOT NULL ,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	`ul_status` TINYINT(1) NOT NULL DEFAULT 1,
	PRIMARY KEY (`ul_center_id`),
	INDEX (`ul_partner_id`),
	INDEX (`ul_city`),
	INDEX (`ul_type`),
	UNIQUE (`ul_code`),
	CONSTRAINT fk_partners_centers FOREIGN KEY (`ul_partner_id`) REFERENCES `partners` (`ul_partner_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Centers Data';
INSERT INTO `partners_centers` (`ul_center_id`, `ul_partner_id`, `ul_code`, `ul_name`, `ul_phone1`, `ul_phone2`, `ul_email`, `ul_doj`, `ul_address`, `ul_city`, `ul_city_pin`, `ul_timestamp`) VALUES
	(1, 1, 'HeadOffice', 'Relaxo Home Appliances Pvt. Ltd.', 9999393803, 9999393803, 'info@relaxocrm.space', '2018-01-01', 'Relaxo Home Appliances Pvt. Ltd., A8, Mangolpuri Industrial Area, Mangolpuri - Delhi 110083', 'Delhi', 110076, NOW());

-- -------
DROP TRIGGER IF EXISTS update_center_code;
DELIMITER $$
	CREATE TRIGGER update_center_code
	BEFORE INSERT ON `partners_centers` FOR EACH ROW
	BEGIN
	    DECLARE next_id SMALLINT;
	    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='partners_centers');
	    IF NEW.ul_code is NULL OR NEW.ul_code = ''
	    THEN
	        SET NEW.ul_code = CONCAT('A', DATE_FORMAT(CURDATE(), '%y%m%d'), LPAD(next_id,4,'0'));
	    END IF;
	END$$
DELIMITER ;
UPDATE partners_centers SET ul_code = CONCAT('A', DATE_FORMAT(ul_timestamp, '%y%m%d'), LPAD(CAST(ul_center_id as UNSIGNED),4,'0'));


-- ------
DROP TABLE IF EXISTS `users_personal`;
CREATE TABLE `users_personal` (
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
	`ul_code` VARCHAR(20) NULL ,
	`ul_center_id` SMALLINT UNSIGNED ZEROFILL NOT NULL,
	`ul_name` VARCHAR(100) NOT NULL ,
	`ul_father` VARCHAR(100) NULL ,
	`ul_address` VARCHAR(150) NULL ,
	`ul_city_pin` MEDIUMINT(6) NULL ,
	`ul_mobile` BIGINT(11) UNSIGNED NOT NULL ,
	`ul_email` VARCHAR(100) NULL,
	`ul_designation` VARCHAR (20) NULL,
	`ul_dob` DATE NULL ,
	`ul_doj` DATE NULL ,
	`ul_aadhar` VARCHAR(20) NULL ,
	`ul_pan` VARCHAR(20) NULL ,
	`ul_jobs` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
	`ul_run_km_balance` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ul_user_id`),
	INDEX (`ul_center_id`),
	UNIQUE (`ul_code`),
	UNIQUE (`ul_email`),
	UNIQUE (`ul_mobile`),
	CONSTRAINT fk_users_center FOREIGN KEY (`ul_center_id`) REFERENCES `partners_centers` (`ul_center_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Users Personal Data';
INSERT INTO `users_personal` (`ul_user_id`, `ul_center_id`, `ul_name`, `ul_father`, `ul_address`, `ul_mobile`, `ul_email`, `ul_designation`, `ul_jobs`) VALUES
	(1, 1, 'Santosh Ojha', 'Sarvesh Ojha', 'Gwalior', 9718181389, 'santoshe61@gmail.com', 'Developer', 1),
	(2, 1, 'Mr. Admin', 'NA', 'Relaxo Home Appliances Pvt. Ltd., A8, Mangolpuri Industrial Area, Mangolpuri - Delhi 110083', 9999393803, 'admin@relaxocrm.space', 'Admin', 1);

-- -------
DROP TRIGGER IF EXISTS update_user_code;
DELIMITER $$
	CREATE TRIGGER update_user_code
	BEFORE INSERT ON `users_personal` FOR EACH ROW
	BEGIN
	    DECLARE next_id SMALLINT;
	    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='users_personal');
	    IF NEW.ul_code is NULL OR NEW.ul_code = ''
	    THEN
	        SET NEW.ul_code = CONCAT('U', DATE_FORMAT(CURDATE(), '%y%m%d'), LPAD(next_id,4,'0'));
	    END IF;
	END$$
DELIMITER ;
UPDATE users_personal SET ul_code = CONCAT('U', DATE_FORMAT(ul_timestamp, '%y%m%d'), LPAD(CAST(ul_user_id as UNSIGNED),4,'0'));

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
	(2, '00aa72022b95c5d5ededc4af35a4845ba7d7d0f9290aa8c40f0814d6e24c9f1640f2482c354886547815a7d4f6b018f77ab46d8088a5b8f3db1200ee2f27eeaf', '27fd96fc39bd266edd032bea961afaeea0654923655daa35d75faf19430798c2640f71f629edfc388fb5f5f33522c8441839566bf67f00c77839a2803bb9b1ce', 8, 1);

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
	FROM users_login l
	INNER JOIN users_personal p ON p.ul_user_id = l.ul_user_id
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
    `ul_event_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL ,
	`ul_table` VARCHAR(30) NOT NULL ,
	`ul_data` TEXT NULL ,
	`ul_error` TEXT NULL ,
	`ul_event_status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`ul_event_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_event_id`),
	INDEX(`ul_event_timestamp`),
	INDEX(`ul_table`)
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
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_message_id`),
	INDEX(`ul_sender`),
	INDEX(`ul_receiver`)
) ENGINE = InnoDB COMMENT 'Messages';


-- -----------------------------------------------------------------------------------------------
-- ----------------------      CLIENT Tables           --------------------------------------
-- -----------------------------------------------------------------------------------------------


-- ------
DROP TABLE IF EXISTS `client_spares`;
CREATE TABLE `client_spares` (
	`ul_spare_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_code` VARCHAR(20) NULL,
	`ul_category` VARCHAR(20) NOT NULL,
	`ul_name` VARCHAR(50) NOT NULL ,
	`ul_model` VARCHAR(50) NOT NULL ,
	`ul_warranty` TINYINT UNSIGNED NULL COMMENT 'in months',
	`ul_brand` VARCHAR(20) NULL,
	`ul_hsn` VARCHAR(20) NULL,
	`ul_price` DECIMAL(7,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_gst` DECIMAL(4,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_stock` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
	`ul_old_stock` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
	`ul_spec` VARCHAR(50) NOT NULL ,
	`ul_description` VARCHAR(200) NULL ,
	`ul_status` TINYINT UNSIGNED NOT NULL DEFAULT 1 ,
	PRIMARY KEY (`ul_spare_id`),
	UNIQUE (`ul_code`),
	UNIQUE (`ul_category`, `ul_name`, `ul_model`)
) ENGINE = InnoDB COMMENT 'Spares Data';

-- -------
DROP TRIGGER IF EXISTS update_spare_code;
DELIMITER $$
	CREATE TRIGGER update_spare_code
	BEFORE INSERT ON `client_spares` FOR EACH ROW
	begin
	    DECLARE next_id MEDIUMINT;
	    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='client_spares');
	    IF NEW.ul_code is NULL OR NEW.ul_code = ''
	    THEN
	        SET NEW.ul_code = CONCAT('S', SUBSTRING(NEW.ul_category, 1, 1), LPAD(next_id,6,'0'));
	    END IF;
	END$$
DELIMITER ;
UPDATE client_spares SET ul_code = CONCAT('S', SUBSTRING(ul_category, 1, 1), LPAD(CAST(ul_spare_id as UNSIGNED),6,'0'));


-- ------
DROP TABLE IF EXISTS `center_inventory`;
CREATE TABLE `center_inventory` (
	`ul_center_id` SMALLINT UNSIGNED NOT NULL COMMENT 'Party',
	`ul_spare_id` SMALLINT UNSIGNED NOT NULL,
	`ul_stock` SMALLINT UNSIGNED NOT NULL,
	`ul_old_stock` SMALLINT UNSIGNED NOT NULL,
	PRIMARY KEY (`ul_center_id`, `ul_spare_id`),
	INDEX (`ul_spare_id`),
	CONSTRAINT fk_inventory_spares FOREIGN KEY (`ul_spare_id`) REFERENCES `client_spares` (`ul_spare_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_inventory_center FOREIGN KEY (`ul_center_id`) REFERENCES `partners_centers` (`ul_center_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Center Inventory';

-- ------
DROP TABLE IF EXISTS `spares_inventory_transactions`;
CREATE TABLE `spares_inventory_transactions` (
	`ul_challan_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Invoice',
	`ul_code` VARCHAR(20) NULL,
	`ul_code_type` ENUM('Invoice', 'Challan') NOT NULL,
	`ul_center_id` SMALLINT UNSIGNED NOT NULL COMMENT 'Party',
	`ul_spare_id` SMALLINT UNSIGNED NOT NULL,
	`ul_stock` SMALLINT UNSIGNED NOT NULL,
	`ul_price` DECIMAL(7,2) UNSIGNED NOT NULL ,
	`ul_gst` DECIMAL(7,2) UNSIGNED NOT NULL ,
	`ul_type` ENUM('Old In', 'Old Out', 'In', 'Out') NOT NULL,
	`ul_date` DATE NOT NULL,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_challan_id`, `ul_spare_id`),
	INDEX (`ul_code`),
	INDEX (`ul_center_id`),
	INDEX (`ul_spare_id`),
	INDEX (`ul_type`),
	CONSTRAINT fk_transaction_spares FOREIGN KEY (`ul_spare_id`) REFERENCES `client_spares` (`ul_spare_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_transaction_center FOREIGN KEY (`ul_center_id`) REFERENCES `partners_centers` (`ul_center_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Spares Inventory Transactions';


-- -------
DROP TRIGGER IF EXISTS update_spare_stock;
DELIMITER $$
	CREATE TRIGGER update_spare_stock
	AFTER INSERT ON `spares_inventory_transactions` FOR EACH ROW
	BEGIN
	    IF NEW.ul_type = 'In'
		    THEN
		        UPDATE client_spares SET ul_stock = ul_stock + NEW.ul_stock WHERE ul_spare_id = NEW.ul_spare_id LIMIT 1;
		        INSERT INTO center_inventory (ul_center_id, ul_spare_id, ul_stock, ul_old_stock) VALUES (NEW.ul_center_id, NEW.ul_spare_id, NEW.ul_stock, 0) ON DUPLICATE KEY UPDATE ul_stock = ul_stock + NEW.ul_stock;
		ELSEIF NEW.ul_type = 'Out'
		    THEN
		        UPDATE client_spares SET ul_stock = ul_stock - NEW.ul_stock WHERE ul_spare_id = NEW.ul_spare_id LIMIT 1;
		        INSERT INTO center_inventory (ul_center_id, ul_spare_id, ul_stock, ul_old_stock) VALUES (NEW.ul_center_id, NEW.ul_spare_id, NEW.ul_stock, 0) ON DUPLICATE KEY UPDATE ul_stock = ul_stock + NEW.ul_stock;
	    ELSEIF NEW.ul_type = 'Old In'
		    THEN
		        UPDATE client_spares SET ul_old_stock = ul_old_stock + NEW.ul_stock WHERE ul_spare_id = NEW.ul_spare_id LIMIT 1;
		        INSERT INTO center_inventory (ul_center_id, ul_spare_id, ul_stock, ul_old_stock) VALUES (NEW.ul_center_id, NEW.ul_spare_id, 0, NEW.ul_stock) ON DUPLICATE KEY UPDATE ul_old_stock = ul_old_stock - NEW.ul_stock;
		ELSEIF NEW.ul_type = 'Old Out'
		    THEN
		        UPDATE client_spares SET ul_old_stock = ul_old_stock - NEW.ul_stock WHERE ul_spare_id = NEW.ul_spare_id LIMIT 1;
		        INSERT INTO center_inventory (ul_center_id, ul_spare_id, ul_stock, ul_old_stock) VALUES (NEW.ul_center_id, NEW.ul_spare_id, 0, NEW.ul_stock) ON DUPLICATE KEY UPDATE ul_old_stock = ul_old_stock + NEW.ul_stock;
	    END IF;
	END$$
DELIMITER ;

-- ------
DROP TABLE IF EXISTS `client_products`;
CREATE TABLE `client_products` (
	`ul_product_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_code` VARCHAR(20) NOT NULL,
	`ul_category` VARCHAR(20) NOT NULL ,
	`ul_name` VARCHAR(50) NOT NULL ,
	`ul_model` VARCHAR(50) NOT NULL ,
	`ul_spec1` VARCHAR(20) NULL ,
	`ul_spec2` VARCHAR(20) NULL ,
	`ul_warranty` TINYINT UNSIGNED NOT NULL COMMENT 'in months',
	`ul_brand` ENUM('Relaxo', 'Oxaler', 'Airwell') NOT NULL,
	`ul_hsn` VARCHAR(20) NULL,
	`ul_service_rate_1` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_service_rate_2` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_service_rate_3` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_service_rate_4` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_price` DECIMAL(7,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_gst` DECIMAL(4,2) UNSIGNED NOT NULL DEFAULT 0 ,
	`ul_stock` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
	`ul_quantity_in_otherUnity` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Nag',
	`ul_description` VARCHAR(200) NULL ,
	`ul_status` TINYINT UNSIGNED NOT NULL DEFAULT 1 ,
	PRIMARY KEY (`ul_product_id`),
	UNIQUE (`ul_code`),
	INDEX (`ul_brand`),
	UNIQUE (`ul_brand`, `ul_category`, `ul_name`, `ul_model`, `ul_spec1`, `ul_spec2`)
) ENGINE = InnoDB COMMENT 'Products Data';

-- -------
DROP TRIGGER IF EXISTS update_product_code;
DELIMITER $$
	CREATE TRIGGER update_product_code
	BEFORE INSERT ON `client_products` FOR EACH ROW
	begin
	    DECLARE next_id MEDIUMINT;
	    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='client_products');
	    IF NEW.ul_code is NULL OR NEW.ul_code = ''
	    THEN
	        SET NEW.ul_code = CONCAT('P', SUBSTRING(NEW.ul_category, 1, 1), LPAD(next_id,6,'0'));
	    END IF;
	END$$
DELIMITER ;
UPDATE client_products SET ul_code = CONCAT('P', SUBSTRING(ul_category, 1, 1), LPAD(CAST(ul_product_id as UNSIGNED),6,'0'));

-- ------
DROP TABLE IF EXISTS `client_product_spares`;
CREATE TABLE `client_product_spares` (
    `ul_product_id` SMALLINT UNSIGNED NOT NULL,
    `ul_spare_id` SMALLINT UNSIGNED NOT NULL,
    `ul_quantity` SMALLINT UNSIGNED NULL,
   	UNIQUE (`ul_spare_id`, `ul_product_id`),
   	INDEX (`ul_product_id`),
   	CONSTRAINT fk_product_spares_spares FOREIGN KEY (`ul_product_id`) REFERENCES `client_products` (`ul_product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
   	CONSTRAINT fk_product_spares_product FOREIGN KEY (`ul_spare_id`) REFERENCES `client_spares` (`ul_spare_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Products Spare Data';


-- ------
DROP TABLE IF EXISTS `clients_customers_misscall`;
CREATE TABLE `clients_customers_misscall` (
	`ul_misscall_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
	`ul_number` BIGINT(15) UNSIGNED NOT NULL ,
	`ul_circle` VARCHAR(20) NULL,
	`ul_operator` VARCHAR(20) NULL,
	`ul_channel` VARCHAR (20) NULL,
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NULL COMMENT 'Attended By User',
	`ul_details` VARCHAR (200) NULL,
	`ul_status` TINYINT NOT NULL DEFAULT -1 ,
	`ul_call_time` TIMESTAMP on update CURRENT_TIMESTAMP NULL ,
	`ul_timestamp` VARCHAR (20) NULL,
	PRIMARY KEY (`ul_misscall_id`),
	INDEX (`ul_user_id`),
	INDEX (`ul_timestamp`),
	INDEX (`ul_number`),
	CONSTRAINT fk_users_misscall FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Misscall Data';

-- ------
DROP TABLE IF EXISTS `clients_customers`;
CREATE TABLE `clients_customers` (
	`ul_customer_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_name` VARCHAR(50) NOT NULL ,
	`ul_code` VARCHAR(20) NOT NULL,
	`ul_company` VARCHAR(50) NULL ,
	`ul_mobile` BIGINT(15) UNSIGNED NOT NULL ,
	`ul_alternate_mobile` BIGINT(15) UNSIGNED NULL ,
	`ul_email` VARCHAR(50) NULL ,
	`ul_city_pin` MEDIUMINT NULL ,
	`ul_address` VARCHAR(100) NULL ,
	`ul_landmark` VARCHAR(100) NULL ,
	`ul_km_run` DECIMAL(5,2) UNSIGNED NULL  DEFAULT 0,
	PRIMARY KEY (`ul_customer_id`),
	UNIQUE (`ul_code`),
	INDEX (`ul_mobile`),
	INDEX (`ul_alternate_mobile`),
	INDEX (`ul_email`)
) ENGINE = InnoDB COMMENT 'Customers Data';

-- -------
DROP TRIGGER IF EXISTS clients_customers;
DELIMITER $$
	CREATE TRIGGER clients_customers
	BEFORE INSERT ON `clients_customers` FOR EACH ROW
	begin
	    DECLARE next_id MEDIUMINT;
	    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='clients_customers');
	    IF NEW.ul_code is NULL OR NEW.ul_code = ''
	    THEN
	        SET NEW.ul_code = CONCAT('C', DATE_FORMAT(CURDATE(), '%y%m%d'), next_id);
	    END IF;
	END$$
DELIMITER ;
UPDATE clients_customers SET ul_code = CONCAT('C', DATE_FORMAT(curdate(), '%y%m%d'), ul_customer_id);


-- ------
DROP TABLE IF EXISTS `clients_customers_products`;
CREATE TABLE `clients_customers_products` (
	`ul_customer_product_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_customer_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_product_id` SMALLINT UNSIGNED NOT NULL ,
	`ul_quantity` TINYINT UNSIGNED NOT NULL ,
	`ul_warranty_status` ENUM('Under Warranty', 'Out Of Warranty', 'Under AMC', 'Stock Piece', 'Status Unknown', '') NULL ,
	`ul_purchase_date` DATE NULL ,
	`ul_purchased_from` ENUM('Wholesaler', 'Dealer', 'Online From Vendor', 'Online From Company', 'Directly From Company', 'Other') NULL ,
	`ul_code` VARCHAR(50) NULL ,
	`ul_dealer` VARCHAR(50) NULL ,
	`ul_dealer_address` VARCHAR(100) NULL ,
	`ul_dealer_pin` MEDIUMINT NULL ,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_customer_product_id`),
	INDEX (`ul_product_id`),
	INDEX (`ul_customer_id`),
	INDEX (`ul_timestamp`),
	CONSTRAINT fk_customer_products_product FOREIGN KEY (`ul_product_id`) REFERENCES `client_products` (`ul_product_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_customer_products_customer FOREIGN KEY (`ul_customer_id`) REFERENCES `clients_customers` (`ul_customer_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Customers Product Data';

-- ------
DROP TABLE IF EXISTS `complaints_data`;
CREATE TABLE `complaints_data` (
	`ul_complaint_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_customer_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_customer_product_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_quantity` TINYINT UNSIGNED NOT NULL ,
	`ul_code` VARCHAR(20) NULL ,
	`ul_center_id` SMALLINT UNSIGNED ZEROFILL NOT NULL,
	`ul_centers_user_id` MEDIUMINT UNSIGNED ZEROFILL NULL,
	`ul_details` TEXT NULL ,
	`ul_bill` VARCHAR(20) NULL,
	`ul_purchase_date` DATE NULL ,
	`ul_serial_no` VARCHAR(20) NULL,
	`ul_tag` VARCHAR(20) NULL,
	`ul_est_resolution_date` DATE NULL,
	`ul_complaint_priority` ENUM('High', 'Medium', 'Low', '') NULL,
	`ul_otp` SMALLINT(4) UNSIGNED ZEROFILL NOT NULL,
	`ul_status` TINYINT(1) NOT NULL DEFAULT -1 COMMENT '-1=Open,0=Pending,1=Close,2=Canceled,3=TagIssued,4=partReplaced',
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL COMMENT 'ERM User detail',
	`ul_action_hours` SMALLINT UNSIGNED NULL ,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_complaint_id`),
	UNIQUE (`ul_code`),
	UNIQUE (`ul_customer_product_id`, `ul_status`, `ul_est_resolution_date`),
	INDEX (`ul_customer_id`),
	INDEX (`ul_center_id`),
	INDEX (`ul_est_resolution_date`),
	INDEX (`ul_status`),
	INDEX (`ul_timestamp`),
	INDEX (`ul_action_hours`),
	CONSTRAINT fk_complaint_customer FOREIGN KEY (`ul_customer_id`) REFERENCES `clients_customers` (`ul_customer_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_complaint_customer_product FOREIGN KEY (`ul_customer_product_id`) REFERENCES `clients_customers_products` (`ul_customer_product_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_complaint_center FOREIGN KEY (`ul_center_id`) REFERENCES `partners_centers` (`ul_center_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_complaint_user FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Complaints Data';

-- -------
DROP TRIGGER IF EXISTS update_complain_code;
DELIMITER $$
	CREATE TRIGGER update_complain_code
	BEFORE INSERT ON `complaints_data` FOR EACH ROW
	begin
	    DECLARE next_id MEDIUMINT;
	    SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='complaints_data');
	    IF NEW.ul_code is NULL OR NEW.ul_code = ''
	    THEN
	        SET NEW.ul_code = CONCAT('T', DATE_FORMAT(CURDATE(), '%y%m%d'), next_id);
	    END IF;
	END$$
DELIMITER ;
UPDATE complaints_data SET ul_code = CONCAT('T', DATE_FORMAT(ul_timestamp, '%y%m%d'), ul_complaint_id);

DROP TABLE IF EXISTS `complaints_feedback`;
CREATE TABLE `complaints_feedback` (
	`ul_feedback_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_complaint_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_review` VARCHAR(100) NULL ,
	`ul_rating` TINYINT(1) UNSIGNED NOT NULL,
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL COMMENT 'ERM User detail',
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_feedback_id`),
	INDEX (`ul_complaint_id`),
	INDEX (`ul_user_id`),
	CONSTRAINT fk_feedback_complaint FOREIGN KEY (`ul_complaint_id`) REFERENCES `complaints_data` (`ul_complaint_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_feedback_user FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Feedback Data';

-- ------
DROP TABLE IF EXISTS `complaints_jobs`;
CREATE TABLE `complaints_jobs` (
	`ul_job_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_complaint_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_attender_name` VARCHAR(50) NULL,
	`ul_user_id` MEDIUMINT UNSIGNED ZEROFILL NOT NULL,
	`ul_km_run` DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`ul_status_brief_internal` TEXT NULL ,
	`ul_status_brief_customer` VARCHAR(100) NULL,
	`ul_type` ENUM ('Local', 'Outside', 'Canceled' , 'Closed by Admin', 'Other') NOT NULL,
	`ul_status` TINYINT NOT NULL COMMENT '-1=Open,0=Pending,1=Close,2=Canceled',
	PRIMARY KEY (`ul_job_id`),
	INDEX (`ul_complaint_id`),
	INDEX (`ul_user_id`),
	INDEX (`ul_timestamp`),
	CONSTRAINT fk_jobs_complaint FOREIGN KEY (`ul_complaint_id`) REFERENCES `complaints_data` (`ul_complaint_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_job_user FOREIGN KEY (`ul_user_id`) REFERENCES `users_personal` (`ul_user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'COmplaint Jobs Data';


-- --------
DROP TABLE IF EXISTS `complaints_jobs_spares`;
CREATE TABLE `complaints_jobs_spares` (
	`ul_job_id` MEDIUMINT UNSIGNED NOT NULL,
	`ul_spare_id` SMALLINT UNSIGNED NOT NULL,
	`ul_quantity` SMALLINT UNSIGNED NULL,
	PRIMARY KEY (`ul_job_id`, `ul_spare_id`),
    INDEX (`ul_spare_id`),
	CONSTRAINT fk_complaints_jobs_spares_spare FOREIGN KEY (`ul_spare_id`) REFERENCES `client_spares` (`ul_spare_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_complaints_jobs_spares_job FOREIGN KEY (`ul_job_id`) REFERENCES `complaints_jobs` (`ul_job_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT 'Complaints Job Spares';

-- -------
DROP TRIGGER IF EXISTS update_stock_after_job;
DELIMITER $$
	CREATE TRIGGER update_stock_after_job
	AFTER INSERT ON `complaints_jobs_spares` FOR EACH ROW
	BEGIN
		DECLARE center_id SMALLINT;
		DECLARE quantity SMALLINT;
	    SET center_id = (SELECT com.ul_center_id FROM complaints_data com LEFT JOIN complaints_jobs job ON job.ul_complaint_id = com.ul_complaint_id WHERE job.ul_job_id = NEW.ul_job_id LIMIT 1);
	    SET quantity = (SELECT prdSpr.ul_quantity FROM client_product_spares prdSpr LEFT JOIN client_products prd ON prd.ul_product_id = prdSpr.ul_product_id WHERE prdSpr.ul_spare_id = NEW.ul_spare_id LIMIT 1);
	    UPDATE `center_inventory` SET `ul_stock` =  quantity, `ul_old_stock` = `ul_old_stock` + quantity WHERE `ul_spare_id` = NEW.ul_spare_id AND `ul_center_id` =center_id LIMIT 1;
	END$$
DELIMITER ;

-- -------
DROP TRIGGER IF EXISTS update_complaint_after_job;
DELIMITER $$
	CREATE TRIGGER update_complaint_after_job
	AFTER INSERT ON `complaints_jobs` FOR EACH ROW
	BEGIN
	    IF ( NEW.ul_type = 'Outside' OR NEW.ul_type = 'Closed by Admin' ) AND NEW.ul_km_run > 20 THEN
    		UPDATE `users_personal` SET `ul_jobs` = `ul_jobs` + 1, `ul_run_km_balance` = `ul_run_km_balance` + NEW.ul_km_run WHERE `ul_user_id` = NEW.ul_user_id LIMIT 1;
    	END IF;
	END$$
DELIMITER ;

-- -------
DROP TRIGGER IF EXISTS update_action_timestamp_after_update;
DELIMITER $$

CREATE TRIGGER update_action_timestamp_after_update
BEFORE UPDATE ON `complaints_data` FOR EACH ROW
BEGIN
    IF (OLD.ul_action_hours IS NULL AND OLD.ul_status != NEW.ul_status ) THEN
		SET NEW.ul_action_hours = TIMESTAMPDIFF(HOUR, OLD.ul_timestamp, NOW());
	END IF;
END
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

-- ------
DROP TABLE IF EXISTS `client_expenses`;
CREATE TABLE `client_expenses` (
	`ul_transaction_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ul_code` VARCHAR(20) NULL,
	`ul_type` VARCHAR(30) NOT NULL,
	`ul_amount` DECIMAL(8,2) NOT NULL ,
	`ul_gst` DECIMAL(8,2) NOT NULL ,
	`ul_description` VARCHAR (200) NOT NULL,
	`ul_date` DATE NOT NULL,
	`ul_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`ul_transaction_id`),
	INDEX (`ul_type`),
	INDEX (`ul_date`)
) ENGINE = InnoDB COMMENT 'Expenses Data';


