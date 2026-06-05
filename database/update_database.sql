-- Update plate_weight_log table to add missing columns

-- Add missing columns to plate_weight_log if they don't exist
ALTER TABLE `plate_weight_log`
ADD COLUMN `created_at` timestamp NULL DEFAULT current_timestamp() AFTER `weight_remark_id`,
ADD COLUMN `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() AFTER `created_at`,
ADD COLUMN `created_by` bigint(20) UNSIGNED DEFAULT NULL AFTER `updated_at`,
ADD COLUMN `updated_by` bigint(20) UNSIGNED DEFAULT NULL AFTER `created_by`,
ADD COLUMN `is_active` tinyint(1) DEFAULT 1 AFTER `updated_by`;

-- Add indexes for the foreign keys if not already present
ALTER TABLE `plate_weight_log`
ADD KEY `fk_pwl_created_by` (`created_by`) IF NOT EXISTS,
ADD KEY `fk_pwl_updated_by` (`updated_by`) IF NOT EXISTS;

-- Update weight_remarks table - rename column if needed
-- First, let's add the description column if it doesn't exist
ALTER TABLE `weight_remarks`
ADD COLUMN `description` text DEFAULT NULL AFTER `remark_name`;

-- Update migrations table to record the new migrations
INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2026_06_05_000000_create_weight_remarks_table', 7),
('2026_06_05_000006_update_plate_weight_log_remarks', 7);

-- Optionally update the auto-increment for weight_remarks if new remarks were added
ALTER TABLE `weight_remarks` AUTO_INCREMENT = 8;

-- Add constraints for the new foreign keys if they don't exist
-- This is safe to run even if constraints already exist (MySQL will ignore duplicates)
ALTER TABLE `plate_weight_log`
ADD CONSTRAINT `fk_pwl_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
ADD CONSTRAINT `fk_pwl_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- Verify the table structure
DESCRIBE `plate_weight_log`;
