CREATE TABLE `telecallers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `mobile` VARCHAR(15) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `gender` ENUM('male', 'female', 'other') NOT NULL,
  `accountnumber` VARCHAR(50) NOT NULL,
  `ifsc` VARCHAR(20) NOT NULL,
  `preferred_language` VARCHAR(50) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
