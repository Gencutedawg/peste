-- PHPMyAdmin SQL Dump
-- Update plate_weight_log table structure
-- This preserves all existing data

-- Add missing columns to plate_weight_log table
ALTER TABLE `plate_weight_log` ADD `created_at` TIMESTAMP NULL DEFAULT current_timestamp();
ALTER TABLE `plate_weight_log` ADD `updated_at` TIMESTAMP NULL DEFAULT current_timestamp() ON UPDATE current_timestamp();
ALTER TABLE `plate_weight_log` ADD `created_by` BIGINT(20) UNSIGNED DEFAULT NULL;
ALTER TABLE `plate_weight_log` ADD `updated_by` BIGINT(20) UNSIGNED DEFAULT NULL;
ALTER TABLE `plate_weight_log` ADD `is_active` TINYINT(1) DEFAULT 1;

-- Update migrations table to record the applied migrations
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2026_06_05_000000_create_weight_remarks_table', 7),
('2026_06_05_000006_update_plate_weight_log_remarks', 7)
ON DUPLICATE KEY UPDATE `batch` = 7;

-- Add foreign key constraints for the new columns
ALTER TABLE `plate_weight_log`
ADD CONSTRAINT `fk_pwl_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
ADD CONSTRAINT `fk_pwl_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- Add weight_remarks description column if needed
ALTER TABLE `weight_remarks` ADD `description` TEXT DEFAULT NULL;

-- Verify structure
SHOW COLUMNS FROM `plate_weight_log`;
